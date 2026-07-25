<x-app-layout>
    <div class="min-h-screen bg-slate-50 flex flex-col md:flex-row">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-10 space-y-6" x-data="{ tab: 'datos' }">

            <!-- HEADER: Nombre + Botón Editar -->
            <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                        Detalle del Interno
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">nombre completo</p>
                    <p class="text-slate-400 text-xs mt-0.5">fecha ingreso</p>
                </div>

                <a href="#" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#355C7D] hover:bg-[#2A4A66] active:bg-[#1F3850] text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg shadow-[#355C7D]/20 transition duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar interno
                </a>
            </div>

            <!-- TABS -->
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm">
                <div class="flex flex-wrap gap-1 p-2 border-b border-slate-100">
                    <button @click="tab = 'datos'" :class="tab === 'datos' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Datos generales
                    </button>
                    <button @click="tab = 'historial'" :class="tab === 'historial' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Historial clínico
                    </button>
                    <button @click="tab = 'medicamentos'" :class="tab === 'medicamentos' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Medicamentos
                    </button>
                    <button @click="tab = 'mediciones'" :class="tab === 'mediciones' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Mediciones
                    </button>
                    <button @click="tab = 'alertas'" :class="tab === 'alertas' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Alertas
                    </button>
                    <button @click="tab = 'incidencias'" :class="tab === 'incidencias' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Incidencias
                    </button>
                    <button @click="tab = 'familiares'" :class="tab === 'familiares' ? 'bg-[#355C7D] text-white' : 'text-slate-500 hover:bg-slate-50'" class="px-4 py-2 rounded-xl text-sm font-semibold transition duration-150">
                        Familiares
                    </button>
                </div>

                <!-- CONTENIDO DE CADA PESTAÑA -->
                <div class="p-6 md:p-8">

                    <!-- DATOS GENERALES -->
                    <div x-show="tab === 'datos'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Datos generales</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre completo</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                    bolillo
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de nacimiento</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                   bolillo
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Sexo</label>
                                <p class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
                                    bolillo
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                                <span class="inline-block rounded-full px-3 py-1 text-xs font-semibold">
                                    bolillo
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- HISTORIAL CLÍNICO -->
                    <div x-show="tab === 'historial'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Historial clínico</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de sangre</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">bolillo</p>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Peso / Estatura</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">bolillo</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Alergias</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 min-h-[60px]">bolillo</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Padecimientos</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 min-h-[60px]">bolillo</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Observaciones generales</label>
                                <p class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-600 min-h-[60px]">bolillo</p>
                            </div>
                        </div>
                    </div>

                    <!-- MEDICAMENTOS -->
                    <div x-show="tab === 'medicamentos'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Medicamentos asignados</h2>
                        <div class="rounded-xl border border-slate-200 min-h-[120px] flex items-center justify-center text-sm text-slate-400">
                            Tabla de medicamentos asignados (pendiente de conectar)
                        </div>
                    </div>

                    <!-- MEDICIONES -->
                    <div x-show="tab === 'mediciones'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Mediciones</h2>
                        <div class="rounded-xl border border-slate-200 min-h-[120px] flex items-center justify-center text-sm text-slate-400">
                            Registro de signos vitales / IoT (pendiente de conectar)
                        </div>
                    </div>

                    <!-- ALERTAS -->
                    <div x-show="tab === 'alertas'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Alertas</h2>
                        <div class="rounded-xl border border-slate-200 min-h-[120px] flex items-center justify-center text-sm text-slate-400">
                            Sin alertas registradas
                        </div>
                    </div>

                    <!-- INCIDENCIAS -->
                    <div x-show="tab === 'incidencias'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Incidencias</h2>
                        <div class="rounded-xl border border-slate-200 min-h-[120px] flex items-center justify-center text-sm text-slate-400">
                            Sin incidencias registradas
                        </div>
                    </div>

                    <!-- FAMILIARES -->
                    <div x-show="tab === 'familiares'" x-cloak>
                        <h2 class="text-lg font-bold text-[#0C3B5E] mb-5">Familiares</h2>
                        <div class="rounded-xl border border-slate-200 min-h-[120px] flex items-center justify-center text-sm text-slate-400">
                            Sin familiares registrados
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>