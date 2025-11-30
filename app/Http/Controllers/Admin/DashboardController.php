<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Shop;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = User::where('user_type', 'customer')->count();
        $totalShopOwners = User::where('user_type', 'shop_owner')->count();
        $totalShops = Shop::count();
        $totalRevenue = Payment::sum('amount');

        return view('admin.dashboard', compact('totalCustomers', 'totalShopOwners', 'totalShops', 'totalRevenue'));
    }
}
