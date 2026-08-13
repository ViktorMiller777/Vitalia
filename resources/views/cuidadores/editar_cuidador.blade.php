<style>
    .guardar-cambios {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.625rem 1.5rem;
        background-color: #355C7D;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.875rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(53, 92, 125, 0.2);
        transition: all 150ms ease-in-out;
        border: none;
        cursor: pointer;
    }

    .guardar-cambios:hover {
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53, 92, 125, 0.3);
        color: #ffffff;
    }

    .guardar-cambios:active {
        background-color: #20394E;
    }

    .ver-detalles {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.625rem 1.25rem;
        background-color: #355C7D;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.875rem;
        border-radius: 0.75rem;
        transition: background-color 0.15s ease;
        text-decoration: none;
    }

    .ver-detalles:hover {
        background-color: #2A4A66;
        color: #ffffff;
    }
</style>
<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Editar Cuidador: {{ $cuidador->nombre }} {{ $cuidador->apellido_paterno }}
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Actualización de información del cuidador
                    </p>
                </div>
                <a href="{{ route('cuidadores.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-xl text-sm font-semibold transition duration-150 shadow-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a la lista
                </a>
            </div>

            <!-- MODAL DE ÉXITO -->
            @if (session('success'))
                <div x-data="{ open: true }" x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
                    <div class="bg-white rounded-3xl p-6 md:p-8 max-w-md w-full shadow-2xl border border-slate-100 text-center space-y-5 transform transition-all">
                        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-xl font-extrabold text-[#0C3B5E]">¡Cuidador Editado Correctamente!</h3>
                            <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                                {{ session('success') }}
                            </p>
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row gap-3">
                            <button @click="open = false" type="button" class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition duration-150">
                                Continuar editando
                            </button>
                            <a href="{{ route('cuidadores.detalle_cuidador', ['id' => $cuidador->id]) }}" class="ver-detalles">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ERRORES DE VALIDACIÓN -->
            @if ($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-sm shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="font-bold">Hubo un problema al actualizar el cuidador:</p>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 ml-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORMULARIO -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">

                <form action="{{ route('cuidadores.update', ['id' => $cuidador->id]) }}" method="POST" class="p-6 md:p-8 space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- SECCIÓN: Datos personales (2 campos por fila) -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos personales</h2>
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre', $cuidador->nombre) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('nombre') border-rose-500 @enderror">
                                    @error('nombre') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $cuidador->apellido_paterno) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_paterno') border-rose-500 @enderror">
                                    @error('apellido_paterno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $cuidador->apellido_materno) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_materno') border-rose-500 @enderror">
                                    @error('apellido_materno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                                    <input type="email" name="correo" value="{{ old('correo', $cuidador->correo) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('correo') border-rose-500 @enderror">
                                    @error('correo') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                                    <input type="text" name="telefono" value="{{ old('telefono', $cuidador->telefono) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('telefono') border-rose-500 @enderror">
                                    @error('telefono') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de cuidador</label>
                                    <select name="tipo_cuidador" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                        <option value="Enfermero" {{ old('tipo_cuidador', $cuidador->tipo_cuidador) == 'Enfermero' ? 'selected' : '' }}>Enfermero</option>
                                        <option value="Geriatra" {{ old('tipo_cuidador', $cuidador->tipo_cuidador) == 'Geriatra' ? 'selected' : '' }}>Geriatra</option>
                                        <option value="Auxiliar" {{ old('tipo_cuidador', $cuidador->tipo_cuidador) == 'Auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                                        <option value="Cuidador General" {{ old('tipo_cuidador', $cuidador->tipo_cuidador ?? 'Cuidador General') == 'Cuidador General' ? 'selected' : '' }}>Cuidador General</option>
                                    </select>
                                    @error('tipo_cuidador') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Datos de acceso (2 campos por fila) -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos de acceso</h2>
                        <div class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Usuario</label>
                                    <input type="text" name="usuario" value="{{ old('usuario', $cuidador->usuario) }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('usuario') border-rose-500 @enderror">
                                    @error('usuario') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nueva contraseña (Opcional)</label>
                                    <input type="password" name="password" placeholder="Dejar en blanco para no cambiarla" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm placeholder:text-xs @error('password') border-rose-500 @enderror">
                                    @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Confirmar contraseña</label>
                                    <input type="password" name="password_confirmation" placeholder="Dejar en blanco para no cambiarla" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm placeholder:text-xs">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                    <select name="estado" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                        <option value="Activo" {{ old('estado', $cuidador->estado) == 'active' || old('estado', $cuidador->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('estado', $cuidador->estado) == 'inactive' || old('estado', $cuidador->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Información del registro (2 campos por fila) -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del registro</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de registro</label>
                                <input type="text" readonly value="{{ \Carbon\Carbon::parse($cuidador->created_at)->format('d/m/Y') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado del usuario</label>
                                <input type="text" readonly value="{{ in_array(strtolower($cuidador->estado), ['active', 'activo']) ? 'Activo' : 'Inactivo' }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 mt-8">
                        <a href="{{ route('cuidadores.detalle_cuidador', ['id' => $cuidador->id]) }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="guardar-cambios">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Guardar cambios
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>
</x-app-layout>