<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER -->
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                    Registro de Familiar
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Crear nuevo familiar del sistema
                </p>
            </div>

            <!-- FORMULARIO -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">

                <form action="" method="POST" class="p-6 md:p-8 space-y-8" x-data="{ internos: [{ interno_id: '', parentesco: '' }] }">
                    @csrf

                    <!-- SECCIÓN: Datos del familiar -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos del familiar</h2>
                        <div class="space-y-5">
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('nombre') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('apellido_paterno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('apellido_materno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                                    <input type="email" name="correo" value="{{ old('correo') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('correo') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                                    <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('telefono') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Familiar</label>
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
                                    <input type="text" name="usuario" value="{{ old('usuario') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('usuario') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Contraseña</label>
                                    <input type="password" name="password" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Confirmar contraseña</label>
                                    <input type="password" name="password_confirmation" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                    <select name="estado" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
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
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-sm font-semibold text-slate-700 mb-1">Parentesco</label>
                                        <input type="text" :name="'internos[' + index + '][parentesco]'" x-model="fila.parentesco" placeholder="Ej. Hijo, Hija, Esposo/a" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
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
                                <input type="text" readonly value="{{ auth()->user()->name ?? 'Administrador' }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 mt-8">
                        <a href="{{ route('familiares.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#355C7D] hover:bg-[#2A4A66] active:bg-[#1F3850] text-white font-bold text-sm rounded-xl shadow-md shadow-[#355C7D]/20 transition duration-150">
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