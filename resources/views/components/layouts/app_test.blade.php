<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel E-commerce') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-gray-50">
    <div class="flex flex-col min-h-screen">
        {{-- @include('layouts.navigation') --}}
        @include('components.layouts.navigation')
        
        <main class="flex-grow">
            {{ $slot }}
        </main>
        
        {{-- @include('layouts.footer') --}}
        {{-- @include('components.layouts.footer') --}} {{-- doesn't exist --}}
    </div>
    
    @livewireScripts
</body>
</html>
