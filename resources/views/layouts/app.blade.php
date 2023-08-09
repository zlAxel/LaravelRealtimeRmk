<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('titulo')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Funciones --}}
        <script src="{{ asset('assets/js/functions.js') }}"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- ? Estilos por página --}}
        @stack('styles')
    </head>
    <body class="font-sans antialiased overflow-x-hidden">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @hasSection('titulo')
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            @yield('titulo')
                        </h2>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <x-notification></x-notification>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            @yield('contenido')
                        </div>
                    </div>
                </div>
            </main>
        </div>

        {{-- ? jQuery --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

        {{-- ? Scripts por página --}}
        @stack('scripts')

        {{-- ? Script para escuchar las notificaciones del usuario --}}
        <script>
            $(document).ready(function () {
                // Recuperamos el ID del usuario
                const userId = {{ auth()->user()->id }};

                Echo.private('notifications.' + userId)
                    .listen('ShowNotification', (e) => {
                        data = e.data
                        // ? Agregamos la notificación con los datos del evento
                        addNotification('Nueva compra', `Has vendido ${ data.amount }:`, data.product, 'success');
                    });
            });
        </script>
    </body>
</html>
