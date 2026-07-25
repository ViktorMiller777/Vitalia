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
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
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
                            placeholder="Buscar alerta..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200"
                        />
                    </div>

                    <!-- Estado -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer">
                        <option value="activas">Estado: Activas ▾</option>
                        <option value="todas">Todas</option>
                        <option value="atendida">Atendida</option>
                        <option value="resuelta">Resuelta</option>
                        <option value="critica">Crítica</option>
                    </select>

                    <!-- Tipo -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer">
                        <option value="">Tipo ▾</option>
                        <option>Temperatura</option>
                        <option>Glucosa</option>
                        <option>Presión</option>
                        <option>Frecuencia Cardíaca</option>
                        <option>Oxigenación</option>
                    </select>

                    <!-- Ordenar -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer">
                        <option value="">Ordenar ▾</option>
                        <option>Más reciente</option>
                        <option>Más antigua</option>
                        <option>Criticidad</option>
                    </select>

                    <!-- Botón Refrescar -->
                    <button title="Refrescar" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-600 font-semibold text-sm rounded-xl transition duration-150 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </button>

                </div>
            </div>

            <!-- RESUMEN RÁPIDO -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Resumen rápido</p>
                <div class="flex gap-4">
                    <div class="flex-1 bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Activas</p>
                        <p class="text-3xl font-extrabold text-[#0C3B5E]">8</p>
                    </div>
                    <div class="flex-1 bg-amber-50 border border-amber-100 rounded-xl p-4">
                        <p class="text-xs font-semibold text-amber-500 uppercase tracking-wider mb-1">Atendidas</p>
                        <p class="text-3xl font-extrabold text-amber-600">12</p>
                    </div>
                    <div class="flex-1 bg-emerald-50 border border-emerald-100 rounded-xl p-4">
                        <p class="text-xs font-semibold text-emerald-500 uppercase tracking-wider mb-1">Resueltas</p>
                        <p class="text-3xl font-extrabold text-emerald-600">5</p>
                    </div>
                    <div class="flex-1 bg-rose-50 border border-rose-100 rounded-xl p-4">
                        <p class="text-xs font-semibold text-rose-400 uppercase tracking-wider mb-1">Críticas</p>
                        <p class="text-3xl font-extrabold text-rose-600">2</p>
                    </div>
                    <div class="flex-1 bg-sky-50 border border-sky-100 rounded-xl p-4">
                        <p class="text-xs font-semibold text-sky-400 uppercase tracking-wider mb-1">Última</p>
                        <p class="text-3xl font-extrabold text-sky-600">10:45</p>
                    </div>
                </div>
            </div>

            <!-- TABLA DE ALERTAS -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">ID</th>
                                <th class="py-4 px-6">Fecha/Hora</th>
                                <th class="py-4 px-6">Tipo</th>
                                <th class="py-4 px-6">Interno</th>
                                <th class="py-4 px-6">Valor</th>
                                <th class="py-4 px-6">Límite</th>
                                <th class="py-4 px-6">Origen</th>
                                <th class="py-4 px-6">Estado</th>
                                <th class="py-4 px-6 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">

                            <!-- Fila 1 - Activa/Crítica -->
                            <tr class="alert-row selected hover:bg-slate-50/60 transition duration-150" onclick="selectAlert(this, 'AL-001')">
                                <td class="py-4 px-6 font-bold text-[#0C3B5E]">AL-001</td>
                                <td class="py-4 px-6 text-slate-500 font-medium">23/06/2025 08:00</td>
                                <td class="py-4 px-6 text-slate-700 font-semibold">Temperatura</td>
                                <td class="py-4 px-6 text-slate-600">Juan Pérez G.</td>
                                <td class="py-4 px-6 font-bold text-rose-600">38.5°C</td>
                                <td class="py-4 px-6 text-slate-500">&gt; 37.5°C</td>
                                <td class="py-4 px-6 text-slate-500 text-xs">Sensor_Temp_01</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        Activa
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-1">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">Ver</button>
                                    <button class="px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold text-xs rounded-lg transition duration-150">Estado</button>
                                    <button class="px-3 py-1.5 bg-[#355C7D] hover:bg-[#2a4a66] text-white font-semibold text-xs rounded-lg transition duration-150">Enviar</button>
                                </td>
                            </tr>

                            <!-- Fila 2 - Activa -->
                            <tr class="alert-row hover:bg-slate-50/60 transition duration-150" onclick="selectAlert(this, 'AL-002')">
                                <td class="py-4 px-6 font-bold text-[#0C3B5E]">AL-002</td>
                                <td class="py-4 px-6 text-slate-500 font-medium">23/06/2025 07:30</td>
                                <td class="py-4 px-6 text-slate-700 font-semibold">Glucosa</td>
                                <td class="py-4 px-6 text-slate-600">María López</td>
                                <td class="py-4 px-6 font-bold text-amber-600">45 mg/dL</td>
                                <td class="py-4 px-6 text-slate-500">&lt; 70 mg/dL</td>
                                <td class="py-4 px-6 text-slate-500 text-xs">Sensor_Glu_02</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        Activa
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-1">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">Ver</button>
                                    <button class="px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 font-semibold text-xs rounded-lg transition duration-150">Estado</button>
                                    <button class="px-3 py-1.5 bg-[#355C7D] hover:bg-[#2a4a66] text-white font-semibold text-xs rounded-lg transition duration-150">Enviar</button>
                                </td>
                            </tr>

                            <!-- Fila 3 - Atendida -->
                            <tr class="alert-row hover:bg-slate-50/60 transition duration-150" onclick="selectAlert(this, 'AL-003')">
                                <td class="py-4 px-6 font-bold text-[#0C3B5E]">AL-003</td>
                                <td class="py-4 px-6 text-slate-500 font-medium">22/06/2025 22:15</td>
                                <td class="py-4 px-6 text-slate-700 font-semibold">Presión</td>
                                <td class="py-4 px-6 text-slate-600">Carlos Ruiz</td>
                                <td class="py-4 px-6 font-bold text-orange-600">165/95</td>
                                <td class="py-4 px-6 text-slate-500">&gt; 140/90</td>
                                <td class="py-4 px-6 text-slate-500 text-xs">Sensor_Pre_03</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                        Atendida
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-1">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">Ver</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- DETALLE DE ALERTA -->
            <div id="detail-panel" class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-sm space-y-4">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Detalle de alerta</p>

                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm text-slate-700 space-y-1">
                    <p><span class="font-semibold text-[#0C3B5E]">ID:</span> AL-001</p>
                    <p><span class="font-semibold text-[#0C3B5E]">Tipo:</span> Temperatura elevada</p>
                    <p><span class="font-semibold text-[#0C3B5E]">Interno:</span> Juan Pérez González</p>
                    <p><span class="font-semibold text-[#0C3B5E]">Valor:</span> 38.5°C</p>
                    <p><span class="font-semibold text-[#0C3B5E]">Límite:</span> 37.5°C</p>
                    <p><span class="font-semibold text-[#0C3B5E]">Origen:</span> Sensor_Temp_01 (Habitación 101)</p>
                    <p><span class="font-semibold text-[#0C3B5E]">Estado:</span> <span class="text-rose-600 font-semibold">Activa</span></p>
                </div>

                <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 text-sm text-amber-800">
                    <p class="font-semibold mb-1">Acciones recomendadas:</p>
                    <p>Verificar medición, aplicar protocolo, monitoreo constante</p>
                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm text-slate-600 space-y-1">
                    <p class="font-semibold text-slate-700 mb-1">Historial de cambios</p>
                    <p class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400 inline-block"></span>
                        08:00 &mdash; generada automáticamente
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#355C7D] inline-block"></span>
                        08:05 &mdash; notificación enviada
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 pt-1">
                    <button class="inline-flex items-center px-4 py-2 bg-[#355C7D] hover:bg-[#2a4a66] text-white font-semibold text-sm rounded-xl transition duration-150">
                        <svg style="width:1rem;height:1rem;margin-right:0.4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Notificar
                    </button>
                    <a href="{{ route('internos.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-xl transition duration-150">
                        <svg style="width:1rem;height:1rem;margin-right:0.4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Ver interno
                    </a>
                    <a href="{{ route('incidencias.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-xl transition duration-150">
                        <svg style="width:1rem;height:1rem;margin-right:0.4rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Ver incidencia
                    </a>
                </div>
            </div>

            <!-- PAGINACIÓN -->
            <div class="bg-white border border-slate-200/80 rounded-2xl px-6 py-4 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs font-medium text-slate-500">
                    Mostrando <span class="font-bold text-slate-700">1-7</span> de <span class="font-bold text-slate-700">25</span>
                </p>
                <div class="flex items-center space-x-1">
                    <button class="px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-500 text-xs font-semibold hover:bg-slate-50">Anterior</button>
                    <button class="px-3 py-1.5 bg-[#0C3B5E] text-white rounded-lg text-xs font-bold shadow-sm">1</button>
                    <button class="px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-600 text-xs font-semibold hover:bg-slate-50">2</button>
                    <button class="px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-600 text-xs font-semibold hover:bg-slate-50">Siguiente</button>
                </div>
            </div>

        </main>
    </div>

    <script>
        function selectAlert(row, id) {
            // Remover selección previa
            document.querySelectorAll('.alert-row').forEach(r => r.classList.remove('selected', 'bg-blue-50/40'));
            // Marcar fila seleccionada
            row.classList.add('selected');
            // Mostrar panel de detalle
            document.getElementById('detail-panel').classList.add('active');
        }
    </script>
</x-app-layout>
