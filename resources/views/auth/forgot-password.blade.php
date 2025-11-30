@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="card" style="max-width: 500px; margin: 3rem auto;">
    <h2>Forgot Password</h2>
    <p>Enter your email address to reset your password.</p>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Send Reset Link</button>
        <a href="{{ route('login') }}" style="margin-left: 1rem;">Back to Login</a>
    </form>
</div>
@endsection
