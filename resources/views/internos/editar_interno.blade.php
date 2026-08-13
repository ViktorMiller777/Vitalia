<style>
    .guardar-cambios {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.625rem 1.5rem;
        background-color: #355C7D;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.875rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(53, 92, 125, 0.2);
        transition: all 150ms ease-in-out;
        border: none;
        cursor: pointer;
        margin: 10px;
    }

    .guardar-cambios:hover {
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53, 92, 125, 0.3);
        color: #ffffff;
    }

    .guardar-cambios:active {
        background-color: #20394E;
    }

    .ver-detalles {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 1;
        padding: 0.625rem 1rem;
        background-color: #355C7D;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.875rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(53, 92, 125, 0.2);
        transition: all 150ms ease-in-out;
        text-decoration: none;
    }

    .ver-detalles:hover {
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53, 92, 125, 0.3);
        color: #ffffff;
    }

    .ver-detalles:active {
        background-color: #20394E;
    }
</style>
<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Editar Historial Clínico
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Actualización de información médica del interno
                    </p>
                </div>
                <a href="{{ route('internos.detalle_interno', ['id' => $resident->id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-xl text-sm font-semibold transition duration-150 shadow-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a detalles
                </a>
            </div>

            <!-- MODAL DE ÉXITO DE ACTUALIZACIÓN -->
            @if (session('success'))
                <div x-data="{ open: true }" x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-xs p-4 transition-all duration-300">
                    <div @click.away="open = false" class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full shadow-2xl border border-slate-100 transform transition-all text-center space-y-5 animate-in fade-in zoom-in duration-200">
                        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-inner">
                            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-extrabold text-[#0C3B5E]">¡Interno Editado Correctamente!</h3>
                            <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                                {{ session('success') }}
                            </p>
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row gap-3">
                            <button @click="open = false" type="button" class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition duration-150">
                                Continuar editando
                            </button>
                            <a href="{{ route('internos.detalle_interno', ['id' => $resident->id]) }}" class="ver-detalles">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ERRORES DE VALIDACIÓN -->
            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-sm shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-bold">Hubo un problema al guardar los cambios:</p>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 ml-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('internos.update', ['id' => $resident->id]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- SECCIÓN 1: INFORMACIÓN DEL INTERNO -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del interno</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $resident->nombre) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('nombre') border-rose-500 @enderror">
                            @error('nombre') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                            <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $resident->apellido_paterno) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_paterno') border-rose-500 @enderror">
                            @error('apellido_paterno') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                            <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $resident->apellido_materno) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_materno') border-rose-500 @enderror">
                            @error('apellido_materno') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $resident->fecha_nacimiento ? $resident->fecha_nacimiento->format('Y-m-d') : '') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('fecha_nacimiento') border-rose-500 @enderror">
                            @error('fecha_nacimiento') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Sexo</label>
                            <select name="sexo" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('sexo') border-rose-500 @enderror">
                                <option value="">Selecciona una opción</option>
                                <option value="M" {{ old('sexo', $resident->sexo) == 'M' || old('sexo', $resident->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo', $resident->sexo) == 'F' || old('sexo', $resident->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('sexo') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                            <select name="estado" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('estado') border-rose-500 @enderror">
                                <option value="Estable" {{ old('estado', $resident->estado) == 'Estable' ? 'selected' : '' }}>Estable</option>
                                <option value="En observación" {{ old('estado', $resident->estado) == 'En observación' ? 'selected' : '' }}>En observación</option>
                                <option value="Atención especial" {{ old('estado', $resident->estado) == 'Atención especial' ? 'selected' : '' }}>Atención especial</option>
                            </select>
                            @error('estado') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de ingreso</label>
                            <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso', $resident->fecha_ingreso ? $resident->fecha_ingreso->format('Y-m-d') : '') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('fecha_ingreso') border-rose-500 @enderror">
                            @error('fecha_ingreso') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 2: DATOS CLÍNICOS -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos clínicos</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de sangre</label>
                            <select name="tipo_sangre" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                <option value="">Selecciona opción (Ej. O+)</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $tipo)
                                    <option value="{{ $tipo }}" {{ old('tipo_sangre', $resident->clinicalHistory?->tipo_sangre) == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Peso (kg)</label>
                            <input type="number" step="0.1" name="peso" value="{{ old('peso', $resident->clinicalHistory?->peso) }}" placeholder="Ej. 70.5" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Estatura (m)</label>
                            <input type="number" step="0.01" name="estatura" value="{{ old('estatura', $resident->clinicalHistory?->estatura) }}" placeholder="Ej. 1.68" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Alergias</label>
                            <input type="text" name="alergias" value="{{ old('alergias', $resident->clinicalHistory?->alergias) }}" placeholder="Ej. Penicilina, Polvo" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Padecimientos</label>
                            <textarea name="padecimientos" rows="3" placeholder="Descripción de padecimientos..." class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">{{ old('padecimientos', $resident->clinicalHistory?->padecimientos) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Antecedentes médicos</label>
                            <textarea name="antecedentes_medicos" rows="3" placeholder="Antecedentes familiares y personales..." class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">{{ old('antecedentes_medicos', $resident->clinicalHistory?->antecedentes_medicos) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Enfermedades crónicas</label>
                            <textarea name="enfermedades_cronicas" rows="3" placeholder="Hipertensión, Diabetes, etc..." class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">{{ old('enfermedades_cronicas', $resident->clinicalHistory?->enfermedades_cronicas) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Cirugías previas</label>
                            <textarea name="cirugias_previas" rows="3" placeholder="Historial de intervenciones quirúrgicas..." class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">{{ old('cirugias_previas', $resident->clinicalHistory?->cirugias_previas) }}</textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Observaciones generales</label>
                            <textarea name="observaciones_generales" rows="3" placeholder="Notas adicionales u observaciones..." class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">{{ old('observaciones_generales', $resident->clinicalHistory?->observaciones) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 3: FAMILIARES -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Familiares</h2>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">Nombre</th>
                                    <th class="px-4 py-3">Parentesco</th>
                                    <th class="px-4 py-3">Teléfono</th>
                                    <th class="px-4 py-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @if($resident->familyLinks && $resident->familyLinks->count() > 0)
                                    @foreach($resident->familyLinks as $familiar)
                                        <tr class="hover:bg-slate-50 transition duration-150">
                                            <td class="px-4 py-3 font-medium text-slate-700">
                                                {{ $familiar->user?->nombre ?? 'Familia' }} {{ $familiar->user?->apellido_paterno ?? '' }}
                                            </td>
                                            <td class="px-4 py-3 text-slate-600">
                                                {{ $familiar->parentesco ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-slate-600">
                                                {{ $familiar->user?->telefono ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-right space-x-3">
                                                <a href="{{ route('familiar.detalle_familiar', ['id' => $familiar->usuario_id ?? $familiar->user?->id]) }}" class="text-[#355C7D] hover:underline font-semibold">Ver</a>
                                                <a href="{{ route('familiar.editar_familiar', ['id' => $familiar->usuario_id ?? $familiar->user?->id]) }}" class="text-amber-600 hover:underline font-semibold">Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-slate-400">
                                            Sin familiares registrados
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <a href="{{ route('familiar.create') }}" class="w-full mt-4 py-3 rounded-xl border border-dashed border-slate-300 text-slate-500 hover:text-[#355C7D] hover:border-[#355C7D] font-semibold text-sm transition duration-150 flex items-center justify-center">
                        + Agregar familiar
                    </a>
                </div>

                <!-- SECCIÓN 4: MEDICAMENTOS DEL INTERNO -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-5">
                        <h2 class="text-lg font-bold text-[#0C3B5E]">Medicamentos del interno</h2>
                        <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                            {{ $resident->medications ? $resident->medications->count() : 0 }} Prescripción(es)
                        </span>
                    </div>

                    @if($resident->medications && $resident->medications->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-slate-200">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                        <th class="py-3.5 px-4">Medicamento</th>
                                        <th class="py-3.5 px-4">Dosis</th>
                                        <th class="py-3.5 px-4">Frecuencia</th>
                                        <th class="py-3.5 px-4">Periodo</th>
                                        <th class="py-3.5 px-4 text-center">Estado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    @foreach($resident->medications as $prescripcion)
                                        @php
                                            $med = $prescripcion->medication;
                                            $isActive = in_array(strtolower($prescripcion->estado ?? ''), ['active', 'activo']);
                                            $badgeClass = $isActive 
                                                ? 'bg-emerald-50 text-emerald-700 border-emerald-200' 
                                                : 'bg-slate-100 text-slate-500 border-slate-200';
                                        @endphp
                                        <tr class="hover:bg-slate-50/70 transition duration-150">
                                            <td class="py-3.5 px-4 font-semibold text-slate-800">
                                                <div class="flex items-center space-x-3">
                                                    <span class="w-7 h-7 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-xs shrink-0">
                                                        💊
                                                    </span>
                                                    <div>
                                                        <p class="font-bold text-slate-800">{{ $med->nombre ?? 'Medicamento #'.$prescripcion->medicamento_id }}</p>
                                                        <p class="text-xs text-slate-400 font-normal">{{ $med->presentacion ?? '' }} {{ $med->concentracion ? '• '.$med->concentracion : '' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                                {{ $prescripcion->dosis }}
                                            </td>
                                            <td class="py-3.5 px-4 text-slate-600">
                                                {{ $prescripcion->frecuencia }}
                                            </td>
                                            <td class="py-3.5 px-4 text-xs text-slate-500">
                                                {{ $prescripcion->fecha_inicio ? $prescripcion->fecha_inicio->format('d/m/Y') : '-' }} 
                                                hasta 
                                                {{ $prescripcion->fecha_fin ? $prescripcion->fecha_fin->format('d/m/Y') : 'Indefinido' }}
                                            </td>
                                            <td class="py-3.5 px-4 text-center">
                                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $badgeClass }}">
                                                    {{ $isActive ? 'Activo' : 'Finalizado' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-8 text-center bg-slate-50 rounded-2xl border border-slate-200 text-slate-400 text-sm font-medium">
                            <p>No hay medicamentos asignados a este interno actualmente.</p>
                        </div>
                    @endif
                </div>

                <!-- SECCIÓN 5: MEDICIONES DEL INTERNO -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3 mb-5">
                        <h2 class="text-lg font-bold text-[#0C3B5E]">Mediciones del interno</h2>
                        <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                            {{ $resident->vitalSigns ? $resident->vitalSigns->count() : 0 }} Registro(s)
                        </span>
                    </div>

                    @if($resident->vitalSigns && $resident->vitalSigns->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-slate-200">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                        <th class="py-3.5 px-4">Fecha / Hora</th>
                                        <th class="py-3.5 px-4">Presión Arterial</th>
                                        <th class="py-3.5 px-4">Frec. Cardíaca</th>
                                        <th class="py-3.5 px-4">Temperatura</th>
                                        <th class="py-3.5 px-4">O₂ Sat</th>
                                        <th class="py-3.5 px-4">Glucosa</th>
                                        <th class="py-3.5 px-4">Calidad Aire</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    @foreach($resident->vitalSigns as $medicion)
                                        <tr class="hover:bg-slate-50/70 transition duration-150">
                                            <td class="py-3.5 px-4 font-semibold text-slate-700 text-xs">
                                                {{ $medicion->created_at ? $medicion->created_at->format('d/m/Y H:i') : '-' }}
                                            </td>
                                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                                {{ $medicion->presion_arterial ?? '-' }} <span class="text-xs text-slate-400">mmHg</span>
                                            </td>
                                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                                {{ $medicion->frecuencia_cardiaca ?? '-' }} <span class="text-xs text-slate-400">bpm</span>
                                            </td>
                                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                                {{ $medicion->temperatura ?? '-' }} <span class="text-xs text-slate-400">°C</span>
                                            </td>
                                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                                {{ $medicion->saturacion_oxigeno ?? '-' }} <span class="text-xs text-slate-400">%</span>
                                            </td>
                                            <td class="py-3.5 px-4 font-medium text-slate-700">
                                                {{ $medicion->glucosa ?? '-' }} <span class="text-xs text-slate-400">mg/dL</span>
                                            </td>
                                            <td class="py-3.5 px-4 text-xs text-slate-600">
                                                {{ $medicion->calidad_aire ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-8 text-center bg-slate-50 rounded-2xl border border-slate-200 text-slate-400 text-sm font-medium">
                            <p>No hay mediciones o signos vitales registrados para este interno actualmente.</p>
                        </div>
                    @endif
                </div>

                <!-- BOTONES DE ACCIÓN -->
                <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm px-6 py-5 flex items-center justify-end gap-4">
                    <a href="{{ route('internos.detalle_interno', ['id' => $resident->id]) }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition duration-150">
                        Cancelar
                    </a>
                    <button type="submit" class="guardar-cambios">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Guardar cambios
                    </button>
                </div>

            </form>
        </main>
    </div>
</x-app-layout>