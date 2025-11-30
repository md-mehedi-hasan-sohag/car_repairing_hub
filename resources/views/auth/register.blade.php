@extends('layouts.app')

@section('title', 'Register - Car Repairing Hub')

@section('content')
<div class="card" style="max-width: 600px; margin: 3rem auto;">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
            @error('address')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="user_type">Register As</label>
            <select name="user_type" id="user_type" class="form-control" required onchange="toggleLicense(this.value)">
                <option value="customer">Customer</option>
                <option value="shop_owner">Shop Owner</option>
            </select>
            @error('user_type')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group" id="license_group" style="display: none;">
            <label for="license_no">License Number</label>
            <input type="text" name="license_no" id="license_no" class="form-control" value="{{ old('license_no') }}">
            @error('license_no')
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
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p style="margin-top: 1rem;">Already have an account? <a href="{{ route('login') }}">Login here</a></p>

    <script>
        function toggleLicense(userType) {
            document.getElementById('license_group').style.display = userType === 'shop_owner' ? 'block' : 'none';
        }
    </script>
</div>
@endsection
