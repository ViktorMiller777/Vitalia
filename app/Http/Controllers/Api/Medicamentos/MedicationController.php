<?php

namespace App\Http\Controllers\Api\Medicamentos;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Medicamentos\ListMedicationsRequest;
use App\Http\Requests\Api\Medicamentos\StoreMedicationRequest;
use App\Http\Requests\Api\Medicamentos\UpdateMedicationRequest;
use App\Http\Resources\MedicationResource;
use App\Models\Medication;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class MedicationController extends Controller
{
    public function store(StoreMedicationRequest $request): JsonResponse
    {
        $medication = Medication::create($request->only('nombre', 'presentacion', 'concentracion'));

        return ApiResponse::success('MED-0001', 'Medicamento registrado en el catálogo', ['id' => $medication->id], 201);
    }

    public function index(ListMedicationsRequest $request): JsonResponse
    {
        $paginator = Medication::query()
            ->when($request->filled('nombre'), fn ($query) => $query->where('nombre', 'like', '%'.$request->input('nombre').'%'))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Medication $medication) => new MedicationResource($medication));
    }

    public function show(int $id): JsonResponse
    {
        $medication = Medication::find($id);

        if (! $medication) {
            throw new ApiException('MED-1001', 'El medicamento no existe en el catálogo', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new MedicationResource($medication));
    }

    public function update(UpdateMedicationRequest $request, int $id): JsonResponse
    {
        $medication = Medication::find($id);

        if (! $medication) {
            throw new ApiException('MED-1001', 'El medicamento no existe en el catálogo', 404);
        }

        $medication->update($request->only('nombre', 'presentacion', 'concentracion'));

        return ApiResponse::success('MED-0005', 'Medicamento actualizado en el catálogo', ['id' => $medication->id]);
    }
}
