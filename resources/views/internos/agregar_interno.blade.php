<style>
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
                
                <form action="#" method="POST" class="p-6 md:p-8 space-y-8">
                    @csrf
                    
                    <!-- SECCIÓN: Datos Personales -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos personales</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                           <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre</label>
                                    <input type="text" name="nombre" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                                    <input type="text" name="apellido_paterno" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                                    <input type="text" name="apellido_materno" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Sexo</label>
                                    <select name="sexo" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de ingreso</label>
                                    <input type="date" name="fecha_ingreso" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                </div>
                            </div>
    
                            <div class="md:col-span-1">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                <select name="estado" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm text-slate-600">
                                    <option value="Estable">Estable</option>
                                    <option value="En observación">En observación</option>
                                    <option value="Atención especial">Atención especial</option>
                                </select>
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
                                    <input type="text" name="tipo_sangre" placeholder="Ej. O+" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Peso (kg)</label>
                                    <input type="number" step="0.1" name="peso" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Estatura (m)</label>
                                    <input type="number" step="0.01" name="estatura" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Alergias</label>
                                    <input type="text" name="alergias" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Padecimientos</label>
                                    <textarea name="padecimientos" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Antecedentes médicos</label>
                                    <textarea name="antecedentes_medicos" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Enfermedades crónicas</label>
                                    <textarea name="enfermedades_cronicas" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Cirugías previas</label>
                                    <textarea name="cirugias_previas" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Observaciones generales</label>
                                <textarea name="observaciones_generales" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Información del registro -->
                    <div>
                        <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del registro</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Creado por</label>
                                <input type="text" readonly value="{{ auth()->user()->name ?? 'Administrador' }}" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
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
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-[#4EBA87] hover:bg-emerald-600 active:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md shadow-[#4EBA87]/20 transition duration-150">
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