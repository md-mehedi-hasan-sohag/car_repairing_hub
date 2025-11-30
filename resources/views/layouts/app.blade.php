<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Car Repairing Hub')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/theme-toggle.js') }}"></script>
    <script src="{{ asset('js/password-toggle.js') }}" defer></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ url('/') }}" class="logo">Car Repairing Hub</a>
            <div class="nav-links">
                @auth
                    @if(auth()->user()->isCustomer())
                        <a href="{{ route('customer.dashboard') }}">Dashboard</a>
                        <a href="{{ route('customer.shops.index') }}">Browse Shops</a>
                        <a href="{{ route('customer.cart.index') }}">Cart</a>
                        <a href="{{ route('customer.profile.show') }}">Profile</a>
                        <a href="{{ route('customer.profile.change-password.show') }}">Change Password</a>
                    @elseif(auth()->user()->isShopOwner())
                        <a href="{{ route('shop-owner.dashboard') }}">Dashboard</a>
                        <a href="{{ route('shop-owner.services.index') }}">Services</a>
                        <a href="{{ route('shop-owner.profile.show') }}">Profile</a>
                        <a href="{{ route('shop-owner.profile.change-password.show') }}">Change Password</a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a href="{{ route('admin.users.index') }}">Users</a>
                        <a href="{{ route('admin.shops.index') }}">Shops</a>
                        <a href="{{ route('admin.services.index') }}">Services</a>
                    @endif
                    <button id="theme-toggle" aria-label="Toggle dark mode">🌙</button>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-link" title="{{ auth()->user()->name }}">
                            Logout{{ auth()->user()->isAdmin() ? ' (' . auth()->user()->name . ')' : '' }}
                        </button>
                    </form>
                @else
                    <button id="theme-toggle" aria-label="Toggle dark mode">🌙</button>
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Car Repairing Hub. All rights reserved by Md. Mehedi Hasan Sohag.</p>
        </div>
    </footer>
</body>
</html>
