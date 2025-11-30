@extends('layouts.app')

@section('title', 'Browse Repair Shops')

@section('content')
<h1>Browse Repair Shops</h1>

<div class="card">
    <form action="{{ route('customer.shops.index') }}" method="GET">
        <div class="grid">
            <div class="form-group">
                <label for="search">Search by Name or Location</label>
                <input type="text" id="search" name="search" class="form-control"
                       placeholder="Search shops..." value="{{ request('search') }}">
            </div>
            <div class="form-group">
                <label for="service">Filter by Service</label>
                <select id="service" name="service" class="form-control">
                    <option value="">All Services</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                                {{ request('service') == $service->id ? 'selected' : '' }}>
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('customer.shops.index') }}" class="btn btn-secondary">Clear Filters</a>
    </form>
</div>

@if($shops->isEmpty())
    <div class="card">
        <p>No repair shops found. Try adjusting your search criteria.</p>
    </div>
@else
    <div class="grid">
        @foreach($shops as $shop)
            <div class="shop-card">
                <h3>{{ $shop->shop_name }}</h3>
                <p><strong>Owner:</strong> {{ $shop->owner->name }}</p>
                <p><strong>Location:</strong> {{ $shop->location }}</p>
                @if($shop->owner->phone)
                    <p><strong>Phone:</strong> {{ $shop->owner->phone }}</p>
                @endif
                <p><strong>Hours:</strong> {{ $shop->opening_hours }} - {{ $shop->closing_hours }}</p>
                <div class="rating">
                    ★ {{ number_format($shop->average_rating, 1) }} ({{ $shop->total_reviews }} reviews)
                </div>
                <a href="{{ route('customer.shops.show', $shop->id) }}" class="btn btn-primary">View Details</a>
            </div>
        @endforeach
    </div>

    <div style="margin-top: 2rem;">
        {{ $shops->links() }}
    </div>
@endif
@endsection
