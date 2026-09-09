<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $globalSettings['site_name'] ?? config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen">

    @include('layouts.navigation')

    <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4" style="color: {{ $globalSettings['primary_color'] ?? '#2563eb' }};">
            Welcome to {{ $globalSettings['site_name'] ?? 'Our Website' }}
        </h1>
        <p class="text-lg text-gray-600 mb-8">Use the top navigation bar to explore standalone pages or access the admin panel.</p>

        @auth
            <div class="inline-flex space-x-4">
                <a href="{{ route('admin.pages.index') }}" class="text-white font-medium px-5 py-2.5 rounded-lg shadow hover:opacity-90" style="background-color: {{ $globalSettings['primary_color'] ?? '#2563eb' }};">
                    Manage Pages
                </a>
                <a href="{{ route('admin.menu.index') }}" class="bg-gray-800 text-white font-medium px-5 py-2.5 rounded-lg shadow hover:bg-gray-900">
                    Menu Builder
                </a>
            </div>
        @else
            <a href="{{ route('login') }}" class="text-white font-medium px-5 py-2.5 rounded-lg shadow hover:opacity-90" style="background-color: {{ $globalSettings['primary_color'] ?? '#2563eb' }};">
                Log In to Admin
            </a>
        @endauth
    </main>

</body>
</html>