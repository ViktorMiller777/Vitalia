<x-guest-layout>
    <div class="bg-white border border-slate-200/80 shadow-xl shadow-slate-200/60 rounded-3xl p-8 sm:p-10 w-full transition-all duration-300">
        <!-- Logo Header -->
        <div class="flex justify-center mb-6">
            <a href="/" class="group">
                <x-application-logo class="h-24 w-auto transition-transform duration-300 group-hover:scale-105" />
            </a>
        </div>

        <!-- Title & Subtitle -->
        <div class="text-center mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0C3B5E] tracking-tight">
                Recuperar contraseña
            </h1>
            <p class="text-slate-500 text-sm sm:text-base mt-2 font-normal">
                Ingresa tu correo para recibir un código
            </p>
        </div>

        <!-- Session Status Alert -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <!-- Forgot Password Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Correo electrónico -->
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Correo electrónico
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    placeholder="Campo de texto" 
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm transition duration-200 focus:bg-white focus:outline-none focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 @error('email') border-red-500 @enderror"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
            </div>

            <!-- Submit Button (Enviar código) -->
            <div>
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-4 bg-[#0C3B5E] hover:bg-[#082942] active:bg-[#051C2E] text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg shadow-[#0C3B5E]/20 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-4 focus:ring-[#0C3B5E]/30"
                >
                    Enviar código
                </button>
            </div>
        </form>

        <!-- Back to Login Link -->
        <div class="mt-6 text-center sm:text-left">
            <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-[#0C3B5E] transition-colors duration-200 focus:outline-none focus:underline">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al login
            </a>
        </div>
    </div>
</x-guest-layout>
