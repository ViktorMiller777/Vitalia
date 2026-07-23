<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Vitalia') }} - Iniciar sesión</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-slate-100 min-h-screen flex items-center justify-center p-4 sm:p-6 selection:bg-[#4EBA87] selection:text-white">
        <!-- Subtle background decorative glow -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#4EBA87]/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-[#0C3B5E]/10 rounded-full blur-3xl"></div>
        </div>

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </body>
</html>

