<?php

namespace App\Http\Controllers\Api\Alertas;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Alertas\ListAlertsRequest;
use App\Http\Requests\Api\Alertas\StoreAlertRequest;
use App\Http\Requests\Api\Alertas\UpdateAlertStatusRequest;
use App\Http\Resources\AlertResource;
use App\Models\Alert;
use App\Models\Resident;
use App\Models\User;
use App\Support\ApiResponse;
use App\Support\ResidentAccess;
use Illuminate\Http\JsonResponse;

class AlertController extends Controller
{
    public function store(StoreAlertRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $user = $request->user();

        $alert = Alert::create([
            'interno_id' => $resident->id,
            'usuario_id' => $user instanceof User ? $user->id : null,
            'tipo_alerta' => $request->input('tipo_alerta'),
            'descripcion' => $request->input('descripcion'),
            'origen' => $request->input('origen'),
            'estado' => 'Activa',
        ]);

        return ApiResponse::success('ALT-0001', 'Alerta registrada en el sistema', ['id' => $alert->id], 201);
    }

    public function index(ListAlertsRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        ResidentAccess::ensureCanAccess($resident->id, $request->user());

        $paginator = Alert::where('interno_id', $resident->id)
            ->when($request->filled('tipo_alerta'), fn ($query) => $query->where('tipo_alerta', $request->input('tipo_alerta')))
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->input('estado')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Alert $alert) => new AlertResource($alert));
    }

    public function show(\Illuminate\Http\Request $request, int $id): JsonResponse
    {
        $alert = Alert::find($id);

        if (! $alert) {
            throw new ApiException('ALT-1001', 'La alerta no existe', 404);
        }

        ResidentAccess::ensureCanAccess($alert->interno_id, $request->user());

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new AlertResource($alert));
    }

    public function updateStatus(UpdateAlertStatusRequest $request, int $id): JsonResponse
    {
        $alert = Alert::find($id);

        if (! $alert) {
            throw new ApiException('ALT-1001', 'La alerta no existe', 404);
        }

        if ($alert->estado !== 'Activa') {
            throw new ApiException('ALT-1003', 'Esta alerta ya fue atendida o descartada', 409);
        }

        $estado = $request->input('estado');
        $alert->update(['estado' => $estado]);

        [$ref, $msg] = $estado === 'Atendida'
            ? ['ALT-0002', 'Alerta marcada como atendida']
            : ['ALT-0003', 'Alerta descartada'];

        return ApiResponse::success($ref, $msg, ['id' => $alert->id]);
    }
}
