<?php

namespace App\Http\Controllers\ShopOwner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function create()
    {
        if (auth()->user()->shop) {
            return redirect()->route('shop-owner.shop.edit')->with('info', 'You already have a shop. You can edit it here.');
        }

        return view('shop-owner.shop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'location' => 'required|string',
            'opening_hours' => 'required|string',
            'closing_hours' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Shop::create([
            'user_id' => auth()->id(),
            'shop_name' => $request->shop_name,
            'location' => $request->location,
            'opening_hours' => $request->opening_hours,
            'closing_hours' => $request->closing_hours,
            'description' => $request->description,
        ]);

        return redirect()->route('shop-owner.dashboard')->with('success', 'Shop created successfully!');
    }

    public function edit()
    {
        $shop = auth()->user()->shop;

        if (!$shop) {
            return redirect()->route('shop-owner.shop.create');
        }

        return view('shop-owner.shop.edit', compact('shop'));
    }

    public function update(Request $request)
    {
        $shop = auth()->user()->shop;

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'location' => 'required|string',
            'opening_hours' => 'required|string',
            'closing_hours' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $shop->update($request->only('shop_name', 'location', 'opening_hours', 'closing_hours', 'description'));

        return redirect()->route('shop-owner.dashboard')->with('success', 'Shop updated successfully!');
    }
}
