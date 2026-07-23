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
                Cambiar contraseña
            </h1>
            <p class="text-slate-500 text-sm sm:text-base mt-2 font-normal">
                Crea una nueva contraseña
            </p>
        </div>

        <!-- Session Status Alert -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <!-- Reset Password Form -->
        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') ?? 'demo-token' }}">

            <!-- Email Address (Hidden if present, or optional field) -->
            <input type="hidden" name="email" value="{{ old('email', $request->email ?? '') }}">

            <!-- Nueva contraseña -->
            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Nueva contraseña
                </label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autofocus 
                    autocomplete="new-password" 
                    placeholder="Campo contraseña" 
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm transition duration-200 focus:bg-white focus:outline-none focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 @error('password') border-red-500 @enderror"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
            </div>

            <!-- Confirmar contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Confirmar contraseña
                </label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                    placeholder="Campo contraseña" 
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-slate-900 placeholder-slate-400 text-sm transition duration-200 focus:bg-white focus:outline-none focus:border-[#4EBA87] focus:ring-4 focus:ring-[#4EBA87]/15 @error('password_confirmation') border-red-500 @enderror"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
            </div>

            <!-- Submit Button (Guardar contraseña) -->
            <div class="pt-2">
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-4 bg-[#0C3B5E] hover:bg-[#082942] active:bg-[#051C2E] text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg shadow-[#0C3B5E]/20 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-4 focus:ring-[#0C3B5E]/30"
                >
                    Guardar contraseña
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
