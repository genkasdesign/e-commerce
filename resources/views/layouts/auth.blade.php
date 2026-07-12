<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-950 text-gray-200">
    <div class="min-h-screen flex flex-col bg-gray-950">
        <!-- Barre de navigation minimaliste -->
        <nav class="border-b border-gray-800 bg-gray-900/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="shrink-0 flex items-center">
                        <a href="/" class="logo text-2xl font-bold hover:opacity-80 transition">
                            MonShop
                        </a>
                    </div>
                    <!-- Pas de boutons Login/Register ici -->
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="flex-1 flex items-center justify-center py-12">
            @yield('content')
        </main>

        <!-- Pas de footer -->
    </div>
</body>
</html>