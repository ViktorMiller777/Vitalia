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
use App\Support\ResidentAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class IncidentController extends Controller
{
    public function store(StoreIncidentRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('RES-1001', 'El interno no existe', 404);
        }

        $incident = Incident::create([
            'interno_id' => $resident->id,
            'cuidador_id' => $request->user()->id,
            'tipo_incidencia' => $request->input('tipo_incidencia'),
            'descripcion' => $request->input('descripcion'),
            'prioridad' => $request->prioridad(),
            'fecha_hora' => $request->fechaHora(),
            'estado' => 'Pendiente',
        ]);

        return ApiResponse::success('INC-0001', 'Incidencia registrada correctamente', new IncidentResource($incident->load(['resident', 'cuidador'])), 201);
    }

    public function index(ListIncidentsRequest $request, ?int $id = null): JsonResponse
    {
        $query = Incident::query()->with(['resident', 'cuidador', 'administrador']);

        if ($id !== null) {
            $resident = Resident::find($id);

            if (! $resident) {
                throw new ApiException('RES-1001', 'El interno no existe', 404);
            }

            ResidentAccess::ensureCanAccess($resident->id, $request->user());

            $query->where('interno_id', $resident->id);
        } elseif ($request->has('interno_id')) {
            ResidentAccess::ensureCanAccess((int) $request->query('interno_id'), $request->user());

            $query->where('interno_id', $request->query('interno_id'));
        }

        if ($request->has('cuidador_id')) {
            $query->where('cuidador_id', $request->query('cuidador_id'));
        }

        if ($request->has('tipo_incidencia')) {
            $query->where('tipo_incidencia', $request->query('tipo_incidencia'));
        }

        if ($request->has('prioridad')) {
            $query->where('prioridad', $request->query('prioridad'));
        }

        if ($request->has('estado')) {
            $query->where('estado', $request->query('estado'));
        }

        return ApiResponse::paginated(
            'GEN-0001',
            'Incidencias obtenidas correctamente',
            $query->latest()->paginate($request->perPage()),
            fn ($incident) => new IncidentResource($incident)
        );
    }

    public function show(\Illuminate\Http\Request $request, int $id): JsonResponse
    {
        $incident = Incident::find($id);

        if (! $incident) {
            throw new ApiException('INC-1001', 'La incidencia no existe', 404);
        }

        ResidentAccess::ensureCanAccess($incident->interno_id, $request->user());

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new IncidentResource($incident));
    }

    public function update(UpdateIncidentRequest $request, int $id): JsonResponse
    {
        $incident = Incident::find($id);

        if (! $incident) {
            throw new ApiException('INC-1001', 'La incidencia no existe', 404);
        }

        ResidentAccess::ensureCanAccess($incident->interno_id, $request->user());

        if ($incident->estado !== 'Pendiente' && $incident->estado !== 'pendiente') {
            throw new ApiException('INC-1003', 'Esta incidencia ya fue revisada y no se puede modificar', 409);
        }

        $incident->update([
            'tipo_incidencia' => $request->input('tipo_incidencia'),
            'descripcion' => $request->input('descripcion'),
            'prioridad' => $request->prioridad(),
        ]);

        return ApiResponse::success('INC-0004', 'Incidencia actualizada correctamente', ['id' => $incident->id]);
    }

    public function updateStatus(UpdateIncidentStatusRequest $request, int $id): JsonResponse|RedirectResponse
    {
        $incident = Incident::find($id);

        if (! $incident) {
            if ($request->wantsJson() || $request->is('api/*')) {
                throw new ApiException('INC-1001', 'La incidencia no existe', 404);
            }
            return back()->with('error', 'La incidencia no existe');
        }

        if ($incident->estado !== 'Pendiente' && $incident->estado !== 'pendiente') {
            if ($request->wantsJson() || $request->is('api/*')) {
                throw new ApiException('INC-1003', 'Esta incidencia ya fue revisada y no se puede modificar', 409);
            }
            return back()->with('error', 'Esta incidencia ya fue revisada');
        }

        $estado = $request->input('estado');

        $incident->update([
            'estado' => $estado,
            'administrador_id' => $request->user()?->id,
        ]);

        [$ref, $msg] = $estado === 'Aprobada'
            ? ['INC-0002', 'Incidencia aprobada']
            : ['INC-0003', 'Incidencia rechazada'];

        if ($request->wantsJson() || $request->is('api/*')) {
            return ApiResponse::success($ref, $msg, ['id' => $incident->id]);
        }

        return back()->with('success', "Incidencia {$estado} correctamente.");
    }
}
