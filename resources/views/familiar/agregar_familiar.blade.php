<style>
    .guardar-registro {
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
        transition: all 50ms ease-in-out;
        border: none;
        cursor: pointer;
        margin: 10px;
    }

    .guardar-registro:hover {
        background-color: #2A4A66;
        box-shadow: 0 10px 15px -3px rgba(53, 92, 125, 0.3);
        color: #ffffff;
    }

    .guardar-registro:active {
        background-color: #20394E;
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
                        Registro de Familiar
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Crear nuevo familiar del sistema
                    </p>
                </div>
                <a href="{{ route('familiares.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 rounded-xl text-sm font-semibold transition duration-150 shadow-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a la lista
                </a>
            </div>

            <!-- FORMULARIO -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">

                @if ($errors->any())
                    <div class="m-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-sm shadow-sm">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="font-bold">Hubo un problema al registrar el familiar:</p>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-1 ml-7">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('familiar.store') }}" method="POST" class="p-6 md:p-8 space-y-8" x-data="{ internos: [{ interno_id: '', parentesco: '' }] }">
                    @csrf

                    <!-- SECCIÓN: Datos del familiar -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos del familiar</h2>
                        <div class="space-y-5">
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('nombre') border-rose-500 @enderror">
                                    @error('nombre') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_paterno') border-rose-500 @enderror">
                                    @error('apellido_paterno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_materno') border-rose-500 @enderror">
                                    @error('apellido_materno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                                    <input type="email" name="correo" value="{{ old('correo') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('correo') border-rose-500 @enderror">
                                    @error('correo') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                                    <input type="text" name="telefono" value="{{ old('telefono') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('telefono') border-rose-500 @enderror">
                                    @error('telefono') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de familiar</label>
                                    <select name="tipo_familiar" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Titular" {{ old('tipo_familiar') == 'Titular' ? 'selected' : '' }}>Titular</option>
                                        <option value="Contacto secundario" {{ old('tipo_familiar') == 'Contacto secundario' ? 'selected' : '' }}>Contacto secundario</option>
                                        <option value="Tutor legal" {{ old('tipo_familiar') == 'Tutor legal' ? 'selected' : '' }}>Tutor legal</option>
                                    </select>
                                    @error('tipo_familiar') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                                    <input type="text" name="usuario" value="{{ old('usuario') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('usuario') border-rose-500 @enderror">
                                    @error('usuario') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Contraseña</label>
                                    <input type="password" name="password" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('password') border-rose-500 @enderror">
                                    @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Confirmar contraseña</label>
                                    <input type="password" name="password_confirmation" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                    <select name="estado" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                        <option value="Activo" {{ old('estado', 'Activo') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Asignar a interno -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Asignar a interno</h2>
                        <div class="space-y-4">
                            <template x-for="(fila, index) in internos" :key="index">
                                <div class="flex gap-4 items-start">
                                    <div class="flex-1">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Interno</label>
                                        <select :name="'internos[' + index + '][interno_id]'" x-model="fila.interno_id" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                            <option value="">Selecciona un interno</option>
                                            @if(isset($residents))
                                                @foreach($residents as $resident)
                                                    <option value="{{ $resident->id }}">{{ $resident->nombre }} {{ $resident->apellido_paterno }} {{ $resident->apellido_materno }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Parentesco</label>
                                        <select :name="'internos[' + index + '][parentesco]'" x-model="fila.parentesco" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                            <option value="">Selecciona parentesco</option>
                                            <option value="Hijo(a)">Hijo(a)</option>
                                            <option value="Esposo(a)">Esposo(a)</option>
                                            <option value="Hermano(a)">Hermano(a)</option>
                                            <option value="Tutor(a) legal">Tutor(a) legal</option>
                                            <option value="Cónyuge">Cónyuge</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                    <button type="button" x-show="internos.length > 1" @click="internos.splice(index, 1)" class="mt-7 text-rose-500 hover:text-rose-700 transition duration-150">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <button type="button" @click="internos.push({ interno_id: '', parentesco: '' })" class="px-5 py-2.5 text-sm font-semibold text-[#355C7D] bg-white border border-[#355C7D] rounded-xl hover:bg-[#355C7D] hover:text-white transition duration-150">
                                + Asignar otro interno
                            </button>
                        </div>
                    </div>

                    <!-- SECCIÓN: Información del registro -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del registro</h2>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de registro</label>
                                <input type="text" readonly value="{{ now()->format('d/m/Y') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Registrado por</label>
                                <input type="text" readonly value="{{ trim((auth()->user()->nombre ?? '') . ' ' . (auth()->user()->apellido_paterno ?? 'Administrador')) }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 mt-8">
                        <a href="{{ route('familiares.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="guardar-registro">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Guardar familiar
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>
</x-app-layout>