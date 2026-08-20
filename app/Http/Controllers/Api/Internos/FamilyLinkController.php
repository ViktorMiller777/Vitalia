<?php

namespace App\Http\Controllers\Api\Internos;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Internos\ListFamilyLinksRequest;
use App\Http\Requests\Api\Internos\StoreFamilyLinkRequest;
use App\Http\Resources\FamilyLinkResource;
use App\Models\FamilyLink;
use App\Models\Resident;
use App\Support\ApiResponse;
use App\Support\ResidentAccess;
use Illuminate\Http\JsonResponse;

class FamilyLinkController extends Controller
{
    public function store(StoreFamilyLinkRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $exists = FamilyLink::where('interno_id', $resident->id)
            ->where('usuario_id', $request->input('usuario_id'))
            ->exists();

        if ($exists) {
            throw new ApiException('INT-1004', 'Este familiar ya está vinculado al interno', 409);
        }

        FamilyLink::create([
            'interno_id' => $resident->id,
            'usuario_id' => $request->input('usuario_id'),
            'parentesco' => $request->input('parentesco'),
            'fecha_asignacion' => now()->toDateString(),
            'estado' => 'active',
        ]);

        return ApiResponse::success('INT-0004', 'Familiar vinculado al interno', null, 201);
    }

    public function index(ListFamilyLinksRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        ResidentAccess::ensureCanAccess($resident->id, $request->user());

        $paginator = FamilyLink::with('usuario')
            ->where('interno_id', $resident->id)
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (FamilyLink $link) => new FamilyLinkResource($link));
    }

    public function destroy(int $id, int $usuarioId): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $link = FamilyLink::where('interno_id', $resident->id)->where('usuario_id', $usuarioId)->first();

        if (! $link) {
            throw new ApiException('INT-1005', 'Este familiar no está vinculado al interno', 404);
        }

        $link->delete();

        return ApiResponse::success('INT-0005', 'Familiar desvinculado del interno');
    }
}
