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
                Iniciar sesión
            </h1>
            <p class="text-slate-500 text-sm sm:text-base mt-2 font-normal">
                Ingresa tus datos para acceder a Vitalia
            </p>
        </div>

        <!-- Session Status Alert -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
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
                    autocomplete="username" 
                    placeholder="Campo de texto" 
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm transition duration-200 focus:bg-white focus:outline-none focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 @error('email') border-red-500 @enderror"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500" />
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Contraseña
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                    placeholder="Campo de contraseña" 
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm transition duration-200 focus:bg-white focus:outline-none focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 @error('password') border-red-500 @enderror"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
            </div>

            <!-- Forgot Password Link -->
            <div class="flex items-center justify-end pt-1">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs sm:text-sm font-medium text-[#0C3B5E] hover:text-[#4EBA87] transition-colors duration-200 focus:outline-none focus:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <!-- Submit Button (Ingresar) -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-4 bg-[#0C3B5E] hover:bg-[#082942] active:bg-[#051C2E] text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg shadow-[#0C3B5E]/20 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-4 focus:ring-[#0C3B5E]/30"
                >
                    Ingresar
                </button>
            </div>
        </form>

        <!-- Divider (O) -->
        <div class="relative my-7 flex items-center justify-center">
            <div class="w-full border-t border-slate-200"></div>
            <span class="absolute bg-white px-4 text-xs font-semibold text-slate-400 tracking-wider">
                O
            </span>
        </div>

        <!-- Register Link Button (Crear cuenta) -->
        <div>
            @if (Route::has('register'))
                <a 
                    href="{{ route('register') }}" 
                    class="w-full inline-flex items-center justify-center py-3 px-4 border border-slate-300 hover:border-[#0C3B5E] bg-white hover:bg-slate-50 text-slate-700 hover:text-[#0C3B5E] font-semibold text-sm rounded-xl transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-slate-200"
                >
                    Crear cuenta
                </a>
            @endif
        </div>
    </div>
</x-guest-layout>
