<style>
    .editar-cuidador {
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

    .editar-cuidador:hover {
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53, 92, 125, 0.3);
        color: #ffffff;
    }

    .editar-cuidador:active {
        background-color: #20394E;
    }
</style>
<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER: Nombre + Botones de Acción -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Detalle del Cuidador: {{ $cuidador->nombre }} {{ $cuidador->apellido_paterno }}
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Información completa del usuario cuidador
                    </p>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('cuidadores.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-xl transition duration-150 shadow-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver a la lista
                    </a>

                    <a href="{{ route('cuidadores.editar_cuidador', ['id' => $cuidador->id]) }}" class="editar-cuidador">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar cuidador
                    </a>
                </div>
            </div>

            <!-- CONTENIDO -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8 space-y-8">

                <!-- SECCIÓN: Datos personales -->
                <div>
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos personales</h2>
                    <div class="space-y-5">
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $cuidador->nombre }}</p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $cuidador->apellido_paterno }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $cuidador->apellido_materno ?? '-' }}</p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $cuidador->correo }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $cuidador->telefono ?? 'Sin teléfono' }}</p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Rol en el sistema</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">Cuidador</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Datos de acceso -->
                <div>
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos de acceso</h2>
                    <div class="space-y-5">
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Usuario</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $cuidador->usuario }}</p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                <div class="pt-1">
                                    @if(in_array(strtolower($cuidador->estado ?? ''), ['active', 'activo']))
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span> Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                            <span class="w-2 h-2 rounded-full bg-slate-400 mr-2"></span> Inactivo
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de registro</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">
                                    {{ $cuidador->created_at ? $cuidador->created_at->format('d/m/Y H:i') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Información del sistema -->
                <div>
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-4">Información del sistema</h2>
                    <div class="rounded-xl border border-slate-200 bg-slate-50/50 p-4 text-sm text-slate-500 max-w-xl">
                        @forelse ($cuidador->actividades ?? [] as $actividad)
                            <div class="border-b border-slate-100 last:border-0 py-1.5">
                                <p class="text-slate-700 font-medium">{{ $actividad->descripcion }}</p>
                                <p class="text-slate-400 text-xs">{{ \Carbon\Carbon::parse($actividad->created_at)->format('d/m/Y H:i') }}</p>
                            </div>
                        @empty
                            <p class="text-slate-400 text-xs py-1">Sin actividad registrada</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>