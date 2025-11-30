@extends('layouts.app')

@section('title', 'Payment History')

@section('content')
<h1>Payment History</h1>

@if($payments->isEmpty())
    <div class="card">
        <p>No payment history found.</p>
        <a href="{{ route('customer.shops.index') }}" class="btn btn-primary">Browse Shops</a>
    </div>
@else
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Service</th>
                    <th>Shop</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->transaction_id }}</td>
                        <td>{{ $payment->select->offeredService->service->service_name }}</td>
                        <td>{{ $payment->select->offeredService->shop->shop_name }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->transaction_type) }}</td>
                        <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            {{ $payments->links() }}
        </div>
    </div>
@endif
@endsection
