@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<h1>Shopping Cart</h1>

@if($cartItems->isEmpty())
    <div class="card">
        <p>Your cart is empty.</p>
        <a href="{{ route('customer.shops.index') }}" class="btn btn-primary">Browse Shops</a>
    </div>
@else
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Shop</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->offeredService->service->service_name }}</td>
                        <td>{{ $item->offeredService->shop->shop_name }}</td>
                        <td>${{ number_format($item->offeredService->cost, 2) }}</td>
                        <td>
                            <form action="{{ route('customer.cart.update', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                       min="1" style="width: 60px;" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>${{ number_format($item->offeredService->cost * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Remove this item?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                    <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div style="margin-top: 1rem; display: flex; gap: 1rem;">
            <a href="{{ route('customer.shops.index') }}" class="btn btn-secondary">Continue Shopping</a>
            <a href="{{ route('customer.payment.create') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>
    </div>
@endif
@endsection
