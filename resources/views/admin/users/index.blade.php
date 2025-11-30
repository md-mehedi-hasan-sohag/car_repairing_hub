@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<h1>User Management</h1>

<div class="card">
    <form action="{{ route('admin.users.index') }}" method="GET">
        <div class="grid">
            <div class="form-group">
                <label for="search">Search by Name or Email</label>
                <input type="text" id="search" name="search" class="form-control"
                       placeholder="Search users..." value="{{ request('search') }}">
            </div>
            <div class="form-group">
                <label for="user_type">Filter by User Type</label>
                <select id="user_type" name="user_type" class="form-control">
                    <option value="">All Users</option>
                    <option value="customer" {{ request('user_type') == 'customer' ? 'selected' : '' }}>Customers</option>
                    <option value="shop_owner" {{ request('user_type') == 'shop_owner' ? 'selected' : '' }}>Shop Owners</option>
                    <option value="admin" {{ request('user_type') == 'admin' ? 'selected' : '' }}>Admins</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Clear Filters</a>
    </form>
</div>

<div class="card">
    <h2>Users ({{ $users->total() }} total)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Phone</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.5rem; border-radius: 4px; background:
                            {{ $user->user_type == 'admin' ? '#3498db' : ($user->user_type == 'shop_owner' ? '#27ae60' : '#95a5a6') }};
                            color: white; font-size: 0.875rem;">
                            {{ ucfirst(str_replace('_', ' ', $user->user_type)) }}
                        </span>
                    </td>
                    <td>{{ $user->phone ?? '-' }}</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        @if(!$user->isAdmin())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        @else
                            <span style="color: #999;">Protected</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1rem;">
        {{ $users->links() }}
    </div>
</div>
@endsection
