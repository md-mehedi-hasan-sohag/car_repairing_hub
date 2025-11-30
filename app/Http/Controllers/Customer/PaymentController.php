<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Select;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create()
    {
        $cartItems = Select::with('offeredService.service', 'offeredService.shop')
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function($item) {
            return $item->offeredService->cost * $item->quantity;
        });

        return view('customer.payment.create', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required|in:cash,card,online',
        ]);

        $cartItems = Select::with('offeredService')
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty!');
        }

        DB::transaction(function() use ($cartItems, $request) {
            foreach ($cartItems as $item) {
                $amount = $item->offeredService->cost * $item->quantity;

                Payment::create([
                    'user_id' => auth()->id(),
                    'select_id' => $item->id,
                    'amount' => $amount,
                    'transaction_type' => $request->transaction_type,
                    'transaction_id' => 'TXN' . time() . rand(1000, 9999),
                    'payment_date' => now(),
                ]);

                $item->update(['status' => 'completed']);
            }
        });

        return redirect()->route('customer.payment.history')->with('success', 'Payment completed successfully!');
    }

    public function history()
    {
        $payments = Payment::with('select.offeredService.service', 'select.offeredService.shop')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('customer.payment.history', compact('payments'));
    }
}
