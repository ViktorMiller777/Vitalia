<style>
    .editar-familiar {
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

    .editar-familiar:hover {
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53, 92, 125, 0.3);
        color: #ffffff;
    }

    .editar-familiar:active {
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
                        Detalle del Familiar: {{ $familiar->nombre }} {{ $familiar->apellido_paterno }}
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Información completa del familiar registrado
                    </p>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('familiares.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold text-sm rounded-xl transition duration-150 shadow-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver a la lista
                    </a>

                    <a href="{{ route('familiar.editar_familiar', ['id' => $familiar->id]) }}" class="editar-familiar">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar familiar
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
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $familiar->nombre }}</p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $familiar->apellido_paterno }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $familiar->apellido_materno ?? '-' }}</p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $familiar->correo }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $familiar->telefono ?? 'Sin teléfono' }}</p>
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
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-semibold">{{ $familiar->usuario }}</p>
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                <div class="pt-1">
                                    @if(in_array(strtolower($familiar->estado ?? ''), ['active', 'activo']))
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
                                    {{ $familiar->created_at ? $familiar->created_at->format('d/m/Y H:i') : '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Internos asignados -->
                <div>
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2 mb-5">
                        <h2 class="text-lg font-bold text-[#0C3B5E]">Internos asignados</h2>
                        <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                            {{ $familiar->familyLinks ? $familiar->familyLinks->count() : 0 }} Interno(s)
                        </span>
                    </div>

                    <div class="space-y-3">
                        @if($familiar->familyLinks && $familiar->familyLinks->count() > 0)
                            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-xs">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500 tracking-wider">
                                            <th class="py-3.5 px-4">Interno</th>
                                            <th class="py-3.5 px-4">Parentesco</th>
                                            <th class="py-3.5 px-4 text-right">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        @foreach($familiar->familyLinks as $link)
                                            @php $res = $link->resident; @endphp
                                            <tr class="hover:bg-slate-50/70 transition duration-150">
                                                <td class="py-3.5 px-4 font-bold text-slate-800">
                                                    @if($res)
                                                        {{ $res->nombre }} {{ $res->apellido_paterno }} {{ $res->apellido_materno }}
                                                    @else
                                                        <span class="text-slate-400 font-normal italic">Interno #{{ $link->interno_id }}</span>
                                                    @endif
                                                </td>
                                                <td class="py-3.5 px-4 font-medium text-slate-700">
                                                    <span class="inline-block px-3 py-1 bg-slate-100 text-[#0C3B5E] font-semibold text-xs rounded-lg border border-slate-200">
                                                        {{ $link->parentesco ?? 'Sin registrar' }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4 text-right">
                                                    @if($res)
                                                        <a href="{{ route('internos.detalle_interno', ['id' => $res->id]) }}" class="inline-flex items-center px-3 py-1.5 bg-[#0C3B5E]/10 hover:bg-[#0C3B5E] text-[#0C3B5E] hover:text-white font-semibold text-xs rounded-lg transition duration-150">
                                                            Ver detalle interno
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-slate-400 text-sm rounded-xl border border-dashed border-slate-300 p-6 text-center">
                                Sin internos asignados a este familiar.
                            </p>
                        @endif
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>