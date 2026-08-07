<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER -->
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                    Editar Familiar
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Actualización de información del familiar
                </p>
            </div>

            <!-- FORMULARIO -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">

                <form action="" method="POST" class="p-6 md:p-8 space-y-8"
                      x-data="{
                        internos: [
                            @foreach ($familiar->internos as $interno)
                                { id: {{ $interno->id }}, nombre: '{{ addslashes($interno->nombre . ' ' . $interno->apellido_paterno) }}', parentesco: '{{ addslashes($interno->pivot->parentesco) }}' },
                            @endforeach
                        ],
                        nuevoInternoId: '',
                        nuevoParentesco: ''
                      }">
                    @csrf
                    @method('PUT')

                    <!-- SECCIÓN: Datos personales -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos personales</h2>
                        <div class="space-y-5">
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre', $familiar->nombre) }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('nombre') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $familiar->apellido_paterno) }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('apellido_paterno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $familiar->apellido_materno) }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('apellido_materno') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Correo</label>
                                    <input type="email" name="correo" value="{{ old('correo', $familiar->correo) }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('correo') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                                    <input type="text" name="telefono" value="{{ old('telefono', $familiar->telefono) }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('telefono') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Familiar</label>
                                    <select name="tipo_familiar" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Titular" {{ old('tipo_familiar', $familiar->tipo_familiar) == 'Titular' ? 'selected' : '' }}>Titular</option>
                                        <option value="Contacto secundario" {{ old('tipo_familiar', $familiar->tipo_familiar) == 'Contacto secundario' ? 'selected' : '' }}>Contacto secundario</option>
                                        <option value="Tutor legal" {{ old('tipo_familiar', $familiar->tipo_familiar) == 'Tutor legal' ? 'selected' : '' }}>Tutor legal</option>
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
                                    <input type="text" name="usuario" value="{{ old('usuario', $familiar->usuario) }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                    @error('usuario') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nueva contraseña</label>
                                    <input type="password" name="password" placeholder="Dejar en blanco para no cambiarla" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm placeholder:text-xs">
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
                                        <option value="Activo" {{ old('estado', $familiar->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Inactivo" {{ old('estado', $familiar->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Asignación de interno -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Asignación de interno</h2>

                        <div class="overflow-x-auto rounded-xl border border-slate-200">
                            <table class="w-full text-sm text-left">
                                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold tracking-wider">
                                    <tr>
                                        <th class="px-4 py-3">Nombre</th>
                                        <th class="px-4 py-3">Parentesco</th>
                                        <th class="px-4 py-3 text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <template x-for="(fila, index) in internos" :key="fila.id">
                                        <tr class="hover:bg-slate-50 transition duration-150">
                                            <td class="px-4 py-3 font-medium text-slate-700">
                                                <span x-text="fila.nombre"></span>
                                                <input type="hidden" :name="'internos[' + index + '][interno_id]'" :value="fila.id">
                                            </td>
                                            <td class="px-4 py-3">
                                                <input type="text" :name="'internos[' + index + '][parentesco]'" x-model="fila.parentesco" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <button type="button" @click="internos.splice(index, 1)" class="text-rose-600 hover:underline font-semibold">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="internos.length === 0">
                                        <td colspan="3" class="px-4 py-6 text-center text-slate-400">
                                            Sin internos asignados
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Agregar nuevo interno -->
                        <div class="flex gap-4 mt-4">
                            <div class="flex-1">
                                <select x-model="nuevoInternoId" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                    <option value="">Selecciona un interno</option>
                                    @foreach ($internosDisponibles as $interno)
                                        <option value="{{ $interno->id }}" data-nombre="{{ $interno->nombre }} {{ $interno->apellido_paterno }}">{{ $interno->nombre }} {{ $interno->apellido_paterno }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-1">
                                <input type="text" x-model="nuevoParentesco" placeholder="Parentesco" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                            </div>
                        </div>

                        <button type="button"
                            @click="
                                if (nuevoInternoId && nuevoParentesco) {
                                    let select = $el.parentElement.previousElementSibling.querySelector('select');
                                    let nombreSeleccionado = select.options[select.selectedIndex].dataset.nombre;
                                    internos.push({ id: nuevoInternoId, nombre: nombreSeleccionado, parentesco: nuevoParentesco });
                                    nuevoInternoId = '';
                                    nuevoParentesco = '';
                                }
                            "
                            class="w-full mt-4 py-3 rounded-xl border border-dashed border-slate-300 text-slate-500 hover:text-[#355C7D] hover:border-[#355C7D] font-semibold text-sm transition duration-150">
                            + Agregar interno
                        </button>
                    </div>

                    <!-- SECCIÓN: Información del registro -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del registro</h2>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de registro</label>
                                <input type="text" readonly value="{{ \Carbon\Carbon::parse($familiar->created_at)->format('d/m/Y') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado usuario</label>
                                <input type="text" readonly value="{{ $familiar->estado }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 mt-8">
                        <a href="{{ route('familiares.show', $familiar->id) }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#355C7D] hover:bg-[#2A4A66] active:bg-[#1F3850] text-white font-bold text-sm rounded-xl shadow-md shadow-[#355C7D]/20 transition duration-150">
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