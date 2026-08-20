<?php

namespace App\Http\Controllers\Api\Mediciones;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mediciones\ListVitalSignsRequest;
use App\Http\Requests\Api\Mediciones\StoreVitalSignRequest;
use App\Http\Resources\VitalSignResource;
use App\Models\Resident;
use App\Models\User;
use App\Models\VitalSign;
use App\Support\ApiResponse;
use App\Support\ResidentAccess;
use Illuminate\Http\JsonResponse;

class VitalSignController extends Controller
{
    /**
     * Registra una lectura de signos vitales.
     *
     * Acepta tanto personal autenticado (guard sanctum, rol Administrador o
     * Cuidador) como dispositivos IoT autenticados por API key (guard
     * device-key, p. ej. un ESP32 con sensores), igual que AlertController::store.
     */
    public function store(StoreVitalSignRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $user = $request->user();

        if ($user instanceof User && (! $user->rol || ! in_array($user->rol->nombre, ['Administrador', 'Cuidador'], true))) {
            throw new ApiException('AUTH-1003', 'No tienes permiso para realizar esta acción', 403);
        }

        $vitalSign = VitalSign::create($request->only(
            'presion_arterial', 'frecuencia_cardiaca', 'temperatura', 'saturacion_oxigeno', 'glucosa', 'calidad_aire'
        ) + [
            'interno_id' => $resident->id,
            'created_by' => $user instanceof User ? $user->id : null,
        ]);

        return ApiResponse::success('MDC-0001', 'Signos vitales guardados', ['id' => $vitalSign->id], 201);
    }

    /**
     * Registra una lectura de signos vitales enviada por un ESP32 identificado
     * por su propio id de dispositivo (no ligado a un interno).
     */
    public function storeForDevice(StoreVitalSignRequest $request, string $dispositivoId): JsonResponse
    {
        $user = $request->user();

        $vitalSign = VitalSign::create($request->only(
            'presion_arterial', 'frecuencia_cardiaca', 'temperatura', 'saturacion_oxigeno', 'glucosa', 'calidad_aire'
        ) + [
            'dispositivo_id' => $dispositivoId,
            'created_by' => $user instanceof User ? $user->id : null,
        ]);

        return ApiResponse::success('MDC-0001', 'Signos vitales guardados', ['id' => $vitalSign->id], 201);
    }

    /**
     * Devuelve la última lectura enviada por un dispositivo (ESP32) dado.
     */
    public function latestForDevice(string $dispositivoId): JsonResponse
    {
        $vitalSign = VitalSign::where('dispositivo_id', $dispositivoId)
            ->latest('created_at')
            ->first();

        if (! $vitalSign) {
            throw new ApiException('MDC-1006', 'No hay mediciones registradas para este dispositivo', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new VitalSignResource($vitalSign));
    }

    public function index(ListVitalSignsRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        ResidentAccess::ensureCanAccess($resident->id, $request->user());

        $paginator = VitalSign::where('interno_id', $resident->id)
            ->when($request->filled('from'), fn ($query) => $query->where('created_at', '>=', $request->input('from')))
            ->when($request->filled('to'), fn ($query) => $query->where('created_at', '<=', $request->input('to')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (VitalSign $vitalSign) => new VitalSignResource($vitalSign));
    }

    public function show(\Illuminate\Http\Request $request, int $medicionId): JsonResponse
    {
        $vitalSign = VitalSign::find($medicionId);

        if (! $vitalSign) {
            throw new ApiException('MDC-1002', 'El registro de medición no existe', 404);
        }

        ResidentAccess::ensureCanAccess($vitalSign->interno_id, $request->user());

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new VitalSignResource($vitalSign));
    }
}
