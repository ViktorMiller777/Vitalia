<?php

namespace App\Http\Controllers\Api\Incidencias;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Incidencias\ListIncidentsRequest;
use App\Http\Requests\Api\Incidencias\StoreIncidentRequest;
use App\Http\Requests\Api\Incidencias\UpdateIncidentRequest;
use App\Http\Requests\Api\Incidencias\UpdateIncidentStatusRequest;
use App\Http\Resources\IncidentResource;
use App\Models\Incident;
use App\Models\Resident;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class IncidentController extends Controller
{
    public function store(StoreIncidentRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $incident = Incident::create([
            'interno_id' => $resident->id,
            'cuidador_id' => $request->user()->id,
            'tipo_incidencia' => $request->input('tipo_incidencia'),
            'descripcion' => $request->input('descripcion'),
            'prioridad' => $request->prioridad(),
            'fecha_hora' => now(),
            'estado' => 'Pendiente',
        ]);

        return ApiResponse::success('INC-0001', 'Incidencia registrada correctamente', ['id' => $incident->id], 201);
    }

    public function index(ListIncidentsRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $paginator = Incident::where('interno_id', $resident->id)
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->input('estado')))
            ->when($request->filled('prioridad'), fn ($query) => $query->where('prioridad', $request->input('prioridad')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Incident $incident) => new IncidentResource($incident));
    }

    public function show(int $id): JsonResponse
    {
        $incident = Incident::find($id);

        if (! $incident) {
            throw new ApiException('INC-1001', 'La incidencia no existe', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new IncidentResource($incident));
    }

    public function update(UpdateIncidentRequest $request, int $id): JsonResponse
    {
        $incident = Incident::find($id);

        if (! $incident) {
            throw new ApiException('INC-1001', 'La incidencia no existe', 404);
        }

        if ($incident->estado !== 'Pendiente') {
            throw new ApiException('INC-1003', 'Esta incidencia ya fue revisada y no se puede modificar', 409);
        }

        $incident->update([
            'tipo_incidencia' => $request->input('tipo_incidencia'),
            'descripcion' => $request->input('descripcion'),
            'prioridad' => $request->prioridad(),
        ]);

        return ApiResponse::success('INC-0004', 'Incidencia actualizada correctamente', ['id' => $incident->id]);
    }

    public function updateStatus(UpdateIncidentStatusRequest $request, int $id): JsonResponse
    {
        $incident = Incident::find($id);

        if (! $incident) {
            throw new ApiException('INC-1001', 'La incidencia no existe', 404);
        }

        if ($incident->estado !== 'Pendiente') {
            throw new ApiException('INC-1003', 'Esta incidencia ya fue revisada y no se puede modificar', 409);
        }

        $estado = $request->input('estado');

        $incident->update([
            'estado' => $estado,
            'administrador_id' => $request->user()->id,
        ]);

        [$ref, $msg] = $estado === 'Aprobada'
            ? ['INC-0002', 'Incidencia aprobada']
            : ['INC-0003', 'Incidencia rechazada'];

        return ApiResponse::success($ref, $msg, ['id' => $incident->id]);
    }
}
