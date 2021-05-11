<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles             {{-- estilos de livewire --}}

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">

<!-- instancio el componente de livewire 'Navigation' que esta en la carpeta App\Http\Livewire\Navigation.php -->
            @livewire('navigation')     {{-- siempre lo instancio en minusculas --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}     {{--aqui va todo el contenido de quien lo invoca o instancia--}}
            </main>
        </div>

        @stack('modals')

        @livewireScripts            {{-- scripts de livewire --}}
    </body>
</html>
