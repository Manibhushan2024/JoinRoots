<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

    /** Show the doctor's schedule for a chosen date (defaults to today) */
    public function schedule(Doctor $doctor, Request $request)
    {
        $selectedDate = $request->query('date', Carbon::today()->toDateString());

        $appointments = $doctor->appointmentsForDate($selectedDate);

        // Next upcoming appointment (regardless of selected date)
        $nextAppointment = $doctor->nextAppointment();

        return view('admin.doctors.schedule', compact('doctor', 'selectedDate', 'appointments', 'nextAppointment'));
    }

    /** Update a doctor's working schedule */
    public function updateSchedule(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'available_days'   => 'nullable|array',
            'available_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'work_start_time'  => 'required|date_format:H:i',
            'work_end_time'    => 'required|date_format:H:i|after:work_start_time',
            'slot_duration'    => 'required|integer|in:30,45,60,90,120',
        ]);

        $doctor->update([
            'available_days'  => $data['available_days'] ?? [],
            'work_start_time' => $data['work_start_time'],
            'work_end_time'   => $data['work_end_time'],
            'slot_duration'   => $data['slot_duration'],
        ]);

        return redirect()
            ->route('admin.doctors.schedule', $doctor)
            ->with('schedule_success', 'Schedule updated successfully for ' . $doctor->name . '.');
    }
}
