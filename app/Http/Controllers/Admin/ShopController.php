<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
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

        $shops = $query->paginate(20);

        return view('admin.shops.index', compact('shops'));
    }

    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('admin.shops.index')->with('success', 'Shop deleted successfully!');
    }
}
