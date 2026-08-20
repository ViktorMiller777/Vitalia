<?php

namespace App\Http\Controllers\Api\Internos;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Internos\StoreClinicalHistoryRequest;
use App\Http\Requests\Api\Internos\UpdateClinicalHistoryRequest;
use App\Http\Resources\ClinicalHistoryResource;
use App\Models\ClinicalHistory;
use App\Models\Resident;
use App\Support\ApiResponse;
use App\Support\ResidentAccess;
use Illuminate\Http\JsonResponse;

class ClinicalHistoryController extends Controller
{
    public function store(StoreClinicalHistoryRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        if ($resident->clinicalHistory()->exists()) {
            throw new ApiException('INT-1003', 'Este interno ya tiene historial clínico creado', 409);
        }

        $history = ClinicalHistory::create($request->validated() + [
            'interno_id' => $resident->id,
            'created_by' => $request->user()->id,
        ]);

        return ApiResponse::success('INT-0003', 'Historial clínico creado', ['id' => $history->id], 201);
    }

    public function show(\Illuminate\Http\Request $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        ResidentAccess::ensureCanAccess($resident->id, $request->user());

        $history = $resident->clinicalHistory;

        if (! $history) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new ClinicalHistoryResource($history));
    }

    public function update(UpdateClinicalHistoryRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $history = $resident->clinicalHistory;

        if (! $history) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $history->fill($request->validated() + ['updated_by' => $request->user()->id]);
        $history->save();

        return ApiResponse::success('INT-0003B', 'Historial clínico actualizado', ['id' => $history->id]);
    }
}
