<nav x-data="{ open: false }" class="bg-white border-b border-slate-200/80 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <x-application-logo class="block h-10 w-auto transition-transform duration-200 group-hover:scale-105" />
                        <span class="text-xl font-extrabold text-[#0C3B5E] tracking-tight">Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Right Navigation Items (Notificaciones, Admin, Configuración) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <!-- Notificaciones (3) -->
                <button class="relative inline-flex items-center px-3 py-1.5 border border-slate-200 text-xs sm:text-sm font-semibold rounded-xl text-slate-700 bg-slate-50 hover:bg-slate-100 hover:text-[#0C3B5E] transition duration-150 focus:outline-none">
                    <svg class="w-4 h-4 mr-1.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span>Notificaciones (3)</span>
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                    </span>
                </button>

                <!-- Admin: User Name -->
                <div class="flex items-center space-x-2 text-xs sm:text-sm font-semibold text-slate-800 bg-slate-100/80 px-3 py-1.5 rounded-xl border border-slate-200">
                    <span class="inline-block w-2 h-2 rounded-full bg-[#4EBA87]"></span>
                    <span class="text-slate-500 font-normal">Admin:</span>
                    <span class="text-[#0C3B5E] font-bold">{{ Auth::user()->name ?? 'Juan Pérez' }}</span>
                </div>

                <!-- Configuración Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-xs sm:text-sm leading-4 font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:text-[#0C3B5E] focus:outline-none transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-1.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>Configuración</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil de usuario') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-50 border-t border-slate-200 px-4 py-3 space-y-3">
        <div class="flex items-center justify-between text-sm font-semibold text-slate-700">
            <span>Admin: {{ Auth::user()->name ?? 'Juan Pérez' }}</span>
            <span class="bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full font-bold">3 Notificaciones</span>
        </div>
        <div class="pt-2 border-t border-slate-200 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Configuración / Perfil') }}
            </x-responsive-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Cerrar sesión') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
