<?php

namespace App\Http\Controllers\Api\Usuarios;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Usuarios\ListUsersRequest;
use App\Http\Requests\Api\Usuarios\StoreUserRequest;
use App\Http\Requests\Api\Usuarios\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Resident;
use App\Models\FamilyLink;
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

    public function cuidadoresIndex(\Illuminate\Http\Request $request): \Illuminate\View\View
    {
        $search = $request->input('buscar') ?? $request->input('search');

        $cuidadores = User::query()
            ->where('rol_id', 2)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellido_paterno', 'like', "%{$search}%")
                        ->orWhere('apellido_materno', 'like', "%{$search}%")
                        ->orWhere('correo', 'like', "%{$search}%")
                        ->orWhere('telefono', 'like', "%{$search}%")
                        ->orWhere('usuario', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('cuidadores.index', compact('cuidadores', 'search'));
    }

    public function cuidadorShow(int $id): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $cuidador = User::where('rol_id', 2)->find($id);

        if (! $cuidador) {
            $cuidador = User::find($id);
        }

        if (! $cuidador) {
            return redirect()->route('cuidadores.index')->with('error', 'El cuidador no existe en el sistema.');
        }

        return view('cuidadores.detalle_cuidador', compact('cuidador'));
    }

    public function cuidadorCreate(): \Illuminate\View\View
    {
        return view('cuidadores.agregar_cuidador');
    }

    public function cuidadorStore(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'correo' => 'required|email|unique:users,correo',
            'telefono' => 'required|string|max:20',
            'usuario' => 'required|string|unique:users,usuario',
            'password' => 'required|string|min:6|confirmed',
            'estado' => 'nullable|string',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingrese un correo electrónico válido.',
            'correo.unique' => 'El correo electrónico ya se encuentra registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'usuario.required' => 'El nombre de usuario es obligatorio.',
            'usuario.unique' => 'El nombre de usuario ya existe.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ]);

        $status = in_array(strtolower($request->input('estado', 'Activo')), ['inactivo', 'inactive']) ? 'inactive' : 'active';

        User::create([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'usuario' => $request->input('usuario'),
            'password' => \Illuminate\Support\Facades\Hash::make($request->input('password')),
            'rol_id' => 2,
            'estado' => $status,
        ]);

        return redirect()->route('cuidadores.index')
            ->with('success', 'El cuidador se ha registrado correctamente.');
    }

    public function cuidadorEdit(int $id = null): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        if (! $id) {
            $cuidador = User::where('rol_id', 2)->first();
        } else {
            $cuidador = User::where('rol_id', 2)->find($id);
            if (! $cuidador) {
                $cuidador = User::find($id);
            }
        }

        if (! $cuidador) {
            return redirect()->route('cuidadores.index')->with('error', 'El cuidador no existe en el sistema.');
        }

        return view('cuidadores.editar_cuidador', compact('cuidador'));
    }

    public function cuidadorUpdate(\Illuminate\Http\Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $cuidador = User::where('rol_id', 2)->find($id);
        if (! $cuidador) {
            $cuidador = User::find($id);
        }

        if (! $cuidador) {
            return redirect()->route('cuidadores.index')->with('error', 'El cuidador no existe en el sistema.');
        }

        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'correo' => 'required|email|unique:users,correo,' . $cuidador->id,
            'telefono' => 'required|string|max:20',
            'usuario' => 'required|string|unique:users,usuario,' . $cuidador->id,
            'password' => 'nullable|string|min:6|confirmed',
            'estado' => 'nullable|string',
        ], [
            'correo.unique' => 'El correo electrónico ya se encuentra registrado por otro usuario.',
            'usuario.unique' => 'El nombre de usuario ya existe.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
        ]);

        $status = in_array(strtolower($request->input('estado', $cuidador->estado)), ['inactivo', 'inactive']) ? 'inactive' : 'active';

        $updateData = [
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'usuario' => $request->input('usuario'),
            'estado' => $status,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = $request->input('password');
        }

        $cuidador->update($updateData);

        return redirect()->route('cuidadores.editar_cuidador', ['id' => $cuidador->id])
            ->with('success', 'La información del cuidador fue actualizada correctamente.');
    }

    public function familiaresIndex(\Illuminate\Http\Request $request): \Illuminate\View\View
    {
        $search = $request->input('buscar') ?? $request->input('search');

        $familiares = User::query()
            ->where('rol_id', 3)
            ->with(['familyLinks.resident'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellido_paterno', 'like', "%{$search}%")
                        ->orWhere('apellido_materno', 'like', "%{$search}%")
                        ->orWhere('correo', 'like', "%{$search}%")
                        ->orWhere('telefono', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('familiar.index', compact('familiares', 'search'));
    }

    public function familiarCreate(): \Illuminate\View\View
    {
        $residents = Resident::orderBy('nombre')->get();
        return view('familiar.agregar_familiar', compact('residents'));
    }

    public function familiarStore(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'correo' => 'required|email|unique:users,correo',
            'telefono' => 'required|string|max:20',
            'usuario' => 'required|string|unique:users,usuario',
            'password' => 'required|string|min:6|confirmed',
            'estado' => 'nullable|string',
            'tipo_familiar' => 'nullable|string',
            'internos' => 'nullable|array',
            'internos.*.interno_id' => 'nullable|exists:internos,id',
            'internos.*.parentesco' => 'nullable|string|max:50',
        ], [
            'correo.unique' => 'El correo electrónico ya se encuentra registrado.',
            'usuario.unique' => 'El nombre de usuario ya existe.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
        ]);

        $status = in_array(strtolower($request->input('estado', 'active')), ['inactivo', 'inactive']) ? 'inactive' : 'active';

        $user = User::create([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'usuario' => $request->input('usuario'),
            'password' => $request->input('password'),
            'rol_id' => 3, // Rol Familiar
            'estado' => $status,
        ]);

        $internos = $request->input('internos', []);
        if (is_array($internos)) {
            foreach ($internos as $item) {
                if (! empty($item['interno_id'])) {
                    FamilyLink::create([
                        'interno_id' => $item['interno_id'],
                        'usuario_id' => $user->id,
                        'parentesco' => ! empty($item['parentesco']) ? $item['parentesco'] : ($request->input('tipo_familiar') ?? 'Familiar'),
                        'fecha_asignacion' => now(),
                        'estado' => 'active',
                    ]);
                }
            }
        }

        return redirect()->route('familiares.index')->with('success', 'Familiar registrado correctamente.');
    }

    public function familiarShow(int $id): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        $familiar = User::with(['familyLinks.resident'])->where('rol_id', 3)->find($id);

        if (! $familiar) {
            $familiar = User::with(['familyLinks.resident'])->find($id);
        }

        if (! $familiar) {
            return redirect()->route('familiares.index')->with('error', 'El familiar no existe en el sistema.');
        }

        return view('familiar.detalle_familiar', compact('familiar'));
    }

    public function familiarEdit(int $id = null): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    {
        if (! $id) {
            $familiar = User::with(['familyLinks.resident'])->where('rol_id', 3)->first();
        } else {
            $familiar = User::with(['familyLinks.resident'])->find($id);
        }

        if (! $familiar) {
            return redirect()->route('familiares.index')->with('error', 'El familiar no existe.');
        }

        $internosDisponibles = Resident::orderBy('nombre')->get();

        return view('familiar.editar_familiar', compact('familiar', 'internosDisponibles'));
    }

    public function familiarUpdate(\Illuminate\Http\Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $familiar = User::where('rol_id', 3)->find($id);
        if (! $familiar) {
            $familiar = User::find($id);
        }

        if (! $familiar) {
            return redirect()->route('familiares.index')->with('error', 'El familiar no existe en el sistema.');
        }

        $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'correo' => 'required|email|unique:users,correo,' . $familiar->id,
            'telefono' => 'required|string|max:20',
            'usuario' => 'required|string|unique:users,usuario,' . $familiar->id,
            'password' => 'nullable|string|min:6|confirmed',
            'estado' => 'nullable|string',
            'tipo_familiar' => 'nullable|string',
            'internos' => 'nullable|array',
            'internos.*.interno_id' => 'nullable|exists:internos,id',
            'internos.*.parentesco' => 'nullable|string|max:50',
        ], [
            'correo.unique' => 'El correo electrónico ya se encuentra registrado por otro usuario.',
            'usuario.unique' => 'El nombre de usuario ya existe.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido_paterno.required' => 'El apellido paterno es obligatorio.',
            'apellido_materno.required' => 'El apellido materno es obligatorio.',
        ]);

        $status = in_array(strtolower($request->input('estado', $familiar->estado)), ['inactivo', 'inactive']) ? 'inactive' : 'active';

        $updateData = [
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'usuario' => $request->input('usuario'),
            'estado' => $status,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = $request->input('password');
        }

        $familiar->update($updateData);

        $internos = $request->input('internos', []);
        if (is_array($internos)) {
            FamilyLink::where('usuario_id', $familiar->id)->delete();

            foreach ($internos as $item) {
                if (! empty($item['interno_id'])) {
                    FamilyLink::create([
                        'interno_id' => $item['interno_id'],
                        'usuario_id' => $familiar->id,
                        'parentesco' => ! empty($item['parentesco']) ? $item['parentesco'] : ($request->input('tipo_familiar') ?? 'Familiar'),
                        'fecha_asignacion' => now(),
                        'estado' => 'active',
                    ]);
                }
            }
        }

        return redirect()->route('familiar.editar_familiar', ['id' => $familiar->id])
            ->with('success', 'La información del familiar fue actualizada correctamente.');
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
