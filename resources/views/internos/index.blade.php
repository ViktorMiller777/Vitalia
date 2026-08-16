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
                        Lista de Internos
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Administración de internos registrados
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-sm font-semibold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- TOOLBAR: BUSQUEDA, FILTRO, ORDENAR Y AGREGAR INTERNO -->
            <form method="GET" action="{{ route('internos.index') }}" class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
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
                            name="buscar"
                            value="{{ request('buscar') }}"
                            placeholder="Buscar interno..." 
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm focus:outline-none focus:bg-white focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 transition duration-200"
                        />
                    </div>

                    <!-- Filtro Estado -->
                    <select name="estado" class="w-full md:w-auto px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-xl transition duration-150 cursor-pointer">
                        <option value="">Todos los estados</option>
                        <option value="Estable" {{ request('estado') == 'Estable' ? 'selected' : '' }}>Estable</option>
                        <option value="En observación" {{ request('estado') == 'En observación' ? 'selected' : '' }}>En observación</option>
                        <option value="Atención especial" {{ request('estado') == 'Atención especial' ? 'selected' : '' }}>Atención especial</option>
                    </select>

                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-[#0C3B5E] text-white font-semibold text-sm rounded-xl transition duration-150 cursor-pointer hover:bg-[#082942]">
                        Buscar
                    </button>

                    @if(request('buscar') || request('estado'))
                        <a href="{{ route('internos.index') }}" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-sm rounded-xl transition duration-150">
                            Limpiar
                        </a>
                    @endif

                    <!-- Botón Agregar interno -->
                    <a href="{{ route('internos.create') }}" class="button-blue">
                        <svg style="width:1rem;height:1rem;margin-right:0.5rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Agregar interno
                    </a>
                </div>
            </form>

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
                            @forelse ($internos as $interno)
                                @php
                                    $initials = strtoupper(substr($interno->nombre, 0, 1) . substr($interno->apellido_paterno, 0, 1));
                                    $badgeClass = match($interno->estado) {
                                        'En observación' => 'badge-naranja',
                                        'Atención especial' => 'badge-rojo',
                                        default => 'badge-verde',
                                    };
                                @endphp
                                <tr class="hover:bg-slate-50/60 transition duration-150">
                                    <td class="py-4 px-6 font-bold text-slate-800 flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-[#0C3B5E] text-white flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ $initials }}
                                        </div>
                                        <span>{{ $interno->nombre }} {{ $interno->apellido_paterno }} {{ $interno->apellido_materno }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600 font-medium">
                                        {{ $interno->fecha_nacimiento ? $interno->fecha_nacimiento->age . ' años' : 'N/A' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5"></span>
                                            {{ $interno->estado ?? 'Estable' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right space-x-2">
                                        <a href="{{ route('internos.detalle_interno', ['id' => $interno->id]) }}" class="inline-block px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-[#0C3B5E] font-semibold text-xs rounded-lg transition duration-150">
                                            Ver / Editar
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-slate-500 font-medium">
                                        No se encontraron internos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINACIÓN -->
                <div class="bg-slate-50/80 px-6 py-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs font-medium text-slate-500">
                        Mostrando <span class="font-bold text-slate-700">{{ $internos->firstItem() ?? 0 }}</span> a <span class="font-bold text-slate-700">{{ $internos->lastItem() ?? 0 }}</span> de <span class="font-bold text-slate-700">{{ $internos->total() }}</span> internos
                    </p>
                    <div>
                        {{ $internos->links() }}
                    </div>
                </div>

            </div>

        </main>
    </div>
</x-app-layout>
