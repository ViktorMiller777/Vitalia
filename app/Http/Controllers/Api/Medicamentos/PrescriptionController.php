<?php

namespace App\Http\Controllers\Api\Medicamentos;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Medicamentos\ListPrescriptionsRequest;
use App\Http\Requests\Api\Medicamentos\StorePrescriptionRequest;
use App\Http\Requests\Api\Medicamentos\UpdatePrescriptionRequest;
use App\Http\Resources\PrescriptionResource;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\Resident;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class PrescriptionController extends Controller
{
    public function store(StorePrescriptionRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        if (! Medication::whereKey($request->input('medicamento_id'))->exists()) {
            throw new ApiException('MED-1001', 'El medicamento no existe en el catálogo', 404);
        }

        $prescription = Prescription::create([
            'interno_id' => $resident->id,
            'medicamento_id' => $request->input('medicamento_id'),
            'dosis' => $request->input('dosis'),
            'frecuencia' => $request->input('frecuencia'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
            'estado' => 'active',
        ]);

        return ApiResponse::success('MED-0002', 'Medicamento prescrito al interno', ['id' => $prescription->id], 201);
    }

    public function index(ListPrescriptionsRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $paginator = Prescription::where('interno_id', $resident->id)
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->input('estado')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Prescription $prescription) => new PrescriptionResource($prescription));
    }

    public function update(UpdatePrescriptionRequest $request, int $id, int $prescripcionId): JsonResponse
    {
        $prescription = Prescription::where('interno_id', $id)->find($prescripcionId);

        if (! $prescription) {
            throw new ApiException('MED-1002', 'La prescripción no existe', 404);
        }

        if ($prescription->estado !== 'active') {
            throw new ApiException('MED-1004', 'Esta prescripción ya fue cancelada o finalizada', 409);
        }

        $prescription->update($request->only('dosis', 'frecuencia'));

        return ApiResponse::success('MED-0006', 'Prescripción actualizada correctamente', ['id' => $prescription->id]);
    }

    public function destroy(int $id, int $prescripcionId): JsonResponse
    {
        $prescription = Prescription::where('interno_id', $id)->find($prescripcionId);

        if (! $prescription) {
            throw new ApiException('MED-1002', 'La prescripción no existe', 404);
        }

        if ($prescription->estado !== 'active') {
            throw new ApiException('MED-1004', 'Esta prescripción ya fue cancelada o finalizada', 409);
        }

        $prescription->update(['estado' => 'inactive']);

        return ApiResponse::success('MED-0004', 'Prescripción cancelada');
    }
}
