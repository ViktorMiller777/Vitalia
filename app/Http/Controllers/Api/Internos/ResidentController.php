<?php

namespace App\Http\Controllers\Api\Internos;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Internos\ListResidentsRequest;
use App\Http\Requests\Api\Internos\StoreResidentRequest;
use App\Http\Requests\Api\Internos\UpdateResidentRequest;
use App\Http\Resources\ResidentResource;
use App\Models\Resident;
use App\Models\User;
use App\Models\Incident;
use App\Support\ApiResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ResidentController extends Controller
{

    public function count()
    {
        return view('dashboard', [
            'internosActivos' => Resident::where('estado', 'Estable')->count(),
            'usuariosTotales' => User::where('estado', 'active')->count(),
            'incidenciasPendientes' => Incident::where('estado', 'pendiente')->count(),
        ]);
    }
    
    public function store(StoreResidentRequest $request): JsonResponse|RedirectResponse
    {
        $rawSexo = $request->input('sexo');
        $sexo = match ($rawSexo) {
            'Masculino' => 'M',
            'Femenino' => 'F',
            default => $rawSexo,
        };

        $resident = Resident::create([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $sexo,
            'fecha_ingreso' => $request->fechaIngreso(),
            'estado' => $request->input('estado', 'Estable'),
        ]);

        $clinicalHistoryData = array_filter([
            'tipo_sangre' => $request->input('tipo_sangre'),
            'peso' => $request->input('peso'),
            'estatura' => $request->input('estatura'),
            'alergias' => $request->input('alergias'),
            'padecimientos' => $request->input('padecimientos'),
            'antecedentes_medicos' => $request->input('antecedentes_medicos'),
            'enfermedades_cronicas' => $request->input('enfermedades_cronicas'),
            'cirugias_previas' => $request->input('cirugias_previas'),
            'observaciones' => $request->input('observaciones_generales') ?? $request->input('observaciones'),
        ], fn ($val) => ! is_null($val) && $val !== '');

        if (! empty($clinicalHistoryData)) {
            $clinicalHistoryData['created_by'] = auth()->id();
            $resident->clinicalHistory()->create($clinicalHistoryData);
        }

        if ($request->wantsJson() || $request->is('api/*')) {
            return ApiResponse::success('INT-0001', 'Interno registrado correctamente', ['id' => $resident->id], 201);
        }

        return redirect()->route('internos.index')->with('success', 'Interno registrado correctamente.');
    }

    public function index(ListResidentsRequest $request): JsonResponse|View
    {
        $search = $request->input('buscar') ?? $request->input('search');
        $estado = $request->input('estado');

        $query = Resident::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellido_paterno', 'like', "%{$search}%")
                        ->orWhere('apellido_materno', 'like', "%{$search}%");
                });
            })
            ->when($estado, fn ($q) => $q->where('estado', $estado))
            ->orderBy('id', 'desc');

        if ($request->wantsJson() || $request->is('api/*')) {
            $paginator = $query->paginate($request->perPage(), page: $request->page());
            return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Resident $resident) => new ResidentResource($resident));
        }

        $internos = $query->paginate(5)->withQueryString();

        return view('internos.index', compact('internos', 'search', 'estado'));
    }

    public function show(int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new ResidentResource($resident));
    }

    public function update(UpdateResidentRequest $request, int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $resident->fill([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $request->input('sexo'),
        ]);

        if ($request->filled('fecha_ingreso')) {
            $resident->fecha_ingreso = $request->input('fecha_ingreso');
        }

        $resident->save();

        return ApiResponse::success('INT-0006', 'Interno actualizado correctamente', ['id' => $resident->id]);
    }

    public function destroy(int $id): JsonResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
        }

        $resident->update(['estado' => 'inactive']);

        return ApiResponse::success('INT-0002', 'El interno fue dado de baja');
    }
}
