<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>
    <!-- Minimal CSS framework for instant clean styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <style>
        header { margin-bottom: 2rem; border-bottom: 1px solid var(--pico-muted-border-color); }
        .success-alert { background-color: var(--pico-ins-color); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; }
        .actions { display: flex; gap: 0.75rem; align-items: center; }
        .actions form { margin: 0; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <ul>
                    <li><strong><a href="{{ route('home') }}" class="contrast">My CMS Website</a></strong></li>
                </ul>
                <ul>
                    <li><a href="{{ route('posts.create') }}" role="button">+ Create Post</a></li>
                </ul>
            </nav>
        </header>

        <main>
            @if(session('success'))
                <div class="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>