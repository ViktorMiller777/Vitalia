<?php

namespace App\Http\Controllers\Api\Notificaciones;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Notificaciones\ListNotificationsRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(ListNotificationsRequest $request): JsonResponse
    {
        $paginator = Notification::where('usuario_id', $request->user()->id)
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->input('estado')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Notification $notification) => new NotificationResource($notification));
    }

    public function markRead(Request $request, int $id): JsonResponse
    {
        $notification = Notification::where('usuario_id', $request->user()->id)->find($id);

        if (! $notification) {
            throw new ApiException('NTF-1001', 'La notificación no existe', 404);
        }

        $notification->update(['estado' => 'Leído']);

        return ApiResponse::success('NTF-0001', 'Notificación marcada como leída');
    }
}
