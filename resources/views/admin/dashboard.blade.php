@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h1>Admin Dashboard</h1>

<div class="stats">
    <div class="stat-card">
        <h3>{{ $totalCustomers }}</h3>
        <p>Total Customers</p>
    </div>
    <div class="stat-card">
        <h3>{{ $totalShopOwners }}</h3>
        <p>Total Shop Owners</p>
    </div>
    <div class="stat-card">
        <h3>{{ $totalShops }}</h3>
        <p>Total Shops</p>
    </div>
    <div class="stat-card">
        <h3>${{ number_format($totalRevenue, 2) }}</h3>
        <p>Total Revenue</p>
    </div>
</div>

<div class="card">
    <h2>Quick Actions</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
    <a href="{{ route('admin.shops.index') }}" class="btn btn-primary">Manage Shops</a>
    <a href="{{ route('admin.services.index') }}" class="btn btn-primary">Manage Services</a>
</div>
@endsection
