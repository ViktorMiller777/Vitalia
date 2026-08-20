<style>
    .button-blue {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.625rem 1.25rem;
        background-color: #355C7D;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.875rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(53,92,125,0.2), 0 2px 4px -2px rgba(53,92,125,0.2);
        transition: background-color 0.15s ease, box-shadow 0.15s ease;
        cursor: pointer;
        text-decoration: none;
        width: auto;
    }
    .button-blue:hover {
        background-color: #2a4a66;
        box-shadow: 0 10px 15px -3px rgba(53,92,125,0.25), 0 4px 6px -4px rgba(53,92,125,0.25);
    }
    .button-blue:active {
        background-color: #1e3a52;
    }
    .button-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.625rem 1.25rem;
        background-color: #ffffff;
        color: #475569;
        font-weight: 600;
        font-size: 0.875rem;
        border-radius: 0.75rem;
        border: 1px solid #cbd5e1;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        transition: background-color 0.15s ease;
        cursor: pointer;
        text-decoration: none;
        width: auto;
    }
    .button-outline:hover {
        background-color: #f8fafc;
    }

    /* Colores sólidos puros del sistema sin opacidad */
    .badge-rojo {
        background-color: #D96C6C;
        color: #ffffff;
    }
    .badge-naranja {
        background-color: #E6A23C;
        color: #ffffff;
    }
    .badge-verde {
        background-color: #6C9A8B;
        color: #ffffff;
    }

    .card-rojo {
        background-color: #ffffff;
        border: 2px solid #D96C6C;
    }
    .text-rojo {
        color: #D96C6C;
    }

    .card-naranja {
        background-color: #ffffff;
        border: 2px solid #E6A23C;
    }
    .text-naranja {
        color: #E6A23C;
    }

    .card-verde {
        background-color: #ffffff;
        border: 2px solid #6C9A8B;
    }
    .text-verde {
        color: #6C9A8B;
    }
</style>

<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Incidencias
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Registro y seguimiento de incidencias del centro
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <!-- Botón Exportar -->
                    <a href="#" class="button-outline">
                        <svg style="width:1rem;height:1rem;margin-right:0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Exportar
                    </a>
                    <!-- Botón Nueva incidencia -->
                    <a href="#" class="button-blue">
                        <svg style="width:1rem;height:1rem;margin-right:0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Nueva incidencia
                    </a>
                </div>
            </div>

            <!-- TOOLBAR: FILTROS -->
            <form method="GET" action="{{ route('incidencias.index') }}" class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
                <div class="flex flex-col md:flex-row items-center gap-3">

                    <!-- Buscar -->
                    <div class="relative flex-1 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Buscar incidencia..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200"
                        />
                    </div>

                    <!-- Filtro Estado -->
                    <select name="estado" onchange="this.form.submit()" class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer appearance-none pr-8">
                        <option value="">Estado ▾</option>
                        <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Aprobada" {{ request('estado') == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
                        <option value="Rechazada" {{ request('estado') == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
                        <option value="Resuelta" {{ request('estado') == 'Resuelta' ? 'selected' : '' }}>Resuelta</option>
                    </select>

                    <!-- Filtro Prioridad -->
                    <select name="prioridad" onchange="this.form.submit()" class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer appearance-none pr-8">
                        <option value="">Prioridad ▾</option>
                        <option value="Urgente" {{ request('prioridad') == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                        <option value="Alta" {{ request('prioridad') == 'Alta' ? 'selected' : '' }}>Alta</option>
                        <option value="Media" {{ request('prioridad') == 'Media' ? 'selected' : '' }}>Media</option>
                        <option value="Baja" {{ request('prioridad') == 'Baja' ? 'selected' : '' }}>Baja</option>
                    </select>

                    @if(request('buscar') || request('estado') || request('prioridad'))
                        <a href="{{ route('incidencias.index') }}" class="px-3 py-2 text-xs font-semibold text-rose-600 hover:text-rose-800 transition">
                            Limpiar filtros
                        </a>
                    @endif

                </div>
            </form>

            <!-- TARJETAS ESTADÍSTICAS -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Total -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total</p>
                    <p class="text-3xl font-extrabold text-[#0C3B5E]">{{ $totalIncidencias ?? \App\Models\Incident::count() }}</p>
                </div>
                <!-- Pendientes -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                    <p class="text-xs font-semibold text-amber-500 uppercase tracking-wider mb-1">Pendientes</p>
                    <p class="text-3xl font-extrabold text-amber-600">{{ $pendientes ?? \App\Models\Incident::whereIn('estado', ['Pendiente', 'pendiente'])->count() }}</p>
                </div>
                <!-- Aprobadas -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                    <p class="text-xs font-semibold text-emerald-500 uppercase tracking-wider mb-1">Aprobadas</p>
                    <p class="text-3xl font-extrabold text-emerald-600">{{ $aprobadas ?? \App\Models\Incident::whereIn('estado', ['Aprobada', 'aprobada'])->count() }}</p>
                </div>
                <!-- Rechazadas -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                    <p class="text-xs font-semibold text-rose-400 uppercase tracking-wider mb-1">Rechazadas</p>
                    <p class="text-3xl font-extrabold text-rose-600">{{ $rechazadas ?? \App\Models\Incident::whereIn('estado', ['Rechazada', 'rechazada'])->count() }}</p>
                </div>
                <!-- Resueltas -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                    <p class="text-xs font-semibold text-sky-400 uppercase tracking-wider mb-1">Resueltas</p>
                    <p class="text-3xl font-extrabold text-sky-600">{{ $resueltas ?? \App\Models\Incident::whereIn('estado', ['Resuelta', 'resuelta'])->count() }}</p>
                </div>
            </div>

            <!-- TABLA DE INCIDENCIAS -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">Fecha</th>
                                <th class="py-4 px-6">Interno</th>
                                <th class="py-4 px-6">Tipo</th>
                                <th class="py-4 px-6">Prioridad</th>
                                <th class="py-4 px-6">Cuidador</th>
                                <th class="py-4 px-6">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($incidencias as $incidencia)
                                <tr class="hover:bg-slate-50/60 transition duration-150">
                                    <td class="py-4 px-6 text-slate-500 font-medium whitespace-nowrap">
                                        {{ $incidencia->fecha_hora ? $incidencia->fecha_hora->format('d/m/Y H:i') : ($incidencia->created_at ? $incidencia->created_at->format('d/m/Y H:i') : '-') }}
                                    </td>
                                    <td class="py-4 px-6 font-semibold text-slate-800 whitespace-nowrap">
                                        <div class="flex items-center space-x-2.5">
                                            <div class="w-8 h-8 rounded-full bg-[#0C3B5E] text-white flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                {{ strtoupper(substr($incidencia->resident->nombre ?? 'I', 0, 1) . substr($incidencia->resident->apellido_paterno ?? 'N', 0, 1)) }}
                                            </div>
                                            <span>{{ $incidencia->resident ? ($incidencia->resident->nombre . ' ' . $incidencia->resident->apellido_paterno) : 'Sin asignar' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600 font-medium">
                                        {{ $incidencia->tipo_incidencia }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @php
                                            $prio = strtolower($incidencia->prioridad);
                                            $prioStyle = match($prio) {
                                                'urgente' => 'badge-rojo',
                                                'alta' => 'badge-naranja',
                                                'media' => 'bg-sky-50 text-sky-700 border border-sky-200',
                                                default => 'bg-slate-100 text-slate-600 border border-slate-200'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $prioStyle }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5"></span>
                                            {{ ucfirst($incidencia->prioridad) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600">
                                        {{ $incidencia->cuidador ? ($incidencia->cuidador->nombre . ' ' . $incidencia->cuidador->apellido_paterno) : 'Sin asignación' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @php
                                            $est = strtolower($incidencia->estado);
                                            $estClass = match($est) {
                                                'pendiente' => 'badge-naranja',
                                                'aprobada' => 'badge-verde',
                                                'rechazada' => 'badge-rojo',
                                                'resuelta' => 'bg-sky-50 text-sky-700 border border-sky-200',
                                                default => 'bg-slate-100 text-slate-700 border border-slate-200'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $estClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5"></span>
                                            {{ ucfirst($incidencia->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 px-6 text-center text-slate-500 font-medium">
                                        No se encontraron incidencias registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINACIÓN -->
                <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs font-medium text-slate-500">
                        Mostrando <span class="font-bold text-slate-700">{{ $incidencias->firstItem() ?? 0 }}</span> a <span class="font-bold text-slate-700">{{ $incidencias->lastItem() ?? 0 }}</span> de <span class="font-bold text-slate-700">{{ $incidencias->total() }}</span> incidencias
                    </p>
                    <div class="px-2">
                        {{ $incidencias->links() }}
                    </div>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>
