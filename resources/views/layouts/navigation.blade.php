@php
    $countNotifPending = \App\Models\Notification::whereIn('estado', ['Pendiente', 'Enviado'])->count();
    $countAlertsActive = \App\Models\Alert::whereIn('estado', ['Activa', 'activa', 'Pendiente', 'pendiente'])->count();
    $totalNotificaciones = max($countNotifPending, $countAlertsActive);

    $listaNotificaciones = \App\Models\Notification::with('resident')->latest()->take(5)->get();
    $esAlerta = false;
    if ($listaNotificaciones->isEmpty()) {
        $listaNotificaciones = \App\Models\Alert::with('resident')->latest()->take(5)->get();
        $esAlerta = true;
    }
@endphp

<nav x-data="{ open: false, notifOpen: false }" class="bg-white border-b border-slate-200/80 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-4">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <x-application-logo class="block h-10 w-auto transition-transform duration-200 group-hover:scale-105" />
                        <span class="text-xl font-extrabold text-[#0C3B5E] tracking-tight">Vitalia</span>
                    </a>
                </div>
            </div>

            <!-- Right Navigation Items (Notificaciones, Admin, Configuración) -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6 lg:space-x-8">
                
                <!-- NOTIFICACIONES DROPDOWN -->
                <div class="relative" @click.outside="notifOpen = false">
                    <button 
                        @click="notifOpen = !notifOpen"
                        class="relative inline-flex items-center px-4 py-2 border border-slate-200 text-sm font-semibold rounded-xl text-slate-700 bg-slate-50 hover:bg-slate-100 hover:text-[#0C3B5E] transition duration-150 focus:outline-none cursor-pointer">
                        <span>Notificaciones ({{ $totalNotificaciones }})</span>
                        @if($totalNotificaciones > 0)
                            <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Panel -->
                    <div 
                        x-show="notifOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-3 w-88 sm:w-[420px] bg-white rounded-2xl shadow-xl border border-slate-200/80 z-50 overflow-hidden"
                        style="display: none;">
                        
                        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-200/80 flex items-center justify-between">
                            <span class="text-xs font-bold text-[#0C3B5E] uppercase tracking-wider">Notificaciones del sistema</span>
                        </div>

                        <div class="divide-y divide-slate-100 max-h-88 overflow-y-auto">
                            @forelse($listaNotificaciones as $notif)
                                <div class="px-6 py-4 hover:bg-slate-50/80 transition duration-150 flex items-start space-x-3.5">
                                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-800 truncate">
                                            @if($esAlerta)
                                                {{ $notif->tipo_alerta }}
                                            @else
                                                Notificación #{{ $notif->id }}
                                            @endif
                                            @if($notif->resident)
                                                • {{ $notif->resident->nombre }} {{ $notif->resident->apellido_paterno }}
                                            @endif
                                        </p>
                                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                            {{ $notif->mensaje ?? $notif->descripcion }}
                                        </p>
                                        <p class="text-[11px] font-medium text-slate-400 mt-1.5">
                                            {{ $notif->fecha_hora ? $notif->fecha_hora->diffForHumans() : ($notif->created_at ? $notif->created_at->diffForHumans() : 'Hace un momento') }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 px-6 text-center text-xs text-slate-400 font-medium">
                                    No hay notificaciones recientes.
                                </div>
                            @endforelse
                        </div>

                        <div class="px-6 py-3.5 bg-slate-50/80 border-t border-slate-200/80 text-center">
                            <a href="{{ route('alertas.index') }}" class="text-xs font-bold text-[#0C3B5E] hover:text-[#355C7D] transition">
                                Ver todas las alertas →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin: User Name -->
                <div class="flex items-center space-x-2.5 text-sm font-semibold text-slate-800 bg-slate-100/80 px-4 py-2 rounded-xl border border-slate-200">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-[#4EBA87]"></span>
                    <span class="text-slate-500 font-normal">Admin:</span>
                    <span class="text-[#0C3B5E] font-bold">
                        @if(Auth::check())
                            {{ Auth::user()->nombre ?? Auth::user()->name ?? 'Administrador' }} {{ Auth::user()->apellido_paterno ?? '' }}
                        @else
                            Administrador
                        @endif
                    </span>
                </div>

                <!-- Configuración Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-slate-200 text-sm leading-4 font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 hover:text-[#0C3B5E] focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                            <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Configuración</span>
                            <svg class="ms-2 h-4 w-4 text-slate-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-50 border-t border-slate-200 px-4 py-4 space-y-3">
        <div class="flex items-center justify-between text-sm font-semibold text-slate-700 px-2">
            <span>Admin: {{ Auth::check() ? (Auth::user()->nombre ?? Auth::user()->name ?? 'Administrador') : 'Administrador' }}</span>
            <span class="bg-amber-100 text-amber-800 text-xs px-2.5 py-1 rounded-full font-bold">{{ $totalNotificaciones }} Notificaciones</span>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::check() ? (Auth::user()->usuario ?? Auth::user()->name ?? '') : '' }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::check() ? (Auth::user()->correo ?? Auth::user()->email ?? '') : '' }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil de usuario') }}
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
    </div>
</nav>
