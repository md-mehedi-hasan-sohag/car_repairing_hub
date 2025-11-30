@extends('layouts.app')

@section('title', 'Shop Owner Dashboard')

@section('content')
<h1>Shop Owner Dashboard</h1>

@if($shop)
<div class="stats">
    <div class="stat-card">
        <h3>{{ $totalServices }}</h3>
        <p>Services Offered</p>
    </div>
    <div class="stat-card">
        <h3>{{ number_format($averageRating, 1) }}</h3>
        <p>Average Rating</p>
    </div>
    <div class="stat-card">
        <h3>{{ $totalReviews }}</h3>
        <p>Total Reviews</p>
    </div>
</div>

<div class="card">
    <h2>{{ $shop->shop_name }}</h2>
    <p><strong>Location:</strong> {{ $shop->location }}</p>
    <p><strong>Hours:</strong> {{ $shop->opening_hours }} - {{ $shop->closing_hours }}</p>
    <a href="{{ route('shop-owner.shop.edit') }}" class="btn btn-primary">Edit Shop</a>
    <a href="{{ route('shop-owner.services.index') }}" class="btn btn-success">Manage Services</a>
</div>
@else
<div class="card">
    <p>You haven't created your shop yet.</p>
    <a href="{{ route('shop-owner.shop.create') }}" class="btn btn-primary">Create Shop</a>
</div>
@endif
@endsection
