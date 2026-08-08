<?php

namespace App\Http\Controllers\Api\Roles;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Roles\ListRolesRequest;
use App\Http\Resources\RoleResource;
use App\Models\Rol;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function index(ListRolesRequest $request): JsonResponse
    {
        $paginator = Rol::query()->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Rol $rol) => new RoleResource($rol));
    }

    public function show(int $id): JsonResponse
    {
        $rol = Rol::find($id);

        if (! $rol) {
            throw new ApiException('ROL-1001', 'El rol no existe', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new RoleResource($rol));
    }
}
