<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- Polices --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400&family=Open+Sans:wght@800&family=Orienta&display=swap" rel="stylesheet">
                 
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        {{-- Script --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="flex flex-col min-h-screen">
        <div class="flex-grow">
            @include('layouts.side')

            <!-- Page Content -->
            <div class="lg:ml-64">     

                @isset($title)
                    <x-h1-title>{{ $title }}</x-h1-title>
                @endisset
                
                <div class="p-4 rounded-lg dark:border-gray-700">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
        <div class="lg:ml-64">
            @include('layouts.footer')
        </div>
    </body>
</html>
