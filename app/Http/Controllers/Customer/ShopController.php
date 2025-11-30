<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Service;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Shop::with('owner');

        if ($request->filled('search')) {
            $query->where('shop_name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('service')) {
            $query->whereHas('services', function($q) use ($request) {
                $q->where('services.id', $request->service);
            });
        }

        $shops = $query->paginate(12);
        $services = Service::all();

        return view('customer.shops.index', compact('shops', 'services'));
    }

    public function show($id)
    {
        $shop = Shop::with(['offeredServices.service', 'reviews.user', 'owner'])->findOrFail($id);
        return view('customer.shops.show', compact('shop'));
    }
}
