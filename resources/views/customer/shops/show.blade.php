@extends('layouts.app')

@section('title', $shop->shop_name)

@section('content')
<div class="card">
    <h1>{{ $shop->shop_name }}</h1>
    <p><strong>Owner:</strong> {{ $shop->owner->name }}</p>
    <p><strong>Location:</strong> {{ $shop->location }}</p>
    @if($shop->owner->phone)
        <p><strong>Contact:</strong> {{ $shop->owner->phone }}</p>
    @endif
    <p><strong>Opening Hours:</strong> {{ $shop->opening_hours }} - {{ $shop->closing_hours }}</p>
    <div class="rating">
        ★ {{ number_format($shop->average_rating, 1) }} ({{ $shop->total_reviews }} reviews)
    </div>
</div>

<div class="card">
    <h2>Available Services</h2>
    @if($shop->offeredServices->isEmpty())
        <p>This shop has not added any services yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shop->offeredServices as $offeredService)
                    <tr>
                        <td>{{ $offeredService->service->service_name }}</td>
                        <td>${{ number_format($offeredService->cost, 2) }}</td>
                        <td>
                            <form action="{{ route('customer.cart.add') }}" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="offered_service_id" value="{{ $offeredService->id }}">
                                <button type="submit" class="btn btn-success">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="card">
    <h2>Customer Reviews</h2>
    @if($shop->reviews->isEmpty())
        <p>No reviews yet. Be the first to review this shop!</p>
    @else
        @foreach($shop->reviews as $review)
            <div style="border-bottom: 1px solid #ddd; padding: 1rem 0;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <strong>{{ $review->user->name }}</strong>
                    <div class="rating">★ {{ $review->rating }}/5</div>
                </div>
                <p>{{ $review->comment }}</p>
                <small style="color: #666;">{{ $review->created_at->format('M d, Y') }}</small>
            </div>
        @endforeach
    @endif

    <h3 style="margin-top: 2rem;">Write a Review</h3>
    <form action="{{ route('customer.reviews.store', $shop->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="rating">Rating</label>
            <select id="rating" name="rating" class="form-control" required>
                <option value="">Select Rating</option>
                <option value="5">5 - Excellent</option>
                <option value="4">4 - Very Good</option>
                <option value="3">3 - Good</option>
                <option value="2">2 - Fair</option>
                <option value="1">1 - Poor</option>
            </select>
            @error('rating')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" class="form-control" rows="4" required></textarea>
            @error('comment')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>

<a href="{{ route('customer.shops.index') }}" class="btn btn-secondary">Back to Shops</a>
@endsection
