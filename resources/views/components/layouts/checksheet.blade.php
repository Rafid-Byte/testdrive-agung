<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Check Sheet Security - Toyota Test Drive')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    @auth
        {{-- Header dengan navigasi untuk user yang login --}}
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 mb-6">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 underline">
                            ← Dashboard
                        </a>
                        <span class="text-gray-400">|</span>
                        <span class="text-gray-600 dark:text-gray-300 font-medium">Check Sheet Security</span>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600 dark:text-gray-300">
                            {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
    @endauth

    @yield('content')

    @yield('scripts')
</body>
</html>