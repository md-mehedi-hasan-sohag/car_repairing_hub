@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<h1>Checkout</h1>

<div class="card">
    <h2>Order Summary</h2>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Shop</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->offeredService->service->service_name }}</td>
                    <td>{{ $item->offeredService->shop->shop_name }}</td>
                    <td>${{ number_format($item->offeredService->cost, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->offeredService->cost * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total Amount:</strong></td>
                <td><strong>${{ number_format($total, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="card">
    <h2>Payment Method</h2>
    <form action="{{ route('customer.payment.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="transaction_type">Select Payment Method</label>
            <select id="transaction_type" name="transaction_type" class="form-control" required>
                <option value="">Choose a payment method</option>
                <option value="cash">Cash</option>
                <option value="card">Credit/Debit Card</option>
                <option value="online">Online Payment</option>
            </select>
            @error('transaction_type')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <a href="{{ route('customer.cart.index') }}" class="btn btn-secondary">Back to Cart</a>
            <button type="submit" class="btn btn-success">Complete Payment</button>
        </div>
    </form>
</div>
@endsection
