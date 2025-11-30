@extends('layouts.app')

@section('title', 'Login - Car Repairing Hub')

@section('content')
<div class="card" style="max-width: 500px; margin: 3rem auto;">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
        <a href="{{ route('password.request') }}" style="margin-left: 1rem;">Forgot Password?</a>
    </form>
    <p style="margin-top: 1rem;">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
</div>
@endsection
