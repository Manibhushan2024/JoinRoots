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
        $data = $this->validatedData($request);

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service added.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validatedData($request);

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url',
            'price_range' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'online_price' => 'required|numeric|min:0',
            'online_discount' => 'nullable|numeric|min:0|lte:online_price',
            'offline_price' => 'required|numeric|min:0',
            'offline_discount' => 'nullable|numeric|min:0|lte:offline_price',
            'duration_minutes' => 'required|integer|min:15',
        ]);

        $data['online_discount'] = $data['online_discount'] ?? 0;
        $data['offline_discount'] = $data['offline_discount'] ?? 0;
        $data['price_range'] = $this->buildPriceRange($data);

        return $data;
    }

    private function buildPriceRange(array $data): string
    {
        $online = max(0, (float) $data['online_price'] - (float) $data['online_discount']);
        $offline = max(0, (float) $data['offline_price'] - (float) $data['offline_discount']);

        return 'Rs. ' . number_format($online, 0) . ' - Rs. ' . number_format($offline, 0);
    }
}
