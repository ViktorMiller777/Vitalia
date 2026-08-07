<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6">

            <!-- HEADER -->
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                    Editar Historial Clínico
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Actualización de información médica del interno
                </p>
            </div>

            <form action="" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- SECCIÓN: Información del interno (solo lectura) -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Información del interno</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre del interno</label>
                            <input type="text" readonly value="" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de ingreso</label>
                            <input type="text" readonly value="" class="w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm focus:ring-0 cursor-not-allowed text-sm">
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Datos clínicos (editable) -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Datos clínicos</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de sangre</label>
                            <input type="text" name="tipo_sangre" value="" placeholder="Ej. O+" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Peso (kg)</label>
                            <input type="number" step="0.1" name="peso" value="" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Estatura (m)</label>
                            <input type="number" step="0.01" name="estatura" value="" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Alergias</label>
                            <input type="text" name="alergias" value="" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Padecimientos</label>
                            <textarea name="padecimientos" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Antecedentes médicos</label>
                            <textarea name="antecedentes_medicos" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Enfer_medicos medades crónicas</label>
                            <textarea name="enfermedades_cronicas" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Cirugías previas</label>
                            <textarea name="cirugias_previas" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Observaciones generales</label>
                            <textarea name="observaciones_generales" rows="3" class="w-full rounded-xl border-slate-300 shadow-sm focus:border-[#4EBA87] focus:ring focus:ring-[#4EBA87]/20 transition duration-200 text-sm"></textarea>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Familiares -->
                <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm p-6 md:p-8">
                    <h2 class="text-lg font-bold text-[#0C3B5E] border-b border-slate-100 pb-2 mb-5">Familiares</h2>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-semibold tracking-wider">
                                <tr>
                                    <th class="px-4 py-3">Nombre</th>
                                    <th class="px-4 py-3">Parentesco</th>
                                    <th class="px-4 py-3">Teléfono</th>
                                    <th class="px-4 py-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                
                                    <tr class="hover:bg-slate-50 transition duration-150">
                                        <td class="px-4 py-3 font-medium text-slate-700"></td>
                                        <td class="px-4 py-3 text-slate-600"></td>
                                        <td class="px-4 py-3 text-slate-600"></td>
                                        <td class="px-4 py-3 text-right space-x-3">
                                            <a href="#" class="text-[#355C7D] hover:underline font-semibold">Ver</a>
                                            <a href="#" class="text-amber-600 hover:underline font-semibold">Editar</a>
                                            <button type="button" class="text-rose-600 hover:underline font-semibold">Eliminar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-slate-400">
                                            Sin familiares registrados
                                        </td>
                                    </tr>
                                
                            </tbody>
                        </table>
                    </div>

                    <button type="button" class="w-full mt-4 py-3 rounded-xl border border-dashed border-slate-300 text-slate-500 hover:text-[#355C7D] hover:border-[#355C7D] font-semibold text-sm transition duration-150">
                        + Agregar familiar
                    </button>
                </div>

                <!-- BOTONES DE ACCIÓN -->
                <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm px-6 py-5 flex items-center justify-end gap-4">
                    <a href="" class="px-5 py-2.5 text-sm font-semibold text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition duration-150">
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
        </main>
    </div>
</x-app-layout>