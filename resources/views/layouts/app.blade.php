<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=montserrat:300,300i,500,500i,700,700i,900,900i" rel="stylesheet" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">


        @stack('plugin-scripts')

        <livewire:styles />
    </head>

    <body class="antialiased">
        @include('includes.nav')
        <div id="app">
            @yield('content')
        </div>

        @include('includes.footer')


        @livewireScripts

        @stack('after-scripts')

    </body>

</html>
