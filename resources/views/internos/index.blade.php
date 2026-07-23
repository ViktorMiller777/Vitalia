<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        
        <!-- SIDEBAR DE NAVEGACIÓN -->
        <aside class="w-full md:w-64 bg-white border-r border-slate-200/80 p-6 flex-shrink-0">
            <div class="space-y-6">
                <!-- Navigation Items -->
                <nav class="space-y-2">
                    <!-- Inicio -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-slate-600 hover:text-[#0C3B5E] hover:bg-slate-50 rounded-xl font-semibold text-sm transition duration-150">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Inicio
                    </a>

                    <!-- Cuidadores -->
                    <a href="#" class="flex items-center px-4 py-3 text-slate-600 hover:text-[#0C3B5E] hover:bg-slate-50 rounded-xl font-semibold text-sm transition duration-150">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Cuidadores
                    </a>

                    <!-- Internos (ACTIVE) -->
                    <a href="{{ route('internos.index') }}" class="flex items-center px-4 py-3 bg-[#0C3B5E] text-white rounded-xl font-bold text-sm shadow-md shadow-[#0C3B5E]/20 transition duration-150">
                        <svg class="w-5 h-5 mr-3 text-[#4EBA87]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Internos
                    </a>

                    <!-- Familiares -->
                    <a href="#" class="flex items-center px-4 py-3 text-slate-600 hover:text-[#0C3B5E] hover:bg-slate-50 rounded-xl font-semibold text-sm transition duration-150">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Familiares
                    </a>

                    <!-- Incidencias -->
                    <a href="#" class="flex items-center px-4 py-3 text-slate-600 hover:text-[#0C3B5E] hover:bg-slate-50 rounded-xl font-semibold text-sm transition duration-150">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Incidencias
                    </a>

                    <!-- Alertas -->
                    <a href="#" class="flex items-center px-4 py-3 text-slate-600 hover:text-[#0C3B5E] hover:bg-slate-50 rounded-xl font-semibold text-sm transition duration-150">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Alertas
                    </a>

                    <!-- Configuración -->
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-slate-600 hover:text-[#0C3B5E] hover:bg-slate-50 rounded-xl font-semibold text-sm transition duration-150">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Configuración
                    </a>
                </nav>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 p-6 md:p-10 space-y-6">
            
            <!-- HEADER DEL CONTENIDO -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Lista de Internos
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Administración de internos registrados
                    </p>
                </div>
            </div>

            <!-- TOOLBAR: BUSQUEDA, FILTRO, ORDENAR Y AGREGAR INTERNO -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
                <div class="flex flex-col md:flex-row items-center gap-3">
                    
                    <!-- Campo Buscar interno -->
                    <div class="relative flex-1 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            placeholder="Buscar interno..." 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 transition duration-200"
                        />
                    </div>

                    <!-- Botón Filtro -->
                    <button class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-xl transition duration-150 cursor-pointer">
                        <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.447.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"></path>
                        </svg>
                        Filtro
                    </button>

                    <!-- Botón Ordenar -->
                    <button class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-xl transition duration-150 cursor-pointer">
                        <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                        </svg>
                        Ordenar
                    </button>

                    <!-- Botón Agregar interno -->
                    <button class="w-full md:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-[#4EBA87] hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg shadow-[#4EBA87]/20 transition duration-150 cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar interno
                    </button>

                </div>
            </div>

            <!-- TABLA DE INTERNOS -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">Nombre</th>
                                <th class="py-4 px-6">Edad</th>
                                <th class="py-4 px-6">Estado</th>
                                <th class="py-4 px-6 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            
                            <!-- Fila 1 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-slate-800 flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-[#0C3B5E] text-white flex items-center justify-center font-bold text-xs">
                                        JP
                                    </div>
                                    <span>Juan Pérez</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-medium">78 años</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Estable
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                        Ver / Editar
                                    </button>
                                </td>
                            </tr>

                            <!-- Fila 2 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-slate-800 flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-[#4EBA87] text-white flex items-center justify-center font-bold text-xs">
                                        ML
                                    </div>
                                    <span>María López</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-medium">82 años</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                        En observación
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                        Ver / Editar
                                    </button>
                                </td>
                            </tr>

                            <!-- Fila 3 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-slate-800 flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-sky-600 text-white flex items-center justify-center font-bold text-xs">
                                        CR
                                    </div>
                                    <span>Carlos Ruiz</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-medium">74 años</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Estable
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                        Ver / Editar
                                    </button>
                                </td>
                            </tr>

                            <!-- Fila 4 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-slate-800 flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs">
                                        AG
                                    </div>
                                    <span>Ana Gómez</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-medium">80 años</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        Atención especial
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                        Ver / Editar
                                    </button>
                                </td>
                            </tr>

                            <!-- Fila 5 -->
                            <tr class="hover:bg-slate-50/60 transition duration-150">
                                <td class="py-4 px-6 font-bold text-slate-800 flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-xs">
                                        RS
                                    </div>
                                    <span>Roberto Sánchez</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-medium">76 años</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Estable
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                        Ver / Editar
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- PAGINACIÓN -->
                <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs font-medium text-slate-500">
                        Mostrando <span class="font-bold text-slate-700">1</span> a <span class="font-bold text-slate-700">5</span> de <span class="font-bold text-slate-700">12</span> internos
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
