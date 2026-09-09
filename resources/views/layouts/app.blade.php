<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <style>
        header { margin-bottom: 2rem; border-bottom: 1px solid var(--pico-muted-border-color); }
        .success-alert { background-color: var(--pico-ins-color); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; }
        .error-alert { background-color: var(--pico-del-color); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; }
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
                    @if(session('is_admin'))
                        <li><a href="{{ route('posts.create') }}" role="button" class="outline">+ Create Post</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="secondary outline" style="padding: 0.25rem 0.75rem;">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="secondary">Admin Login</a></li>
                    @endif
                </ul>
            </nav>
        </header>

        <main>
            @if(session('success'))
                <div class="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="error-alert">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>