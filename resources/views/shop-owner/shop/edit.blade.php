@extends('layouts.app')

@section('title', 'Edit Shop')

@section('content')
<h1>Edit Your Shop</h1>

<div class="card">
    <form action="{{ route('shop-owner.shop.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="shop_name">Shop Name</label>
            <input type="text" id="shop_name" name="shop_name" class="form-control"
                   value="{{ old('shop_name', $shop->shop_name) }}" required>
            @error('shop_name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <textarea id="location" name="location" class="form-control" rows="2" required>{{ old('location', $shop->location) }}</textarea>
            @error('location')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="opening_hours">Opening Hours</label>
            <input type="text" id="opening_hours" name="opening_hours" class="form-control"
                   value="{{ old('opening_hours', $shop->opening_hours) }}" required>
            @error('opening_hours')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="closing_hours">Closing Hours</label>
            <input type="text" id="closing_hours" name="closing_hours" class="form-control"
                   value="{{ old('closing_hours', $shop->closing_hours) }}" required>
            @error('closing_hours')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $shop->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Shop</button>
        <a href="{{ route('shop-owner.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<div class="card">
    <h3>Shop Statistics</h3>
    <div class="stats">
        <div class="stat-card">
            <h3>{{ number_format($shop->average_rating, 1) }}</h3>
            <p>Average Rating</p>
        </div>
        <div class="stat-card">
            <h3>{{ $shop->total_reviews }}</h3>
            <p>Total Reviews</p>
        </div>
    </div>
</div>
@endsection
