<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
    }
}
