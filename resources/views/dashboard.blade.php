<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        
        <!-- SIDEBAR DE NAVEGACIÓN -->
        <x-sidebar />

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 p-6 md:p-10 space-y-8">

            @if (session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-sm font-medium flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700 text-sm font-medium flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- 1. STATS / KPI CARDS GRID (5 Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Internos activos -->
                <a href="{{ route('internos.index') }}" class="block bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md hover:border-[#4EBA87]/60 transition duration-200 group cursor-pointer">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500 group-hover:text-[#0C3B5E] uppercase tracking-wider transition-colors">Internos activos</span>
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 group-hover:bg-[#4EBA87] group-hover:text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-extrabold text-[#0C3B5E] group-hover:text-[#4EBA87] transition-colors">{{ $internosActivos }}</span>
                        <span class="ml-2 text-xs font-medium text-emerald-600 flex items-center">
                            <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            Ver lista →
                        </span>
                    </div>
                </a>

                <!-- Usuarios totales -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-200">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Usuarios totales</span>
                        <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-extrabold text-[#0C3B5E]">{{ $usuariosTotales }}</span>
                        <span class="ml-2 text-xs font-medium text-slate-400">Personal & Admins</span>
                    </div>
                </div>

                <!-- Incidencias pendientes -->
                <div class="bg-white border border-rose-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-200 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-2 h-full bg-rose-500"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Incidencias pendientes</span>
                        <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-extrabold text-rose-600">{{ $incidenciasPendientes}}</span>
                        <span class="ml-2 text-xs font-semibold text-rose-500 bg-rose-50 px-2 py-0.5 rounded-full">Requieren atención</span>
                    </div>
                </div>

                <!-- Medicamentos activos -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-200">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Medicamentos activos</span>
                        <div class="w-8 h-8 rounded-xl bg-emerald-50 text-[#4EBA87] flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L5.6 15.12a2 2 0 00-1.18.239l-.49.294a2 2 0 00-.73 2.616l.24.4a2 2 0 002.616.73l.49-.294a6 6 0 013.86-.517l.318-.158a6 6 0 003.86-.517l2.387.477a2 2 0 002.106-1.572l.24-.4a2 2 0 00-.573-2.308z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-extrabold text-[#0C3B5E]">{{ $medicamentosActivos }}</span>
                        <span class="ml-2 text-xs font-medium text-emerald-600">En receta</span>
                    </div>
                </div>

                <!-- Altas recientes -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm hover:shadow-md transition duration-200">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Altas recientes</span>
                        <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-extrabold text-[#0C3B5E]">3</span>
                        <span class="ml-2 text-xs font-medium text-slate-400">Este mes</span>
                    </div>
                </div>
            </div>

            <!-- 2. ALERTAS RECIENTES SECTION -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-3 h-3 rounded-full bg-rose-500 animate-pulse"></div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] tracking-tight">Alertas recientes</h2>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse ($ultimasAlertas as $alerta)
                        @php
                            $colorClasses = match($alerta->estado) {
                                'Activa' => 'bg-rose-50/60 border-rose-200/80 hover:bg-rose-50',
                                'Atendida' => 'bg-emerald-50/50 border-emerald-200/70 hover:bg-emerald-50',
                                'Descartada' => 'bg-slate-50/60 border-slate-200/80 hover:bg-slate-50',
                                default => 'bg-slate-50/60 border-slate-200/80 hover:bg-slate-50',
                            };

                            $badgeClasses = match($alerta->estado) {
                                'Activa' => 'text-rose-700 border-rose-200',
                                'Atendida' => 'text-emerald-700 border-emerald-200',
                                'Descartada' => 'text-slate-500 border-slate-200',
                                default => 'text-slate-500 border-slate-200',
                            };

                            $icono = match($alerta->estado) {
                                'Activa' => '🌡️',
                                'Atendida' => '✅',
                                'Descartada' => '🚫',
                                default => '❓',
                            };
                        @endphp

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 {{ $colorClasses }} border rounded-2xl transition">
                            <div class="flex items-center space-x-3">
                                <span class="flex-shrink-0 w-8 h-8 rounded-xl bg-white text-lg flex items-center justify-center font-bold text-sm">
                                    {{ $icono }}
                                </span>
                                <div>
                                    <h3 class="text-sm font-bold text-slate-800">
                                        {{ $alerta->tipo_alerta }}@if($alerta->interno): Interno {{ $alerta->interno->id }}@endif
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        {{ $alerta->descripcion }} • {{ optional($alerta->created_at)->diffForHumans() ?? 'Sin fecha' }}
                                    </p>
                                </div>
                            </div>
                            <span class="mt-2 sm:mt-0 text-xs font-semibold {{ $badgeClasses }} bg-white px-3 py-1 rounded-lg border text-center">
                                {{ $alerta->estado }}
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400 text-center py-4">No hay alertas registradas.</p>
                    @endforelse
                </div>

                <!-- Footer Link -->
                <div class="mt-6 pt-3 border-t border-slate-100 text-left">
                    <a href="{{ route('alertas.index') }}" class="inline-flex items-center text-sm font-semibold text-[#0C3B5E] hover:text-[#4EBA87] transition duration-200 group">
                        <span>Ver todas las alertas</span>
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- 3. INCIDENCIAS PENDIENTES DE APROBACIÓN SECTION -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-[#0C3B5E] tracking-tight">Incidencias pendientes de aprobación</h2>
                    <span class="text-xs font-medium text-slate-500">{{ $incidenciasPendientes ?? count($ultimasIncidencias) }} Registros</span>
                </div>

                <div class="space-y-3">
                    @forelse ($ultimasIncidencias as $incidencia)
                        @php
                            $dotColor = match($incidencia->prioridad) {
                                'Urgente', 'Alta' => 'bg-rose-500',
                                'Media' => 'bg-amber-500',
                                default => 'bg-sky-500',
                            };
                            $fechaFormateada = $incidencia->fecha_hora ? $incidencia->fecha_hora->format('d/m/Y') : ($incidencia->created_at ? $incidencia->created_at->format('d/m/Y') : '');
                            $nombreInterno = $incidencia->resident ? ($incidencia->resident->nombre . ' ' . $incidencia->resident->apellido_paterno) : 'Interno #' . $incidencia->interno_id;
                        @endphp
                        <div class="flex flex-col md:flex-row md:items-center justify-between p-4 bg-slate-50/80 border border-slate-200 rounded-2xl hover:border-slate-300 transition duration-200 gap-4">
                            <div class="flex items-center space-x-3">
                                <span class="flex-shrink-0 w-2.5 h-2.5 rounded-full {{ $dotColor }}"></span>
                                <span class="text-sm font-bold text-slate-800 tracking-wide">
                                    {{ $fechaFormateada }} - {{ $nombreInterno }} - {{ $incidencia->tipo_incidencia }}
                                </span>
                            </div>
                            <div class="flex items-center space-x-3 self-end md:self-auto">
                                <form action="{{ route('incidencias.update-status', ['id' => $incidencia->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="Aprobada">
                                    <button type="submit" class="px-4 py-1.5 bg-[#4EBA87] hover:bg-emerald-600 text-white font-semibold text-xs rounded-xl shadow-sm transition duration-150 cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#4EBA87]/40">
                                        Aprobar
                                    </button>
                                </form>

                                <form action="{{ route('incidencias.update-status', ['id' => $incidencia->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="estado" value="Rechazada">
                                    <button type="submit" class="px-4 py-1.5 bg-white hover:bg-rose-50 text-rose-600 border border-rose-200 font-semibold text-xs rounded-xl transition duration-150 cursor-pointer focus:outline-none focus:ring-2 focus:ring-rose-200">
                                        Rechazar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-400 text-sm font-medium bg-slate-50 rounded-2xl border border-slate-200">
                            No hay incidencias pendientes registradas.
                        </div>
                    @endforelse
                </div>

                <!-- Footer Link -->
                <div class="mt-6 pt-3 border-t border-slate-100 text-left">
                    <a href="{{ route('incidencias.index') }}" class="inline-flex items-center text-sm font-semibold text-[#0C3B5E] hover:text-[#4EBA87] transition duration-200 group">
                        <span>Ver todas las incidencias</span>
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- 4. CHARTS / GRÁFICOS SECTION (3 GRAPHS IN A GRID) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Gráfico 1: Incidencias por tipo -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-[#0C3B5E]">Incidencias por tipo (gráfico)</h3>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase">Mensual</span>
                    </div>
                    <div class="relative h-60 w-full flex items-center justify-center">
                        <canvas id="chartIncidencias"></canvas>
                    </div>
                </div>

                <!-- Gráfico 2: Alertas por tipo -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-[#0C3B5E]">Alertas por tipo (gráfico)</h3>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase">Distribución</span>
                    </div>
                    <div class="relative h-60 w-full flex items-center justify-center">
                        <canvas id="chartAlertas"></canvas>
                    </div>
                </div>

                <!-- Gráfico 3: Mediciones por interno -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-[#0C3B5E]">Mediciones por interno (gráfico)</h3>
                        <span class="text-[11px] font-semibold text-slate-400 uppercase">Semanal</span>
                    </div>
                    <div class="relative h-60 w-full flex items-center justify-center">
                        <canvas id="chartMediciones"></canvas>
                    </div>
                </div>
            </div>

            <!-- 5. ÚLTIMAS ACTIVIDADES SECTION -->
            <div class="bg-white border border-slate-200/80 rounded-3xl p-6 sm:p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-[#0C3B5E] tracking-tight">Últimas actividades</h2>
                    <span class="text-xs font-semibold text-slate-400">Hoy</span>
                </div>

                <div class="space-y-4">
                    <!-- Actividad 1 -->
                    <div class="flex items-start space-x-3.5">
                        <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-slate-100 text-[#0C3B5E] flex items-center justify-center font-bold text-xs">
                            10:30
                        </div>
                        <div class="pt-1">
                            <p class="text-sm font-semibold text-slate-800">Cuidador registró medición</p>
                            <p class="text-xs text-slate-500">Signos vitales de Interno 4 actualizados</p>
                        </div>
                    </div>

                    <!-- Actividad 2 -->
                    <div class="flex items-start space-x-3.5">
                        <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-slate-100 text-[#0C3B5E] flex items-center justify-center font-bold text-xs">
                            09:45
                        </div>
                        <div class="pt-1">
                            <p class="text-sm font-semibold text-slate-800">Medicamento administrado</p>
                            <p class="text-xs text-slate-500">Dosis matutina de Interno 2 completada</p>
                        </div>
                    </div>

                    <!-- Actividad 3 -->
                    <div class="flex items-start space-x-3.5">
                        <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-slate-100 text-[#0C3B5E] flex items-center justify-center font-bold text-xs">
                            09:00
                        </div>
                        <div class="pt-1">
                            <p class="text-sm font-semibold text-slate-800">Incidencia aprobada</p>
                            <p class="text-xs text-slate-500">Incidencia #104 autorizada por administración</p>
                        </div>
                    </div>

                    <!-- Actividad 4 -->
                    <div class="flex items-start space-x-3.5">
                        <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-slate-100 text-[#0C3B5E] flex items-center justify-center font-bold text-xs">
                            08:30
                        </div>
                        <div class="pt-1">
                            <p class="text-sm font-semibold text-slate-800">Alerta generada</p>
                            <p class="text-xs text-slate-500">Alerta preventiva de temperatura para Interno 3</p>
                        </div>
                    </div>

                    <!-- Actividad 5 -->
                    <div class="flex items-start space-x-3.5">
                        <div class="flex-shrink-0 w-8 h-8 rounded-xl bg-slate-100 text-[#0C3B5E] flex items-center justify-center font-bold text-xs">
                            08:00
                        </div>
                        <div class="pt-1">
                            <p class="text-sm font-semibold text-slate-800">Nuevo usuario registrado</p>
                            <p class="text-xs text-slate-500">Nuevo personal de enfermería registrado en sistema</p>
                        </div>
                    </div>
                </div>

                <!-- Footer Link -->
                <div class="mt-6 pt-3 border-t border-slate-100 text-left">
                    <a href="#" class="inline-flex items-center text-sm font-semibold text-[#0C3B5E] hover:text-[#4EBA87] transition duration-200 group">
                        <span>Ver todas las actividades</span>
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

        </main>
    </div>

    <!-- Chart.js Scripts Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart 1: Incidencias por tipo (Bar Chart)
            const ctxIncidencias = document.getElementById('chartIncidencias');
            if (ctxIncidencias) {
                new Chart(ctxIncidencias, {
                    type: 'bar',
                    data: {
                        labels: ['Caída', 'Fiebre', 'Dolor', 'Presión', 'Otro'],
                        datasets: [{
                            label: 'Incidencias',
                            data: [8, 5, 6, 3, 2],
                            backgroundColor: ['#0C3B5E', '#4EBA87', '#38BDF8', '#F59E0B', '#94A3B8'],
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { color: '#F1F5F9' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            // Chart 2: Alertas por tipo (Doughnut Chart)
            const ctxAlertas = document.getElementById('chartAlertas');
            if (ctxAlertas) {
                new Chart(ctxAlertas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Temperatura', 'Glucosa', 'Presión', 'Frecuencia'],
                        datasets: [{
                            data: [40, 25, 20, 15],
                            backgroundColor: ['#EF4444', '#F59E0B', '#0C3B5E', '#4EBA87'],
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
                        },
                        cutout: '70%'
                    }
                });
            }

            // Chart 3: Mediciones por interno (Line Chart)
            const ctxMediciones = document.getElementById('chartMediciones');
            if (ctxMediciones) {
                new Chart(ctxMediciones, {
                    type: 'line',
                    data: {
                        labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                        datasets: [{
                            label: 'Mediciones completadas',
                            data: [12, 19, 15, 22, 20, 18, 25],
                            borderColor: '#4EBA87',
                            backgroundColor: 'rgba(78, 186, 135, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#0C3B5E',
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true, grid: { color: '#F1F5F9' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>