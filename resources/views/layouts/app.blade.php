<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Website')</title>
    
    <!-- Pico CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    
    <style>
        header { margin-bottom: 2rem; border-bottom: 1px solid var(--pico-muted-border-color); }
        .success-alert { background-color: var(--pico-ins-color); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; }
        .error-alert { background-color: var(--pico-del-color); color: white; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; }
        
        /* Navigation & Button Layout */
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

        /* Fix Pico CSS breaking CKEditor SVG icons & collapsing toolbar */
        .ck.ck-toolbar {
            display: flex !important;
            flex-wrap: wrap !important;
            align-items: center !important;
            background-color: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            padding: 0.25rem !important;
        }

        .ck.ck-toolbar button,
        .ck.ck-toolbar .ck-button {
            all: unset !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0.35rem 0.5rem !important;
            border-radius: 0.25rem !important;
            cursor: pointer !important;
            background: transparent !important;
            width: auto !important;
            height: auto !important;
        }

        .ck.ck-toolbar button:hover,
        .ck.ck-toolbar .ck-button:hover {
            background-color: #e2e8f0 !important;
        }

        /* Force SVG toolbar icons to render at fixed 16px size */
        .ck.ck-toolbar svg,
        .ck.ck-toolbar .ck-icon {
            display: inline-block !important;
            width: 16px !important;
            height: 16px !important;
            max-width: 16px !important;
            max-height: 16px !important;
            vertical-align: middle !important;
        }

        /* Fix Editor Editable Area */
        .ck-editor__editable {
            color: #111827 !important;
            min-height: 250px;
            background-color: #ffffff !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <<nav>
    <ul>
        <li><a href="{{ route('home') }}">Home</a></li>

        {{-- Locate your existing session('is_admin') check and update it --}}
        @if (session('is_admin'))
            <li><a href="{{ route('posts.create') }}">New Post</a></li>
            <li><a href="{{ route('posts.drafts') }}">Drafts</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="secondary outline" style="padding: 0.25rem 0.5rem;">Logout</button>
                </form>
            </li>
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