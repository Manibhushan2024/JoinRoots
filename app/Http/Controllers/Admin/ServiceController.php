<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'price_range' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'online_price' => 'required|numeric|min:0',
            'offline_price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:15',
        ]);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service added.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'price_range' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'online_price' => 'required|numeric|min:0',
            'offline_price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:15',
        ]);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}
