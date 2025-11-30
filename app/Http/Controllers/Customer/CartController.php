<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Select;
use App\Models\OfferedService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Select::with('offeredService.service', 'offeredService.shop')
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        $total = $cartItems->sum(function($item) {
            return $item->offeredService->cost * $item->quantity;
        });

        return view('customer.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'offered_service_id' => 'required|exists:offered_services,id',
            'quantity' => 'integer|min:1',
        ]);

        $existingSelect = Select::where('user_id', auth()->id())
            ->where('offered_service_id', $request->offered_service_id)
            ->where('status', 'pending')
            ->first();

        if ($existingSelect) {
            $existingSelect->increment('quantity', $request->quantity ?? 1);
        } else {
            Select::create([
                'user_id' => auth()->id(),
                'offered_service_id' => $request->offered_service_id,
                'quantity' => $request->quantity ?? 1,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Service added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $select = Select::where('user_id', auth()->id())->findOrFail($id);
        $select->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        Select::where('user_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Service removed from cart!');
    }
}
