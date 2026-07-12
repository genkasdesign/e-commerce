<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GenShop') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="font-sans antialiased bg-gray-950 text-gray-200">
    <div class="min-h-screen flex flex-col bg-gray-950">
        <!-- ⚠️ NAVIGATION EN PREMIER -->
        @include('layouts.navigation')

        @if (isset($header))
            <header class="border-b border-gray-800 bg-gray-900/80">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Messages Flash -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if(session('success'))
                <div class="bg-green-900/30 border-l-4 border-green-500 text-green-300 p-4 rounded-r-lg shadow-sm">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-900/30 border-l-4 border-red-500 text-red-300 p-4 rounded-r-lg shadow-sm">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
        </div>

        <!-- Contenu principal -->
        <main class="flex-1 py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        @auth
            @if(auth()->user()->isAdmin())
                @include('layouts.admin-footer')
            @else
                @include('layouts.footer')
            @endif
        @else
            @include('layouts.footer')
        @endauth
    </div>

    @stack('scripts')
</body>
</html>