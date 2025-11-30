@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<h1>My Profile</h1>

<div class="card">
    <h2>Update Profile Information</h2>
    <form action="{{ route('customer.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control"
                   value="{{ old('name', auth()->user()->name) }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" class="form-control"
                   value="{{ auth()->user()->email }}" disabled>
            <small style="color: #666;">Email cannot be changed</small>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" class="form-control"
                   value="{{ old('phone', auth()->user()->phone) }}">
            @error('phone')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', auth()->user()->address) }}</textarea>
            @error('address')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
