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
    .detail-panel {
        display: none;
    }
    .detail-panel.active {
        display: block;
    }
    .alert-row {
        cursor: pointer;
    }
    .alert-row.selected {
        background-color: #f0f7ff;
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

    .text-rojo {
        color: #D96C6C;
    }

    .text-naranja {
        color: #E6A23C;
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
                        Alertas
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Monitoreo de alertas de sensores en tiempo real
                    </p>
                </div>
            </div>

            <!-- TOOLBAR: BUSQUEDA Y FILTROS -->
            <form method="GET" action="{{ route('alertas.index') }}" class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Alertas de sensores</p>
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
                            placeholder="Buscar alerta..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200"
                        />
                    </div>

                    <!-- Estado -->
                    <select name="estado" onchange="this.form.submit()" class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer">
                        <option value="">Estado: Todos ▾</option>
                        <option value="Activa" {{ request('estado') == 'Activa' ? 'selected' : '' }}>Activa</option>
                        <option value="Atendida" {{ request('estado') == 'Atendida' ? 'selected' : '' }}>Atendida</option>
                        <option value="Descartada" {{ request('estado') == 'Descartada' ? 'selected' : '' }}>Descartada</option>
                    </select>

                    <!-- Botón Refrescar -->
                    <a href="{{ route('alertas.index') }}" title="Refrescar" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-600 font-semibold text-sm rounded-xl transition duration-150 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </a>

                </div>
            </form>

            <!-- RESUMEN RÁPIDO -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Resumen rápido</p>
                <div class="flex gap-4">
                    <div class="flex-1 bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Activas</p>
                        <p class="text-3xl font-extrabold text-[#0C3B5E]">{{ $activas ?? \App\Models\Alert::whereIn('estado', ['Activa', 'activa', 'Pendiente', 'pendiente'])->count() }}</p>
                    </div>
                    <div class="flex-1 bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-xs font-semibold text-naranja uppercase tracking-wider mb-1">Atendidas</p>
                        <p class="text-3xl font-extrabold text-naranja">{{ $atendidas ?? \App\Models\Alert::whereIn('estado', ['Atendida', 'atendida'])->count() }}</p>
                    </div>
                    <div class="flex-1 bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-xs font-semibold text-verde uppercase tracking-wider mb-1">Descartadas</p>
                        <p class="text-3xl font-extrabold text-verde">{{ $resueltas ?? \App\Models\Alert::whereIn('estado', ['Resuelta', 'resuelta'])->count() }}</p>
                    </div>
                    <div class="flex-1 bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-xs font-semibold text-rojo uppercase tracking-wider mb-1">Críticas</p>
                        <p class="text-3xl font-extrabold text-rojo">{{ $criticas ?? \App\Models\Alert::whereIn('estado', ['Critica', 'critica', 'Crítica'])->count() }}</p>
                    </div>
                    <div class="flex-1 bg-sky-50 border border-sky-100 rounded-xl p-4">
                        <p class="text-xs font-semibold text-sky-400 uppercase tracking-wider mb-1">Última</p>
                        <p class="text-3xl font-extrabold text-sky-600">{{ $ultimaAlerta ?? (\App\Models\Alert::latest()->first()?->created_at?->format('H:i') ?? '--:--') }}</p>
                    </div>
                </div>
            </div>

            <!-- TABLA DE ALERTAS -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">Fecha/Hora</th>
                                <th class="py-4 px-6">Tipo</th>
                                <th class="py-4 px-6">Interno</th>
                                <th class="py-4 px-6">Descripción</th>
                                <th class="py-4 px-6">Origen</th>
                                <th class="py-4 px-6">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($alertas as $alerta)
                                <tr class="alert-row hover:bg-slate-50/60 transition duration-150 cursor-pointer">
                                    <td class="py-4 px-6 text-slate-500 font-medium whitespace-nowrap">
                                        {{ $alerta->created_at ? $alerta->created_at->format('d/m/Y H:i') : '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-slate-700 font-semibold whitespace-nowrap">
                                        {{ $alerta->tipo_alerta }}
                                    </td>
                                    <td class="py-4 px-6 font-semibold text-slate-800 whitespace-nowrap">
                                        <div class="flex items-center space-x-2.5">
                                            <div class="w-8 h-8 rounded-full bg-[#0C3B5E] text-white flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                {{ strtoupper(substr($alerta->resident->nombre ?? 'I', 0, 1) . substr($alerta->resident->apellido_paterno ?? 'N', 0, 1)) }}
                                            </div>
                                            <span>{{ $alerta->resident ? ($alerta->resident->nombre . ' ' . $alerta->resident->apellido_paterno) : 'Sin asignar' }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600 max-w-xs truncate">
                                        {{ $alerta->descripcion }}
                                    </td>
                                    <td class="py-4 px-6 text-slate-500 text-xs font-mono whitespace-nowrap">
                                        {{ $alerta->origen }}
                                    </td>
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        @php
                                            $est = strtolower($alerta->estado);
                                            $estClass = match($est) {
                                                'activa', 'pendiente' => 'badge-rojo',
                                                'atendida' => 'badge-naranja',
                                                'descartada', 'resuelta' => 'badge-verde',
                                                default => 'bg-slate-100 text-slate-700 border border-slate-200'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $estClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5"></span>
                                            {{ ucfirst($alerta->estado) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 px-6 text-center text-slate-500 font-medium">
                                        No se encontraron alertas registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PAGINACIÓN -->
            <div class="bg-white border border-slate-200/80 rounded-2xl px-6 py-4 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs font-medium text-slate-500">
                    Mostrando <span class="font-bold text-slate-700">{{ $alertas->firstItem() ?? 0 }}</span> a <span class="font-bold text-slate-700">{{ $alertas->lastItem() ?? 0 }}</span> de <span class="font-bold text-slate-700">{{ $alertas->total() }}</span> alertas
                </p>
                <div class="px-2">
                    {{ $alertas->links() }}
                </div>
            </div>

        </main>
    </div>

    <script>
        function selectAlert(row, id) {
            document.querySelectorAll('.alert-row').forEach(r => r.classList.remove('selected', 'bg-blue-50/40'));
            row.classList.add('selected');
            document.getElementById('detail-panel').classList.add('active');
        }
    </script>
</x-app-layout>
