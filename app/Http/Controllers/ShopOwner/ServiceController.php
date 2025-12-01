<?php

namespace App\Http\Controllers\ShopOwner;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\OfferedService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $shop = auth()->user()->shop;

        if (!$shop) {
            return redirect()->route('shop-owner.shop.create')->with('error', 'Please create your shop first.');
        }

        $offeredServices = $shop->offeredServices()->with('service')->get();
        $services = Service::all();

        return view('shop-owner.services.index', compact('offeredServices', 'services'));
    }

    public function store(Request $request)
    {
        $shop = auth()->user()->shop;

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $existing = OfferedService::where('shop_id', $shop->id)
            ->where('service_id', $request->service_id)
            ->first();

        if ($existing) {
            return back()->with('error', 'This service is already offered by your shop.');
        }

        OfferedService::create([
            'shop_id' => $shop->id,
            'service_id' => $request->service_id,
            'cost' => $request->cost,
            'notes' => $request->notes,
        ]);

        return redirect()->route('shop-owner.services.index')->with('success', 'Service added successfully!');
    }

    public function edit($id)
    {
        $shop = auth()->user()->shop;
        $offeredService = OfferedService::where('shop_id', $shop->id)->findOrFail($id);

        return view('shop-owner.services.edit', compact('offeredService'));
    }

    public function update(Request $request, $id)
    {
        $shop = auth()->user()->shop;

        $request->validate([
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $offeredService = OfferedService::where('shop_id', $shop->id)->findOrFail($id);
        $offeredService->update($request->only('cost', 'notes'));

        return redirect()->route('shop-owner.services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $shop = auth()->user()->shop;

        $offeredService = OfferedService::where('shop_id', $shop->id)->findOrFail($id);
        $offeredService->delete();

        return redirect()->route('shop-owner.services.index')->with('success', 'Service removed successfully!');
    }
}
