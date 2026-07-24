<style>
    .item-side-bar:hover{
        background-color: #355C7D;
        border-radius: 12px;
    }

    .item-side-bar:hover a {
        color: white;
    }

    .item-side-bar:hover svg {
        color: white;
    }
</style>
<aside class="w-full md:w-64 bg-white border-r border-slate-200/80 p-6 flex-shrink-0">
    <div class="space-y-6">
        <!-- Navigation Items -->
        <nav class="space-y-2">     
            <!-- Inicio -->
            <div class="item-side-bar">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-slate-600 rounded-xl font-semibold text-sm">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Inicio
                </a>
            </div>
            
            <!-- Cuidadores -->
            <div class="item-side-bar">
                <a href="{{ route('cuidadores.index')}}" class="flex items-center px-4 py-3 text-slate-600 rounded-xl font-semibold text-sm">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Cuidadores
                </a>
            </div>
           
            <!-- Internos  -->
            <div class="item-side-bar">
                <a href="{{ route('internos.index') }}" class="flex items-center px-4 py-3 text-slate-600 rounded-xl font-semibold text-sm">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Internos
                </a>
            </div>
            
            
            <!-- Familiares -->
            <div class="item-side-bar">
                <a href="{{ route('familiares.index')}}" class="flex items-center px-4 py-3 text-slate-600 rounded-xl font-semibold text-sm">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Familiares
                </a>
            </div>
            

            <!-- Incidencias -->
            <div class="item-side-bar">
                <a href="#" class="flex items-center px-4 py-3 text-slate-600 rounded-xl font-semibold text-sm">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Incidencias
                </a>
            </div>

            <!-- Alertas -->
            <div class="item-side-bar">
                <a href="#" class="flex items-center px-4 py-3 text-slate-600 rounded-xl font-semibold text-sm">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    Alertas
                </a>
            </div>
            

            <!-- Configuración -->
            <div class="item-side-bar">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-slate-600 rounded-xl font-semibold text-sm">
                    <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Configuración
                </a>
            </div>
        </nav>
    </div>
</aside>