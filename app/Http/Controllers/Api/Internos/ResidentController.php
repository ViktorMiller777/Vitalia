<?php

namespace App\Http\Controllers\Api\Internos;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Internos\ListResidentsRequest;
use App\Http\Requests\Api\Internos\StoreResidentRequest;
use App\Http\Requests\Api\Internos\UpdateResidentRequest;
use App\Http\Resources\ResidentResource;
use App\Models\Resident;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class ResidentController extends Controller
{
    public function store(StoreResidentRequest $request): JsonResponse
    {
        $resident = Resident::create([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $request->input('sexo'),
            'fecha_ingreso' => $request->fechaIngreso(),
            'estado' => 'active',
        ]);

        return ApiResponse::success('INT-0001', 'Interno registrado correctamente', ['id' => $resident->id], 201);
    }

    public function index(ListResidentsRequest $request): JsonResponse
    {
        $paginator = Resident::query()
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->input('estado')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Resident $resident) => new ResidentResource($resident));
    }

    public function show(int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new ResidentResource($resident));
    }

    public function update(UpdateResidentRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $resident->fill([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $request->input('sexo'),
        ]);

        if ($request->filled('fecha_ingreso')) {
            $resident->fecha_ingreso = $request->input('fecha_ingreso');
        }

        $resident->save();

        return ApiResponse::success('INT-0006', 'Interno actualizado correctamente', ['id' => $resident->id]);
    }

    public function destroy(int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $resident->update(['estado' => 'inactive']);

        return ApiResponse::success('INT-0002', 'El interno fue dado de baja');
    }
}
