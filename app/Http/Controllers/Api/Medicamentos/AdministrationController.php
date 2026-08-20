<?php

namespace App\Http\Controllers\Api\Medicamentos;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Medicamentos\ListAdministrationsRequest;
use App\Http\Requests\Api\Medicamentos\StoreAdministrationRequest;
use App\Http\Resources\MedicationAdministrationResource;
use App\Models\MedicationAdministration;
use App\Models\Prescription;
use App\Support\ApiResponse;
use App\Support\ResidentAccess;
use Illuminate\Http\JsonResponse;

class AdministrationController extends Controller
{
    public function store(StoreAdministrationRequest $request, int $id, int $prescripcionId): JsonResponse
    {
        $prescription = Prescription::where('interno_id', $id)->find($prescripcionId);

        if (! $prescription) {
            throw new ApiException('MED-1002', 'La prescripción no existe', 404);
        }

        if ($prescription->estado !== 'active') {
            throw new ApiException('MED-1004', 'Esta prescripción ya fue cancelada o finalizada', 409);
        }

        $administration = MedicationAdministration::create([
            'prescripcion_id' => $prescription->id,
            'cuidador_id' => $request->user()->id,
            'fecha' => now(),
            'dosis_administrada' => $request->input('dosis_administrada'),
            'observaciones' => $request->input('observaciones'),
        ]);

        return ApiResponse::success('MED-0003', 'Dosis registrada correctamente', ['id' => $administration->id], 201);
    }

    public function index(ListAdministrationsRequest $request, int $id, int $prescripcionId): JsonResponse
    {
        $prescription = Prescription::where('interno_id', $id)->find($prescripcionId);

        if (! $prescription) {
            throw new ApiException('MED-1002', 'La prescripción no existe', 404);
        }

        ResidentAccess::ensureCanAccess($id, $request->user());

        $paginator = MedicationAdministration::where('prescripcion_id', $prescription->id)
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (MedicationAdministration $administration) => new MedicationAdministrationResource($administration));
    }
}
