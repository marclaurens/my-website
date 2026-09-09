@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div style="max-width: 450px; margin: 2rem auto;">
        <article>
            <header>
                <h1 style="margin: 0; font-size: 1.5rem;">Admin Login</h1>
            </header>

            @if ($errors->any())
                <div style="color: var(--pico-del-color); margin-bottom: 1rem;">
                    <ul style="margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <label for="password">Enter Admin Password</label>
                <input type="password" id="password" name="password" placeholder="Default: password123" required autofocus>

                <button type="submit">Log In</button>
            </form>
        </article>
    </div>
@endsection