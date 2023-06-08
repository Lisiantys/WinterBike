<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    @include('layouts.navigation')
    <body class="font-sans text-gray-900 antialiased">
        <div class="absolute inset-0 -z-10">
            <div class="bg-center bg-cover h-full w-full" style="background-image: url('/images/background.webp')"></div>
            <div class="bg-black bg-opacity-40 absolute inset-0"></div>
        </div>
        <div class="flex justify-center mt-0 sm:mt-32 pt-6 sm:pt-0">
            <div class="sm:w-full w-11/12  sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>    
</html>
