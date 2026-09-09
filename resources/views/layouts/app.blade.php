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
        
        /* Unified button & form alignment resets */
        .actions, nav ul {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        .actions form, nav form {
            margin: 0;
            display: inline-flex;
        }
        .actions button, 
        .actions a[role="button"],
        nav a[role="button"],
        nav button {
            margin: 0 !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 2.25rem;
            padding: 0 0.85rem;
            font-size: 0.875rem;
            line-height: 1;
        }
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
                        <li><a href="{{ route('posts.drafts') }}" class="secondary">Drafts</a></li>
                        <li><a href="{{ route('posts.create') }}" role="button" class="outline">+ Create Post</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="secondary outline">Logout</button>
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