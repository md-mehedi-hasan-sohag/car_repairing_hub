@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<h1>Welcome, {{ auth()->user()->name }}!</h1>
<div class="card">
    <h2>Available Repair Shops</h2>
    <a href="{{ route('customer.shops.index') }}" class="btn btn-primary">Browse All Shops</a>
</div>

<div class="grid">
    @foreach($shops as $shop)
        <div class="shop-card">
            <h3>{{ $shop->shop_name }}</h3>
            <p><strong>Location:</strong> {{ $shop->location }}</p>
            <p><strong>Hours:</strong> {{ $shop->opening_hours }} - {{ $shop->closing_hours }}</p>
            <div class="rating">
                ★ {{ number_format($shop->average_rating, 1) }} ({{ $shop->total_reviews }} reviews)
            </div>
            <a href="{{ route('customer.shops.show', $shop->id) }}" class="btn btn-primary">View Details</a>
        </div>
    @endforeach
</div>

{{ $shops->links() }}
@endsection
