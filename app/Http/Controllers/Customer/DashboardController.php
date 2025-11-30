<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $shops = Shop::with('owner')->latest()->paginate(12);
        return view('customer.dashboard', compact('shops'));
    }
}
