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
        transition: all 150ms ease-in-out;
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

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 p-6 md:p-10 space-y-6">

             <!-- HEADER DEL CONTENIDO -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Registrar Interno
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Alta de nuevo interno
                    </p>
                </div>
            </div>

            <!-- FORMULARIO DE INTERNOS -->
            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm">
                
                @if ($errors->any())
                    <div class="m-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm">
                        <p class="font-bold mb-1">Hubo un problema con tu envío:</p>
                        <ul class="list-disc list-inside text-xs space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('internos.store') }}" method="POST" class="p-6 md:p-8 space-y-8">
                    @csrf
                    
                    <!-- SECCIÓN: Datos Personales -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos personales</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                           <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('nombre') border-red-500 @enderror">
                                    @error('nombre') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_paterno') border-red-500 @enderror">
                                    @error('apellido_paterno') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('apellido_materno') border-red-500 @enderror">
                                    @error('apellido_materno') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('fecha_nacimiento') border-red-500 @enderror">
                                    @error('fecha_nacimiento') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Sexo</label>
                                    <select name="sexo" required class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('sexo') border-red-500 @enderror">
                                        <option value="">Selecciona una opción</option>
                                        <option value="M" {{ old('sexo') == 'M' || old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo') == 'F' || old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                    @error('sexo') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de ingreso</label>
                                    <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso', date('Y-m-d')) }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('fecha_ingreso') border-red-500 @enderror">
                                    @error('fecha_ingreso') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
    
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                <select name="estado" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('estado') border-red-500 @enderror">
                                    <option value="Estable" {{ old('estado', 'Estable') == 'Estable' ? 'selected' : '' }}>Estable</option>
                                    <option value="En observación" {{ old('estado') == 'En observación' ? 'selected' : '' }}>En observación</option>
                                    <option value="Atención especial" {{ old('estado') == 'Atención especial' ? 'selected' : '' }}>Atención especial</option>
                                </select>
                                @error('estado') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Historial Clínico -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Historial clínico</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de sangre</label>
                                    <select name="tipo_sangre" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600 @error('tipo_sangre') border-red-500 @enderror">
                                        <option value="">Selecciona tipo de sangre</option>
                                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $tipo)
                                            <option value="{{ $tipo }}" {{ old('tipo_sangre') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_sangre') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Peso (kg)</label>
                                    <input type="number" step="0.1" name="peso" value="{{ old('peso') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('peso') border-red-500 @enderror">
                                    @error('peso') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Estatura (m)</label>
                                    <input type="number" step="0.01" name="estatura" value="{{ old('estatura') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('estatura') border-red-500 @enderror">
                                    @error('estatura') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Alergias</label>
                                    <input type="text" name="alergias" value="{{ old('alergias') }}" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('alergias') border-red-500 @enderror">
                                    @error('alergias') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Padecimientos</label>
                                    <textarea name="padecimientos" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('padecimientos') border-red-500 @enderror">{{ old('padecimientos') }}</textarea>
                                    @error('padecimientos') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Antecedentes médicos</label>
                                    <textarea name="antecedentes_medicos" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('antecedentes_medicos') border-red-500 @enderror">{{ old('antecedentes_medicos') }}</textarea>
                                    @error('antecedentes_medicos') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Enfermedades crónicas</label>
                                    <textarea name="enfermedades_cronicas" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('enfermedades_cronicas') border-red-500 @enderror">{{ old('enfermedades_cronicas') }}</textarea>
                                    @error('enfermedades_cronicas') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Cirugías previas</label>
                                    <textarea name="cirugias_previas" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('cirugias_previas') border-red-500 @enderror">{{ old('cirugias_previas') }}</textarea>
                                    @error('cirugias_previas') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Observaciones generales</label>
                                <textarea name="observaciones_generales" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm @error('observaciones_generales') border-red-500 @enderror">{{ old('observaciones_generales') }}</textarea>
                                @error('observaciones_generales') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Información del registro -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del registro</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Creado por</label>
                                <input type="text" readonly value="{{ trim((auth()->user()->nombre ?? '') . ' ' . (auth()->user()->apellido_paterno ?? 'Administrador')) }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de creación</label>
                                <input type="text" readonly value="{{ now()->format('d/m/Y') }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 mt-8">
                        <a href="{{ route('internos.index') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="guardar-registro">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Guardar Registro
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>
</x-app-layout>