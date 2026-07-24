<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        
        <!-- SIDEBAR DE NAVEGACIÓN -->
        <x-sidebar />

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 p-6 md:p-10 space-y-6">
            
            <!-- HEADER DEL CONTENIDO -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Lista de Familiares
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Administración de familiares registrados
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
                    <a href="{{ route('internos.create') }}" class="w-full md:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-[#4EBA87] hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg shadow-[#4EBA87]/20 transition duration-150 cursor-pointer">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar familiar
                    </a>
                </div>
            </div>

            <!-- TABLA DE INTERNOS -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">Nombre</th>
                                <th class="py-4 px-6">Correo</th>
                                <th class="py-4 px-6">Teléfono</th>
                                <th class="py-4 px-6">Interno</th>
                                <th class="py-4 px-6">Parentesco</th>
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
                                <td class="py-4 px-6 text-slate-600 font-medium">perez@gmail.com</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        8713578221
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                        Bolillo 
                                    </button>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-medium">Hijo</td>
                                <td class="py-4 px-6 text-slate-600 font-medium">Vivo</td>
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
                                <td class="py-4 px-6 text-slate-600 font-medium">lopez@gmail.com</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                        8714362178
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <button class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                        Memin
                                    </button>
                                </td>
                                <td class="py-4 px-6 text-slate-600 font-medium">Hijo</td>
                                <td class="py-4 px-6 text-slate-600 font-medium">Vivo</td>
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
