<!DOCTYPE html>
<html 
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="dark">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href={{ asset('css/NavBar.css') }} rel="stylesheet">
        <link href={{ asset('css/Dashboard.css') }} rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="{{ asset('javascript/Dashboard.js') }}"> </script>
        <script src="{{ asset('javascript/Profile.js') }}"> </script>
        <script src="{{ asset('javascript/Share.js') }}"> </script>
        <script src="{{ asset('javascript/Animations.js') }}"> </script>
        <script src="{{ asset('javascript/NavBar.js') }}"> </script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        

        

        <style> [x-cloak] { display: none; }</style> <!-- this to hide the form before the script is loaded for the creation of a post on the subpage. -->
        <!-- Note! everything using the x-cloak will be on cloak from the start! -->

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
