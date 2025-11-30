<?php

namespace App\Http\Controllers\ShopOwner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $shop = auth()->user()->shop;

        if (!$shop) {
            return redirect()->route('shop-owner.shop.create')->with('info', 'Please create your shop first.');
        }

        $totalServices = $shop->offeredServices()->count();
        $totalReviews = $shop->reviews()->count();
        $averageRating = $shop->average_rating;

        return view('shop-owner.dashboard', compact('shop', 'totalServices', 'totalReviews', 'averageRating'));
    }
}
