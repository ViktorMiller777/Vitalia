<?php

namespace App\Http\Controllers\Api\Usuarios;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Usuarios\ListUsersRequest;
use App\Http\Requests\Api\Usuarios\StoreUserRequest;
use App\Http\Requests\Api\Usuarios\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function count(){
        $personalCount = User::where('estado', 'active')->count();

        return view('dashboard', [
            'personalCount' => $personalCount,
        ]); 
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'usuario' => $request->input('usuario'),
            'password' => $request->input('contrasena'),
            'rol_id' => $request->input('rol_id'),
            'estado' => 'active',
        ]);

        return ApiResponse::success('USR-0001', 'Usuario registrado exitosamente', ['id' => $user->id], 201);
    }

    public function index(ListUsersRequest $request): JsonResponse
    {
        $paginator = User::query()
            ->when($request->filled('estado'), fn ($query) => $query->where('estado', $request->input('estado')))
            ->paginate($request->perPage(), page: $request->page());

        return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (User $user) => new UserResource($user));
    }

    public function show(int $id): JsonResponse
    {
        $user = User::find($id);

        if (! $user) {
            throw new ApiException('USR-1003', 'El usuario no existe', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new UserResource($user));
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = User::find($id);

        if (! $user) {
            throw new ApiException('USR-1003', 'El usuario no existe', 404);
        }

        $user->fill([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'usuario' => $request->input('usuario'),
            'rol_id' => $request->input('rol_id'),
        ]);

        if ($request->filled('contrasena')) {
            $user->password = $request->input('contrasena');
        }

        $user->save();

        return ApiResponse::success('USR-0002', 'Datos del usuario actualizados', ['id' => $user->id]);
    }

    public function destroy(int $id): JsonResponse
    {
        $user = User::find($id);

        if (! $user) {
            throw new ApiException('USR-1003', 'El usuario no existe', 404);
        }

        $user->update(['estado' => 'inactive']);

        return ApiResponse::success('USR-0003', 'El usuario fue desactivado del sistema');
    }
}
