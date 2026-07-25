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
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
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
                            placeholder="Buscar incidencia..."
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200"
                        />
                    </div>

                    <!-- Filtro Estado -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer appearance-none pr-8">
                        <option value="">Estado ▾</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="aprobada">Aprobada</option>
                        <option value="rechazada">Rechazada</option>
                        <option value="resuelta">Resuelta</option>
                    </select>

                    <!-- Filtro Prioridad -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer appearance-none pr-8">
                        <option value="">Prioridad ▾</option>
                        <option value="urgente">Urgente</option>
                        <option value="alta">Alta</option>
                        <option value="media">Media</option>
                        <option value="baja">Baja</option>
                    </select>

                    <!-- Filtro Interno -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer appearance-none pr-8">
                        <option value="">Interno ▾</option>
                        <option>Juan Pérez</option>
                        <option>María González</option>
                        <option>Carlos Ruiz</option>
                    </select>

                    <!-- Filtro Cuidador -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer appearance-none pr-8">
                        <option value="">Cuidador ▾</option>
                        <option>María López</option>
                        <option>José García</option>
                    </select>

                    <!-- Filtro Fecha -->
                    <select class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-slate-700 font-semibold text-sm focus:outline-none focus:border-[#355C7D] focus:ring-4 focus:ring-[#355C7D]/15 transition duration-200 cursor-pointer appearance-none pr-8">
                        <option value="">Fecha ▾</option>
                        <option>Hoy</option>
                        <option>Esta semana</option>
                        <option>Este mes</option>
                    </select>

                </div>
            </div>

            <!-- TARJETAS ESTADÍSTICAS -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <!-- Total -->
                 <div class="flex gap-4">
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex-1">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Total</p>
                        <p class="text-3xl font-extrabold text-[#0C3B5E]">47</p>
                    </div>
                    <!-- Pendientes -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex-1">
                        <p class="text-xs font-semibold text-amber-500 uppercase tracking-wider mb-1">Pendientes</p>
                        <p class="text-3xl font-extrabold text-amber-600">12</p>
                    </div>
                 </div>

                 <div class="flex gap-4">
                        <!-- Aprobadas -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex-1">
                        <p class="text-xs font-semibold text-emerald-500 uppercase tracking-wider mb-1">Aprobadas</p>
                        <p class="text-3xl font-extrabold text-emerald-600">8</p>
                    </div>
                    <!-- Rechazadas -->
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex-1">
                        <p class="text-xs font-semibold text-rose-400 uppercase tracking-wider mb-1">Rechazadas</p>
                        <p class="text-3xl font-extrabold text-rose-600">5</p>
                    </div>
                 </div>
                
                
                <!-- Resueltas -->
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
                    <p class="text-xs font-semibold text-sky-400 uppercase tracking-wider mb-1">Resueltas</p>
                    <p class="text-3xl font-extrabold text-sky-600">22</p>
                </div>
            </div>

            <!-- TABLA DE INCIDENCIAS -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">ID</th>
                                <th class="py-4 px-6">Fecha</th>
                                <th class="py-4 px-6">Interno</th>
                                <th class="py-4 px-6">Tipo</th>
                                <th class="py-4 px-6">Prioridad</th>
                                <th class="py-4 px-6">Cuidador</th>
                                <th class="py-4 px-6">Estado</th>
                                <th class="py-4 px-6 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">

                            <!-- Fila 1 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-[#0C3B5E]">INC-001</td>
                                <td class="py-4 px-6 text-slate-500 font-medium">23/06 08:30</td>
                                <td class="py-4 px-6 font-semibold text-slate-800 flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-[#0C3B5E] text-white flex items-center justify-center font-bold text-xs flex-shrink-0">JP</div>
                                    <span>Juan Pérez</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">Caída</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        Urgente
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">María López</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                        Pendiente
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">Ver</button>
                                    <button class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold text-xs rounded-lg transition duration-150">Aprobar</button>
                                    <button class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs rounded-lg transition duration-150">Rechazar</button>
                                </td>
                            </tr>

                            <!-- Fila 2 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-[#0C3B5E]">INC-002</td>
                                <td class="py-4 px-6 text-slate-500 font-medium">22/06 14:15</td>
                                <td class="py-4 px-6 font-semibold text-slate-800 flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-[#4EBA87] text-white flex items-center justify-center font-bold text-xs flex-shrink-0">MG</div>
                                    <span>María González</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">Síntoma</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 mr-1.5"></span>
                                        Alta
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">José García</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Aprobada
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">Ver</button>
                                </td>
                            </tr>

                            <!-- Fila 3 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-[#0C3B5E]">INC-003</td>
                                <td class="py-4 px-6 text-slate-500 font-medium">21/06 09:45</td>
                                <td class="py-4 px-6 font-semibold text-slate-800 flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-sky-600 text-white flex items-center justify-center font-bold text-xs flex-shrink-0">CR</div>
                                    <span>Carlos Ruiz</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">Conducta</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500 mr-1.5"></span>
                                        Media
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">María López</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        Rechazada
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">Ver</button>
                                </td>
                            </tr>

                            <!-- Fila 4 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-[#0C3B5E]">INC-004</td>
                                <td class="py-4 px-6 text-slate-500 font-medium">20/06 17:00</td>
                                <td class="py-4 px-6 font-semibold text-slate-800 flex items-center space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs flex-shrink-0">AG</div>
                                    <span>Ana Gómez</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">Medicación</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400 mr-1.5"></span>
                                        Baja
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">José García</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500 mr-1.5"></span>
                                        Resuelta
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">Ver</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- PAGINACIÓN -->
                <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs font-medium text-slate-500">
                        Mostrando <span class="font-bold text-slate-700">1</span> a <span class="font-bold text-slate-700">4</span> de <span class="font-bold text-slate-700">47</span> incidencias
                    </p>
                    <div class="flex items-center space-x-1">
                        <button class="px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-500 text-xs font-semibold hover:bg-slate-50 disabled:opacity-50">
                            Anterior
                        </button>
                        <button class="px-3 py-1.5 bg-[#0C3B5E] text-white rounded-lg text-xs font-bold shadow-sm">
                            1
                        </button>
                        <button class="px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-600 text-xs font-semibold hover:bg-slate-50">
                            2
                        </button>
                        <button class="px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-600 text-xs font-semibold hover:bg-slate-50">
                            3
                        </button>
                        <button class="px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-slate-600 text-xs font-semibold hover:bg-slate-50">
                            Siguiente
                        </button>
                    </div>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>
