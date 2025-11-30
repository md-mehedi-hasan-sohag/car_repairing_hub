@extends('layouts.app')

@section('title', 'Manage Shops')

@section('content')
<h1>Shop Management</h1>

<div class="card">
    <form action="{{ route('admin.shops.index') }}" method="GET">
        <div class="form-group">
            <label for="search">Search by Shop Name or Location</label>
            <input type="text" id="search" name="search" class="form-control"
                   placeholder="Search shops..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin.shops.index') }}" class="btn btn-secondary">Clear</a>
    </form>
</div>

<div class="card">
    <h2>All Shops ({{ $shops->total() }} total)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Shop Name</th>
                <th>Owner</th>
                <th>Location</th>
                <th>Rating</th>
                <th>Reviews</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shops as $shop)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td>{{ $shop->shop_name }}</td>
                    <td>{{ $shop->owner->name }}</td>
                    <td>{{ Str::limit($shop->location, 40) }}</td>
                    <td>
                        <div class="rating">
                            ★ {{ number_format($shop->average_rating, 1) }}
                        </div>
                    </td>
                    <td>{{ $shop->total_reviews }}</td>
                    <td>{{ $shop->created_at->format('M d, Y') }}</td>
                    <td>
                        <form action="{{ route('admin.shops.destroy', $shop->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this shop?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No shops found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1rem;">
        {{ $shops->links() }}
    </div>
</div>
@endsection
