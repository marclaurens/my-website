@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <article style="max-width: 400px; margin: 2rem auto;">
        <h2>Admin Login</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Enter admin password">

            <button type="submit">Login</button>
        </form>
    </article>
@endsection