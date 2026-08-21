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
use App\Models\Alert;
use App\Models\Incident;
use App\Models\VitalSign;
use App\Support\ApiResponse;
use App\Support\ResidentAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

use App\Http\Controllers\Api\Medicamentos\MedicationController;

class ResidentController extends Controller
{

    public function count()
    {
        // 1. Incidencias por Tipo
        $incidenciasPorTipo = Incident::selectRaw('tipo_incidencia, count(*) as total')
            ->groupBy('tipo_incidencia')
            ->pluck('total', 'tipo_incidencia');

        $chartIncidenciasLabels = $incidenciasPorTipo->keys()->toArray();
        $chartIncidenciasData = $incidenciasPorTipo->values()->toArray();

        if (empty($chartIncidenciasLabels)) {
            $chartIncidenciasLabels = ['Sin incidencias'];
            $chartIncidenciasData = [0];
        }

        // 2. Alertas por Tipo
        $alertasPorTipo = Alert::selectRaw('tipo_alerta, count(*) as total')
            ->groupBy('tipo_alerta')
            ->pluck('total', 'tipo_alerta');

        $chartAlertasLabels = $alertasPorTipo->keys()->toArray();
        $chartAlertasData = $alertasPorTipo->values()->toArray();

        if (empty($chartAlertasLabels)) {
            $chartAlertasLabels = ['Sin alertas'];
            $chartAlertasData = [0];
        }

        // 3. Mediciones por día (Últimos 7 días)
        $diasSemana = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
        $chartMedicionesLabels = [];
        $chartMedicionesData = [];

        for ($i = 6; $i >= 0; $i--) {
            $fecha = now()->subDays($i);
            $nombreDia = $diasSemana[$fecha->dayOfWeek];
            $count = VitalSign::whereDate('created_at', $fecha->toDateString())->count();

            $chartMedicionesLabels[] = $nombreDia . ' ' . $fecha->format('d/m');
            $chartMedicionesData[] = $count;
        }

        return view('dashboard', [
            'internosActivos' => Resident::where('estado', 'Estable')->count(),
            'usuariosTotales' => User::where('estado', 'active')->count(),
            'incidenciasPendientes' => Incident::whereIn('estado', ['Pendiente', 'pendiente'])->count(),
            'ultimasIncidencias' => Incident::with('resident')->whereIn('estado', ['Pendiente', 'pendiente'])->latest()->take(3)->get(),
            'ultimasAlertas' => Alert::with('Resident')->latest()->take(3)->get(),
            'alertasPendientes' => Alert::whereIn('estado', ['Pendiente', 'pendiente', 'Activa', 'activa'])->count(),
            'medicamentosActivos' => MedicationController::countActive(),
            'altasRecientes' => Resident::where('created_at', '>=', now()->subDays(3))->count(),
            'chartIncidenciasLabels' => $chartIncidenciasLabels,
            'chartIncidenciasData' => $chartIncidenciasData,
            'chartAlertasLabels' => $chartAlertasLabels,
            'chartAlertasData' => $chartAlertasData,
            'chartMedicionesLabels' => $chartMedicionesLabels,
            'chartMedicionesData' => $chartMedicionesData,
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

        $user = $request->user();

        $query = Resident::query()
            ->when($search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nombre', 'like', "%{$search}%")
                        ->orWhere('apellido_paterno', 'like', "%{$search}%")
                        ->orWhere('apellido_materno', 'like', "%{$search}%");
                });
            })
            ->when($estado, fn ($q) => $q->where('estado', $estado))
            ->when($user && $user->rol && $user->rol->nombre === 'Familiar', fn ($q) => $q->whereHas(
                'familyLinks',
                fn ($link) => $link->where('usuario_id', $user->id)->where('estado', 'active')
            ))
            ->orderBy('id', 'desc');

        if ($request->wantsJson() || $request->is('api/*')) {
            $paginator = $query->paginate($request->perPage(), page: $request->page());
            return ApiResponse::paginated('GEN-0001', 'Listado obtenido correctamente', $paginator, fn (Resident $resident) => new ResidentResource($resident));
        }

        $internos = $query->paginate(5)->withQueryString();

        return view('internos.index', compact('internos', 'search', 'estado'));
    }

    public function show(\Illuminate\Http\Request $request, int $id): JsonResponse|View|RedirectResponse
    {
        $resident = Resident::with([
            'clinicalHistory', 
            'medications.medication', 
            'vitalSigns' => function ($q) {
                $q->orderBy('created_at', 'desc')->orderBy('id', 'desc');
            },
            'familyLinks.user',
            'alerts.usuario',
            'incidents.cuidador',
            'incidents.administrador'
        ])->find($id);

        if (! $resident) {
            if ($request->wantsJson() || $request->is('api/*')) {
                throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
            }
            return redirect()->route('internos.index')->with('error', 'El interno no existe en el sistema');
        }

        if ($request->wantsJson() || $request->is('api/*')) {
            ResidentAccess::ensureCanAccess($resident->id, $request->user());

            return ApiResponse::success('GEN-0002', 'Recurso obtenido correctamente', new ResidentResource($resident));
        }

        return view('internos.detalle_interno', compact('resident'));
    }

    public function edit(int $id): View|RedirectResponse
    {
        $resident = Resident::with(['clinicalHistory', 'medications.medication', 'vitalSigns', 'familyLinks.user'])->find($id);

        if (! $resident) {
            return redirect()->route('internos.index')->with('error', 'El interno no existe');
        }

        return view('internos.editar_interno', compact('resident'));
    }

    public function update(UpdateResidentRequest $request, int $id): JsonResponse|RedirectResponse
    {
        $resident = Resident::find($id);

        if (! $resident) {
            if ($request->wantsJson() || $request->is('api/*')) {
                throw new ApiException('INT-1001', 'El interno no existe en el sistema', 404);
            }
            return redirect()->route('internos.index')->with('error', 'El interno no existe en el sistema');
        }

        $rawSexo = $request->input('sexo');
        $sexo = match ($rawSexo) {
            'Masculino' => 'M',
            'Femenino' => 'F',
            default => $rawSexo,
        };

        $resident->fill([
            'nombre' => $request->input('nombre'),
            'apellido_paterno' => $request->input('apellido_paterno'),
            'apellido_materno' => $request->input('apellido_materno'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'sexo' => $sexo,
        ]);

        if ($request->filled('fecha_ingreso')) {
            $resident->fecha_ingreso = $request->input('fecha_ingreso');
        }

        if ($request->filled('estado')) {
            $resident->estado = $request->input('estado');
        }

        $resident->save();

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
            if ($resident->clinicalHistory) {
                $clinicalHistoryData['updated_by'] = auth()->id();
                $resident->clinicalHistory->update($clinicalHistoryData);
            } else {
                $clinicalHistoryData['created_by'] = auth()->id();
                $resident->clinicalHistory()->create($clinicalHistoryData);
            }
        }

        if ($request->wantsJson() || $request->is('api/*')) {
            return ApiResponse::success('INT-0006', 'Interno actualizado correctamente', ['id' => $resident->id]);
        }

        return redirect()->route('internos.editar_interno', ['id' => $resident->id])->with('success', 'El interno se ha actualizado correctamente.');
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
