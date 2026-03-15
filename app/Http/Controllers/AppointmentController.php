<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmed;

class AppointmentController extends Controller
{
    public function createPublic()
    {
        $services = Service::all();
        $doctors = \App\Models\Doctor::all();
        return view('appointments.index', compact('services', 'doctors'));
    }

    public function storePublic(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'service_id' => 'required|exists:services,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'mode' => 'required|in:online,offline',
        ]);

        $service = Service::findOrFail($data['service_id']);
        $doctor = \App\Models\Doctor::findOrFail($data['doctor_id']);

        // Authenticate or Create User
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $user = User::where('email', $data['email'])->first();
            if (!$user) {
                // Create user with a random password if doesn't exist. They can reset it later.
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'] ?? null,
                    'password' => Hash::make(Str::random(12)),
                ]);
            }
            Auth::login($user); // Optionally auto-login if just created/found publicly
        }

        $start = Carbon::parse($data['appointment_date'] . ' ' . $data['appointment_time']);
        $end = $start->copy()->addMinutes($service->duration_minutes);

        // Check for conflicts (including 15-minute buffer)
        $conflict = $this->checkAppointmentConflict($start, $end, $doctor->id);
        
        if ($conflict) {
            return redirect()->back()->withErrors([
                'appointment_time' => 'This time slot is no longer available. Please choose a different time.'
            ])->withInput();
        }

        $appointment = Appointment::create([
            'user_id' => $user->id,
            'service_id' => $service->id,
            'doctor_id' => $doctor->id,
            'start_datetime' => $start,
            'end_datetime' => $end,
            'duration_minutes' => $service->duration_minutes,
            'mode' => $data['mode'],
            'meet_link' => $data['mode'] == 'online' ? 'https://meet.google.com/' . uniqid() : null,
            'status' => $data['mode'] == 'offline' ? 'confirmed' : 'pending',
        ]);

        // PHASE 5 PREPERATION: Razorpay integration
        // If mode is online, redirect to payment page
        if ($data['mode'] == 'online') {
             return redirect()->route('payment.create', ['appointment_id' => $appointment->id]);
        }

        // If mode is offline, it is confirmed by default and we send email
        $this->sendConfirmationEmails($user, $service, $doctor, $start, $data['mode']);

        return redirect()->route('profile.show')->with('success', 'Appointment booked successfully!');
    }

    private function sendConfirmationEmails($user, $service, $doctor, $start, $mode)
    {
        $patientHtml = "<h3>Appointment Confirmed!</h3><p>Dear {$user->name},</p>
            <p>Your <strong>{$mode}</strong> appointment for <strong>{$service->title}</strong> with <strong>Dr. {$doctor->name}</strong> is confirmed.</p>
            <p><strong>Date & Time:</strong> " . $start->format('M d, Y, h:i A') . "</p>
            <p>If you need to reschedule, please contact us via WhatsApp at +91 9334892585.</p>
            <p>Thank you for choosing Connect Roots.</p>";

        \Illuminate\Support\Facades\Http::withToken(env('RESEND_API_KEY'))->post('https://api.resend.com/emails', [
            'from' => 'onboarding@resend.dev',
            'to' => $user->email,
            'subject' => 'Appointment Confirmation - Connect Roots',
            'html' => $patientHtml
        ]);

        $adminHtml = "<h3>New Booking</h3><p>Patient: {$user->name} ({$user->phone})</p>
            <p>Service: {$service->title}</p>
            <p>Doctor: Dr. {$doctor->name}</p>
            <p>Time: " . $start->format('M d, Y, h:i A') . "</p>";

        \Illuminate\Support\Facades\Http::withToken(env('RESEND_API_KEY'))->post('https://api.resend.com/emails', [
            'from' => 'onboarding@resend.dev',
            'to' => env('ADMIN_EMAIL', 'manibhushank437@gmail.com'),
            'subject' => 'New Appointment Booked',
            'html' => $adminHtml
        ]);
    }

    public function getAvailableSlots(Request $request)
    {
        $date = $request->query('date');
        $doctorId = $request->query('doctor_id');

        if (!$date || !$doctorId) return response()->json([]);

        $slots = [];
        $startOfDay = Carbon::parse($date . ' 09:00:00');
        $endOfDay = Carbon::parse($date . ' 18:00:00'); // Last appointment starts at 17:00
        
        $currentTime = $startOfDay;
        while ($currentTime->lt($endOfDay)) {
            $slotStart = $currentTime->copy();
            $slotEnd = $slotStart->copy()->addMinutes(60); // Assuming 60 min session for slot generator
            
            // Check if this specific slot (with 15 min buffer) overlaps
            if (!$this->checkAppointmentConflict($slotStart, $slotEnd, $doctorId)) {
                $slots[] = [
                    'time_24' => $slotStart->format('H:i'),
                    'time_12' => $slotStart->format('h:i A')
                ];
            }
            $currentTime->addMinutes(30); // 30 min intervals for the grid
        }

        return response()->json($slots);
    }

    /**
     * Check for appointment conflicts with 15-minute buffer
     */
    private function checkAppointmentConflict($start, $end, $doctorId)
    {
        $bufferStart = $start->copy()->subMinutes(15);
        $bufferEnd = $end->copy()->addMinutes(15);

        return Appointment::where('doctor_id', $doctorId)
            ->where(function ($query) use ($bufferStart, $bufferEnd) {
                // If the new appointment timeframe (including buffers) overlaps with any existing booked timeframe
                $query->where('start_datetime', '<', $bufferEnd)
                      ->where('end_datetime', '>', $bufferStart);
            })->where('status', '!=', 'cancelled')->exists();
    }
}
