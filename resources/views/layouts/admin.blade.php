<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($globalSettings['site_name']) ? $globalSettings['site_name'] : config('app.name', 'Laravel') }} - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dynamic Theme Styling -->
    @php
        $primaryColor = $globalSettings['primary_color'] ?? '#2563eb';
    @endphp
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
        }
        .bg-primary { background-color: var(--primary-color) !important; }
        .text-primary { color: var(--primary-color) !important; }
        .border-primary { border-color: var(--primary-color) !important; }
        button[type="submit"], .btn-primary {
            background-color: var(--primary-color) !important;
        }
        button[type="submit"]:hover, .btn-primary:hover {
            filter: brightness(0.9);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen">
    @include('layouts.navigation')

    <main class="py-8">
        @yield('content')
    </main>
</body>
</html>