@extends('layouts.app')

@section('title', 'Create Shop')

@section('content')
<h1>Create Your Shop</h1>

<div class="card">
    <form action="{{ route('shop-owner.shop.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="shop_name">Shop Name</label>
            <input type="text" id="shop_name" name="shop_name" class="form-control"
                   value="{{ old('shop_name') }}" required>
            @error('shop_name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <textarea id="location" name="location" class="form-control" rows="2" required>{{ old('location') }}</textarea>
            @error('location')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="opening_hours">Opening Hours</label>
            <input type="text" id="opening_hours" name="opening_hours" class="form-control"
                   value="{{ old('opening_hours') }}" placeholder="e.g., 9:00 AM" required>
            @error('opening_hours')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="closing_hours">Closing Hours</label>
            <input type="text" id="closing_hours" name="closing_hours" class="form-control"
                   value="{{ old('closing_hours') }}" placeholder="e.g., 6:00 PM" required>
            @error('closing_hours')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Shop</button>
        <a href="{{ route('shop-owner.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
