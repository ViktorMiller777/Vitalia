<?php

namespace App\Http\Controllers\Api\Mediciones;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mediciones\ListVitalSignsRequest;
use App\Http\Requests\Api\Mediciones\StoreVitalSignRequest;
use App\Http\Resources\VitalSignResource;
use App\Models\Resident;
use App\Models\VitalSign;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class VitalSignController extends Controller
{
    public function store(StoreVitalSignRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $vitalSign = VitalSign::create($request->only(
            'presion_arterial', 'frecuencia_cardiaca', 'temperatura', 'saturacion_oxigeno', 'glucosa', 'calidad_aire'
        ) + [
            'interno_id' => $resident->id,
            'created_by' => $request->user()->id,
        ]);

        return ApiResponse::success('MDC-0001', 'Signos vitales guardados', ['id' => $vitalSign->id], 201);
    }

    public function index(ListVitalSignsRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $paginator = VitalSign::where('interno_id', $resident->id)
            ->when($request->filled('from'), fn ($query) => $query->where('created_at', '>=', $request->input('from')))
            ->when($request->filled('to'), fn ($query) => $query->where('created_at', '<=', $request->input('to')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (VitalSign $vitalSign) => new VitalSignResource($vitalSign));
    }

    public function show(int $medicionId): JsonResponse
    {
        $vitalSign = VitalSign::find($medicionId);

        if (! $vitalSign) {
            throw new ApiException('MDC-1002', 'El registro de medición no existe', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new VitalSignResource($vitalSign));
    }
}
