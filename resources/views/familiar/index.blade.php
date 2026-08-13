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
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53,92,125,0.3);
    }
    .button-blue:active {
        background-color: #20394E;
    }
</style>
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
                        Administración de familiares registrados en el sistema
                    </p>
                </div>
            </div>

            <!-- TOOLBAR: BUSQUEDA, FILTRO, ORDENAR Y AGREGAR FAMILIAR -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
                <div class="flex flex-col md:flex-row items-center gap-3">
                    
                    <!-- Campo Buscar familiar -->
                    <form action="{{ route('familiares.index') }}" method="GET" class="relative flex-1 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="buscar"
                            value="{{ $search ?? '' }}"
                            placeholder="Buscar familiar por nombre, correo o teléfono..." 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 transition duration-200"
                        />
                    </form>

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

                    <!-- Botón Agregar familiar -->
                    <a href="{{ route('familiar.create') }}" class="button-blue">
                        <svg style="width:1rem;height:1rem;margin-right:0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar familiar
                    </a>
                </div>
            </div>

            <!-- TABLA DE FAMILIARES -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6 whitespace-nowrap">Nombre</th>
                                <th class="py-4 px-6 whitespace-nowrap">Correo</th>
                                <th class="py-4 px-6 whitespace-nowrap">Teléfono</th>
                                <th class="py-4 px-6 whitespace-nowrap">Interno Asignado</th>
                                <th class="py-4 px-6 whitespace-nowrap">Parentesco</th>
                                <th class="py-4 px-6 whitespace-nowrap">Estado</th>
                                <th class="py-4 px-6 text-right whitespace-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($familiares as $familiar)
                                @php
                                    $link = $familiar->familyLinks->first();
                                    $resident = $link?->resident;
                                    $initials = strtoupper(substr($familiar->nombre ?? 'F', 0, 1) . substr($familiar->apellido_paterno ?? 'A', 0, 1));
                                    $isActive = in_array(strtolower($familiar->estado ?? ''), ['active', 'activo']);
                                @endphp
                                <tr class="hover:bg-slate-50/60 transition duration-150">
                                    <td class="py-4 px-6 font-bold text-slate-800 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-9 h-9 rounded-full bg-[#0C3B5E] text-white flex items-center justify-center font-bold text-xs shrink-0">
                                                {{ $initials }}
                                            </div>
                                            <span>{{ $familiar->nombre }} {{ $familiar->apellido_paterno }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600 font-medium whitespace-nowrap">
                                        {{ $familiar->correo ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 shrink-0"></span>
                                            {{ $familiar->telefono ?? 'Sin teléfono' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 font-medium text-slate-700 whitespace-nowrap">
                                        @if($resident)
                                            <span class="inline-block px-3 py-1 bg-slate-100 text-[#0C3B5E] font-semibold text-xs rounded-lg whitespace-nowrap">
                                                {{ $resident->nombre }} {{ $resident->apellido_paterno }}
                                            </span>
                                        @else
                                            <span class="text-slate-400 text-xs italic whitespace-nowrap">Sin asignación</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-slate-600 font-medium whitespace-nowrap">
                                        {{ $link?->parentesco ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        @if($isActive)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                                Activo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap">
                                                Inactivo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right whitespace-nowrap">
                                        <a href="{{ route('familiar.detalle_familiar', ['id' => $familiar->id]) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150 whitespace-nowrap">
                                            Ver / Editar
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 px-6 text-center text-slate-400 font-medium">
                                        No se encontraron usuarios registrados con el rol de Familiar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINACIÓN -->
                <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs font-medium text-slate-500">
                        Mostrando <span class="font-bold text-slate-700">{{ $familiares->firstItem() ?? 0 }}</span> a <span class="font-bold text-slate-700">{{ $familiares->lastItem() ?? 0 }}</span> de <span class="font-bold text-slate-700">{{ $familiares->total() }}</span> familiares
                    </p>
                    <div>
                        {{ $familiares->links() }}
                    </div>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>
