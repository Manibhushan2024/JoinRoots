<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller {
    public function index() {
        $doctors = Doctor::orderBy('display_order')->get();
        return view('admin.doctors.index', compact('doctors'));
    }
    public function create() {
        return view('admin.doctors.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'designation'=>'required|string|max:255',
            'qualification'=>'nullable|string|max:255',
            'bio'=>'nullable|string',
            'specializations'=>'nullable|string|max:255',
            'experience_years'=>'required|integer|min:0',
            'display_order'=>'required|integer|min:0',
            'email'=>'nullable|email',
            'phone'=>'nullable|string',
            'photo'=>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        
        $doctor = new Doctor($data);
        $doctor->is_active = $request->has('is_active');
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/doctors');
            $doctor->photo_url = Storage::url($path);
        }
        
        $doctor->save();
        return redirect()->route('admin.doctors.index')->with('success','Doctor added successfully!');
    }
    public function edit(Doctor $doctor) {
        return view('admin.doctors.edit', compact('doctor'));
    }
    public function update(Request $request, Doctor $doctor) {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'designation'=>'required|string|max:255',
            'qualification'=>'nullable|string',
            'bio'=>'nullable|string',
            'specializations'=>'nullable|string',
            'experience_years'=>'required|integer',
            'display_order'=>'required|integer|min:0',
            'email'=>'nullable|email',
            'phone'=>'nullable|string',
            'photo'=>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
        
        $doctor->fill($data);
        $doctor->is_active = $request->has('is_active');
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/doctors');
            $doctor->photo_url = Storage::url($path);
        }
        
        $doctor->save();
        return redirect()->route('admin.doctors.index')->with('success','Doctor updated successfully!');
    }
    public function destroy(Doctor $doctor) {
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success','Doctor deleted.');
    }
}
