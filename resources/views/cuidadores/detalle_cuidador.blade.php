<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER: Nombre + Botón Editar -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Detalle del Cuidador
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Información completa del usuario cuidador
                    </p>
                </div>

                <a href="" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#355C7D] hover:bg-[#2A4A66] active:bg-[#1F3850] text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg shadow-[#355C7D]/20 transition duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar cuidador
                </a>
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
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de cuidador</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
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
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Contraseña</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 tracking-widest">••••••••</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold">
                                    
                                </span>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de registro</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Información del sistema -->
                <div>
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del sistema</h2>
                    <div class="rounded-xl border border-slate-200 min-h-[120px] p-4 text-sm text-slate-500">
                        @forelse ($cuidador->actividades ?? [] as $actividad)
                            <div class="border-b border-slate-100 last:border-0 py-2">
                                <p class="text-slate-700 font-medium">{{ $actividad->descripcion }}</p>
                                <p class="text-slate-400 text-xs">{{ \Carbon\Carbon::parse($actividad->created_at)->format('d/m/Y H:i') }}</p>
                            </div>
                        @empty
                            <p class="text-slate-400 flex items-center justify-center h-full">Sin actividad registrada</p>
                        @endforelse
                    </div>
                </div>

                <!-- BOTÓN: Desactivar cuidador -->
                <div class="pt-2">
                    <form action="" method="POST" onsubmit="return confirm('¿Seguro que quieres desactivar a este cuidador?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-rose-600 bg-white border border-rose-300 rounded-xl hover:bg-rose-50 transition duration-150">
                            Desactivar cuidador
                        </button>
                    </form>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>