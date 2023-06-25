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
    <body class="font-sans text-gray-900 antialiased">
        <section class="min-h-screen flex bg-neutral-200 dark:bg-neutral-700">
            <div class="rounded-lg bg-white shadow-lg my-8 dark:bg-neutral-800 w-11/12 mx-auto lg:my-auto flex items-center justify-center">
                <div class="flex flex-col-reverse lg:flex-row-reverse lg:flex-wrap">
                    {{ $slot }}
                </div>
            </div>
        </section>
    </body>  
</html>
