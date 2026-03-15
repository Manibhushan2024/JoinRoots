<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('user', 'service')->latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        return redirect()->route('admin.appointments.edit', $appointment);
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit', compact('appointment'));
    }

    public function update(\Illuminate\Http\Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'doctor_id' => 'nullable|exists:doctors,id',
            'status' => 'required|string|in:pending,confirmed,completed,cancelled,no_show',
            'admin_notes' => 'nullable|string'
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')
                         ->with('success', 'Appointment updated successfully!');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted.');
    }
}
