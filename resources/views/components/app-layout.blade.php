<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar>
        <!-- Sidebar content -->
    </flux:sidebar>
    
    <main class="lg:ps-64">
        {{ $slot }}
    </main>
    
    @stack('scripts')
</body>
</html>