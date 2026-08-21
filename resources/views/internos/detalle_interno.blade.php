<style>
    .editar-interno {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.625rem 1.25rem;
        background-color: #355C7D;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.875rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(53, 92, 125, 0.2);
        transition: all 150ms ease-in-out;
        text-decoration: none;
    }

    .editar-interno:hover {
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53, 92, 125, 0.3);
        color: #ffffff;
    }

    .editar-interno:active {
        background-color: #20394E;
    }
</style>
<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6" x-data="{ tab: 'datos' }">

            <!-- HEADER: Nombre + Botón Editar -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        {{ $resident->nombre }} {{ $resident->apellido_paterno }} {{ $resident->apellido_materno }}
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">Detalles del Interno #{{ $resident->id }}</p>
                    <p class="text-slate-400 text-xs mt-0.5">Ingresó el {{ $resident->fecha_ingreso ? $resident->fecha_ingreso->format('d/m/Y') : 'Sin fecha registrada' }}</p>
                </div>

                <a href="{{ route('internos.editar_interno', ['id' => $resident->id]) }}" class="editar-interno">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar interno
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
                            <h3 class="text-xl font-extrabold text-[#0C3B5E]">¡Operación Exitosa!</h3>
                            <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                                {{ session('success') }}
                            </p>
                        </div>

                        <div class="pt-2">
                            <button @click="open = false" type="button" class="w-full py-2.5 px-4 bg-[#355C7D] hover:bg-[#2A4A66] text-white font-bold text-sm rounded-xl transition duration-150 shadow-md shadow-[#355C7D]/20">
                                Entendido
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- TABS -->
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm">
                <div class="flex flex-wrap gap-1 p-2 border-b border-slate-100">
                    <button @click="tab = 'datos'" :class="tab === 'datos' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Datos generales
                    </button>
                    <button @click="tab = 'historial'" :class="tab === 'historial' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Historial clínico
                    </button>
                    <button @click="tab = 'medicamentos'" :class="tab === 'medicamentos' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Medicamentos
                    </button>
                    <button @click="tab = 'mediciones'" :class="tab === 'mediciones' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Mediciones
                    </button>
                    <button @click="tab = 'alertas'" :class="tab === 'alertas' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Alertas
                    </button>
                    <button @click="tab = 'incidencias'" :class="tab === 'incidencias' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Incidencias
                    </button>
                    <button @click="tab = 'familiares'" :class="tab === 'familiares' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Familiares
                    </button>
                </div>

                <!-- CONTENIDO DE CADA PESTAÑA -->
                <div class="p-6 md:p-8">

                    <!-- DATOS GENERALES -->
                    <div x-show="tab === 'datos'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Datos generales</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre completo</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                    {{ $resident->nombre }} {{ $resident->apellido_paterno }} {{ $resident->apellido_materno }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de nacimiento</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                   {{ $resident->fecha_nacimiento ? $resident->fecha_nacimiento->format('d/m/Y') : 'Sin fecha registrada' }} {{ $resident->fecha_nacimiento ? '('.$resident->fecha_nacimiento->age.' años)' : '' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Sexo</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                    {{ $resident->sexo === 'M' ? 'Masculino' : ($resident->sexo === 'F' ? 'Femenino' : ($resident->sexo ?? 'No especificado')) }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                <div class="pt-1">
                                    @php
                                        $badgeStyle = match($resident->estado) {
                                            'Atención especial' => 'bg-rose-100 text-rose-700 border-rose-200',
                                            'En observación' => 'bg-amber-100 text-amber-700 border-amber-200',
                                            default => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                        };
                                    @endphp
                                    <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold border {{ $badgeStyle }}">
                                        {{ $resident->estado ?? 'Estable' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HISTORIAL CLÍNICO -->
                    <div x-show="tab === 'historial'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Historial clínico</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de sangre</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                    {{ $resident->clinicalHistory?->tipo_sangre ?? 'No especificado' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Peso / Estatura</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                    {{ $resident->clinicalHistory?->peso ? $resident->clinicalHistory->peso . ' kg' : '-' }} / {{ $resident->clinicalHistory?->estatura ? $resident->clinicalHistory->estatura . ' cm' : '-' }}
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Alergias</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 min-h-[60px]">
                                    {{ $resident->clinicalHistory?->alergias ?? 'Sin alergias registradas' }}
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Padecimientos</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 min-h-[60px]">
                                    {{ $resident->clinicalHistory?->padecimientos ?? 'Sin padecimientos registrados' }}
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Observaciones generales</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 min-h-[60px]">
                                    {{ $resident->clinicalHistory?->observaciones ?? 'Sin observaciones registradas' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- MEDICAMENTOS -->
                    <div x-show="tab === 'medicamentos'" x-cloak>
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold text-[#0C3B5E]">Medicamentos asignados</h2>
                            <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                                {{ $resident->medications->count() }} Prescripción(es)
                            </span>
                        </div>

                        @if($resident->medications && $resident->medications->count() > 0)
                            <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-xs">
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
                                                $isActive = in_array(strtolower($prescripcion->estado), ['active', 'activo']);
                                                $badgeClass = $isActive 
                                                    ? 'bg-emerald-50 text-emerald-700 border-emerald-200' 
                                                    : 'bg-slate-100 text-slate-500 border-slate-200';
                                            @endphp
                                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                                <td class="py-3.5 px-4 font-semibold text-slate-800">
                                                    <div class="flex items-center space-x-3">
                                                        <span class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center font-bold text-sm shrink-0">
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

                    <!-- MEDICIONES -->
                    <div x-show="tab === 'mediciones'" x-cloak>
                        <div class="flex items-center justify-between mb-5">
                            <div>
                                <h2 class="text-lg font-bold text-[#0C3B5E]">Mediciones y Signos Vitales</h2>
                                <p class="text-xs text-slate-500 mt-0.5">Lecturas obtenidas desde la base de datos y sensores de la tabla mediciones</p>
                            </div>
                            <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                                {{ $resident->vitalSigns ? $resident->vitalSigns->count() : 0 }} Registro(s)
                            </span>
                        </div>

                        @if($resident->vitalSigns && $resident->vitalSigns->count() > 0)
                            @php
                                $ultima = $resident->vitalSigns->first();
                            @endphp

                            <!-- TARJETAS CON LA ÚLTIMA LECTURA REGISTRADA -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Última lectura registrada</h3>
                                    <span class="text-xs text-slate-500 font-medium">
                                        {{ $ultima->created_at ? $ultima->created_at->format('d/m/Y H:i') : 'Reciente' }}
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                                    <!-- Frecuencia Cardíaca -->
                                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs flex flex-col justify-between">
                                        <div class="flex items-center justify-between text-slate-400 mb-2">
                                            <span class="text-xs font-bold text-slate-600">Frecuencia</span>
                                        </div>
                                        <div>
                                            <div class="text-xl font-extrabold text-[#0C3B5E]">
                                                {{ $ultima->frecuencia_cardiaca ?? '--' }}
                                                <span class="text-xs font-normal text-slate-500">bpm</span>
                                            </div>
                                            <span class="text-[10px] text-slate-400 block mt-1">Ritmo cardíaco</span>
                                        </div>
                                    </div>

                                    <!-- Presión Arterial -->
                                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs flex flex-col justify-between">
                                        <div class="flex items-center justify-between text-slate-400 mb-2">
                                            <span class="text-xs font-bold text-slate-600">Presión</span>
                                        </div>
                                        <div>
                                            <div class="text-xl font-extrabold text-[#0C3B5E]">
                                                {{ $ultima->presion_arterial ?? '--' }}
                                            </div>
                                            <span class="text-[10px] text-slate-400 block mt-1">mmHg</span>
                                        </div>
                                    </div>

                                    <!-- SpO2 -->
                                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs flex flex-col justify-between">
                                        <div class="flex items-center justify-between text-slate-400 mb-2">
                                            <span class="text-xs font-bold text-slate-600">Oxígeno</span>
                                        </div>
                                        <div>
                                            <div class="text-xl font-extrabold text-[#0C3B5E]">
                                                {{ $ultima->saturacion_oxigeno ? $ultima->saturacion_oxigeno . '%' : '--' }}
                                            </div>
                                            <span class="text-[10px] text-slate-400 block mt-1">Saturación SpO2</span>
                                        </div>
                                    </div>

                                    <!-- Temperatura -->
                                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs flex flex-col justify-between">
                                        <div class="flex items-center justify-between text-slate-400 mb-2">
                                            <span class="text-xs font-bold text-slate-600">Temperatura</span>
                                        </div>
                                        <div>
                                            <div class="text-xl font-extrabold text-[#0C3B5E]">
                                                {{ $ultima->temperatura ? $ultima->temperatura . '°C' : '--' }}
                                            </div>
                                            <span class="text-[10px] text-slate-400 block mt-1">Corporal</span>
                                        </div>
                                    </div>

                                    <!-- Glucosa -->
                                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs flex flex-col justify-between">
                                        <div class="flex items-center justify-between text-slate-400 mb-2">
                                            <span class="text-xs font-bold text-slate-600">Glucosa</span>
                                        </div>
                                        <div>
                                            <div class="text-xl font-extrabold text-[#0C3B5E]">
                                                {{ $ultima->glucosa ? $ultima->glucosa : '--' }}
                                                <span class="text-xs font-normal text-slate-500">mg/dL</span>
                                            </div>
                                            <span class="text-[10px] text-slate-400 block mt-1">Nivel en sangre</span>
                                        </div>
                                    </div>

                                    <!-- Calidad de Aire / Sensor -->
                                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs flex flex-col justify-between">
                                        <div class="flex items-center justify-between text-slate-400 mb-2">
                                            <span class="text-xs font-bold text-slate-600">Aire / Sensor</span>
                                        </div>
                                        <div>
                                            <div class="text-lg font-bold text-[#0C3B5E] truncate">
                                                {{ $ultima->calidad_aire ? $ultima->calidad_aire . ' AQI' : ($ultima->dispositivo_id ?? 'IoT') }}
                                            </div>
                                            <span class="text-[10px] text-slate-400 block mt-1 truncate" title="{{ $ultima->dispositivo_id }}">
                                                Disp: {{ $ultima->dispositivo_id ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TABLA HISTÓRICA DE MEDICIONES -->
                            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                            <th class="py-3.5 px-4">Fecha y Hora</th>
                                            <th class="py-3.5 px-4">Dispositivo</th>
                                            <th class="py-3.5 px-4">Frecuencia Cardíaca</th>
                                            <th class="py-3.5 px-4">Presión Arterial</th>
                                            <th class="py-3.5 px-4">SpO2 (Oxígeno)</th>
                                            <th class="py-3.5 px-4">Temperatura</th>
                                            <th class="py-3.5 px-4">Glucosa</th>
                                            <th class="py-3.5 px-4">Aire (AQI)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        @foreach($resident->vitalSigns as $medicion)
                                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                                <td class="py-3.5 px-4 text-xs font-semibold text-slate-700 whitespace-nowrap">
                                                    {{ $medicion->created_at ? $medicion->created_at->format('d/m/Y H:i') : '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-xs text-slate-600 font-mono">
                                                    {{ $medicion->dispositivo_id ?? 'IoT Sensor' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-800 font-medium">
                                                    {{ $medicion->frecuencia_cardiaca ? $medicion->frecuencia_cardiaca . ' bpm' : '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-800 font-medium">
                                                    {{ $medicion->presion_arterial ?? '-' }}
                                                </td>
                                                <td class="py-3.5 px-4">
                                                    @if($medicion->saturacion_oxigeno)
                                                        @php
                                                            $spo2Class = $medicion->saturacion_oxigeno >= 95 
                                                                ? 'bg-emerald-50 text-emerald-700 border-emerald-200' 
                                                                : ($medicion->saturacion_oxigeno >= 90 
                                                                    ? 'bg-amber-50 text-amber-700 border-amber-200' 
                                                                    : 'bg-rose-50 text-rose-700 border-rose-200');
                                                        @endphp
                                                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $spo2Class }}">
                                                            {{ $medicion->saturacion_oxigeno }}%
                                                        </span>
                                                    @else
                                                        <span class="text-slate-400 text-xs">-</span>
                                                    @endif
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-800 font-medium">
                                                    {{ $medicion->temperatura ? $medicion->temperatura . ' °C' : '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-800 font-medium">
                                                    {{ $medicion->glucosa ? $medicion->glucosa . ' mg/dL' : '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-600 text-xs">
                                                    {{ $medicion->calidad_aire ? $medicion->calidad_aire . ' AQI' : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-slate-200 text-slate-400 text-sm font-medium">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="font-semibold text-slate-600">No se han registrado mediciones para este interno.</p>
                                <p class="text-xs text-slate-400 mt-1">Las lecturas tomadas por los dispositivos IoT de la tabla mediciones aparecerán reflejadas aquí automáticamente.</p>
                            </div>
                        @endif
                    </div>

                    <!-- ALERTAS -->
                    <div x-show="tab === 'alertas'" x-cloak>
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold text-[#0C3B5E]">Alertas del interno</h2>
                            <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                                {{ $resident->alerts ? $resident->alerts->count() : 0 }} Alerta(s)
                            </span>
                        </div>

                        @if($resident->alerts && $resident->alerts->count() > 0)
                            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                            <th class="py-3.5 px-4">Tipo de Alerta</th>
                                            <th class="py-3.5 px-4">Descripción</th>
                                            <th class="py-3.5 px-4">Origen / Reportó</th>
                                            <th class="py-3.5 px-4">Fecha</th>
                                            <th class="py-3.5 px-4 text-center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        @foreach($resident->alerts as $alerta)
                                            @php
                                                $st = strtolower($alerta->estado ?? '');
                                                $badgeClass = match(true) {
                                                    in_array($st, ['activa', 'active', 'pendiente']) => 'bg-rose-50 text-rose-700 border-rose-200',
                                                    in_array($st, ['atendida', 'en_proceso']) => 'bg-amber-50 text-amber-700 border-amber-200',
                                                    in_array($st, ['resuelta', 'resolved', 'cerrada']) => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                    default => 'bg-slate-100 text-slate-600 border-slate-200'
                                                };
                                            @endphp
                                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                                <td class="py-3.5 px-4 font-bold text-slate-800">
                                                    <div class="flex items-center space-x-2.5">
                                                        <span class="w-2.5 h-2.5 rounded-full {{ in_array($st, ['activa', 'active', 'pendiente']) ? 'bg-rose-500 animate-pulse' : 'bg-slate-400' }}"></span>
                                                        <span>{{ $alerta->tipo_alerta ?? 'Alerta Médica' }}</span>
                                                    </div>
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-600 text-xs max-w-xs">
                                                    {{ $alerta->descripcion ?? '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-700 text-xs font-medium">
                                                    {{ $alerta->origen ?? ($alerta->usuario ? ($alerta->usuario->nombre . ' ' . $alerta->usuario->apellido_paterno) : 'Sistema / IoT') }}
                                                </td>
                                                <td class="py-3.5 px-4 text-xs text-slate-500 whitespace-nowrap">
                                                    {{ $alerta->created_at ? $alerta->created_at->format('d/m/Y H:i') : '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold border capitalize {{ $badgeClass }}">
                                                        {{ $alerta->estado ?? 'Pendiente' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-slate-200 text-slate-400 text-sm font-medium">
                                <p>No se han registrado alertas para este interno.</p>
                            </div>
                        @endif
                    </div>

                    <!-- INCIDENCIAS -->
                    <div x-show="tab === 'incidencias'" x-cloak>
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold text-[#0C3B5E]">Incidencias reportadas</h2>
                            <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                                {{ $resident->incidents ? $resident->incidents->count() : 0 }} Incidencia(s)
                            </span>
                        </div>

                        @if($resident->incidents && $resident->incidents->count() > 0)
                            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                            <th class="py-3.5 px-4">Tipo</th>
                                            <th class="py-3.5 px-4">Descripción</th>
                                            <th class="py-3.5 px-4">Prioridad</th>
                                            <th class="py-3.5 px-4">Reportado Por</th>
                                            <th class="py-3.5 px-4">Fecha y Hora</th>
                                            <th class="py-3.5 px-4 text-center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        @foreach($resident->incidents as $incidencia)
                                            @php
                                                $prio = strtolower($incidencia->prioridad ?? '');
                                                $prioClass = match(true) {
                                                    in_array($prio, ['alta', 'critica', 'crítica']) => 'bg-rose-100 text-rose-800 border-rose-200',
                                                    in_array($prio, ['media', 'medium']) => 'bg-amber-100 text-amber-800 border-amber-200',
                                                    default => 'bg-sky-100 text-sky-800 border-sky-200'
                                                };

                                                $stInc = strtolower($incidencia->estado ?? '');
                                                $stClass = match(true) {
                                                    in_array($stInc, ['resuelta', 'cerrada', 'resolved']) => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                    in_array($stInc, ['en_proceso', 'en proceso', 'atendiendo']) => 'bg-amber-50 text-amber-700 border-amber-200',
                                                    default => 'bg-rose-50 text-rose-700 border-rose-200'
                                                };

                                                $reporter = $incidencia->cuidador 
                                                    ? ($incidencia->cuidador->nombre . ' ' . $incidencia->cuidador->apellido_paterno)
                                                    : ($incidencia->administrador ? ($incidencia->administrador->nombre . ' ' . $incidencia->administrador->apellido_paterno) : 'Personal del centro');
                                            @endphp
                                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                                <td class="py-3.5 px-4 font-bold text-slate-800 whitespace-nowrap">
                                                    {{ $incidencia->tipo_incidencia ?? 'Incidencia General' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-600 text-xs max-w-xs">
                                                    {{ $incidencia->descripcion ?? '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 whitespace-nowrap">
                                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold border capitalize {{ $prioClass }}">
                                                        {{ $incidencia->prioridad ?? 'Normal' }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-700 text-xs font-medium whitespace-nowrap">
                                                    {{ $reporter }}
                                                </td>
                                                <td class="py-3.5 px-4 text-xs text-slate-500 whitespace-nowrap">
                                                    {{ $incidencia->fecha_hora ? $incidencia->fecha_hora->format('d/m/Y H:i') : ($incidencia->created_at ? $incidencia->created_at->format('d/m/Y H:i') : '-') }}
                                                </td>
                                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold border capitalize {{ $stClass }}">
                                                        {{ $incidencia->estado ?? 'Pendiente' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-slate-200 text-slate-400 text-sm font-medium">
                                <p>No se han registrado incidencias para este interno.</p>
                            </div>
                        @endif
                    </div>

                    <!-- FAMILIARES -->
                    <div x-show="tab === 'familiares'" x-cloak>
                        <div class="flex items-center justify-between mb-5">
                            <h2 class="text-lg font-bold text-[#0C3B5E]">Familiares vinculados</h2>
                            <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                                {{ $resident->familyLinks ? $resident->familyLinks->count() : 0 }} Familiar(es)
                            </span>
                        </div>

                        @if($resident->familyLinks && $resident->familyLinks->count() > 0)
                            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                            <th class="py-3.5 px-4">Familiar</th>
                                            <th class="py-3.5 px-4">Parentesco</th>
                                            <th class="py-3.5 px-4">Teléfono</th>
                                            <th class="py-3.5 px-4">Correo electrónico</th>
                                            <th class="py-3.5 px-4 text-center">Estado</th>
                                            <th class="py-3.5 px-4 text-right">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        @foreach($resident->familyLinks as $familiarLink)
                                            @php
                                                $userFamiliar = $familiarLink->user ?? $familiarLink->usuario;
                                                $initials = strtoupper(substr($userFamiliar->nombre ?? 'F', 0, 1) . substr($userFamiliar->apellido_paterno ?? 'A', 0, 1));
                                                $isActive = in_array(strtolower($userFamiliar->estado ?? ''), ['active', 'activo']);
                                            @endphp
                                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                                <td class="py-3.5 px-4 font-semibold text-slate-800">
                                                    <div class="flex items-center space-x-3">
                                                        <span class="w-8 h-8 rounded-full bg-[#0C3B5E] text-white flex items-center justify-center font-bold text-xs shrink-0">
                                                            {{ $initials }}
                                                        </span>
                                                        <div>
                                                            <p class="font-bold text-slate-800">
                                                                {{ $userFamiliar->nombre ?? 'Familia' }} {{ $userFamiliar->apellido_paterno ?? '' }} {{ $userFamiliar->apellido_materno ?? '' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3.5 px-4 font-medium text-slate-700">
                                                    <span class="inline-block px-2.5 py-1 bg-slate-100 text-[#0C3B5E] font-semibold text-xs rounded-lg border border-slate-200">
                                                        {{ $familiarLink->parentesco ?? 'Sin registrar' }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-600">
                                                    {{ $userFamiliar->telefono ?? 'Sin teléfono' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-slate-600 text-xs">
                                                    {{ $userFamiliar->correo ?? '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-center">
                                                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $isActive ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-slate-100 text-slate-500 border-slate-200' }}">
                                                        {{ $isActive ? 'Activo' : 'Inactivo' }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4 text-right space-x-3">
                                                    @if($userFamiliar)
                                                        <a href="{{ route('familiar.detalle_familiar', ['id' => $userFamiliar->id]) }}" class="text-[#355C7D] hover:underline font-semibold text-xs">Ver</a>
                                                        <a href="{{ route('familiar.editar_familiar', ['id' => $userFamiliar->id]) }}" class="text-amber-600 hover:underline font-semibold text-xs">Editar</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-slate-200 text-slate-400 text-sm font-medium">
                                <p>No hay familiares vinculados a este interno actualmente.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>