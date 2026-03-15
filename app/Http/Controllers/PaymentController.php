<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id'
        ]);

        $appointment = Appointment::with('service', 'doctor', 'user')->findOrFail($request->appointment_id);

        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        if ($appointment->status === 'confirmed') {
            return redirect()->route('profile.show')->with('info', 'Appointment is already confirmed.');
        }

        $amount = $appointment->service->online_price ?? $appointment->service->price ?? 1200;

        $razorpayKey = env('RAZORPAY_KEY');
        $razorpaySecret = env('RAZORPAY_SECRET');

        if (empty($razorpayKey) || empty($razorpaySecret) || $razorpaySecret === 'rzp_test_secret_replace_with_real') {
            Log::error('Razorpay keys missing or default secret used in .env');
            return redirect()->route('profile.show')->with('error', 'Payment gateway is not fully configured (Missing API Secret). Please update your .env file.');
        }

        try {
            $api = new Api($razorpayKey, $razorpaySecret);
            $orderData = [
                'receipt'         => 'rcptid_' . $appointment->id,
                'amount'          => $amount * 100, // Amount in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);

            // Upsert pending payment record
            Payment::updateOrCreate(
                ['appointment_id' => $appointment->id, 'status' => 'pending'],
                [
                    'user_id'           => auth()->id(),
                    'razorpay_order_id' => $razorpayOrder['id'],
                    'amount'            => $amount,
                    'currency'          => 'INR',
                    'status'            => 'pending',
                ]
            );

            $razorpayKey = env('RAZORPAY_KEY');
            return view('payment.create', compact('appointment', 'amount', 'razorpayOrder', 'razorpayKey'));

        } catch (\Exception $e) {
            Log::error('Razorpay Order Creation Failed: ' . $e->getMessage());
            return redirect()->route('profile.show')->with('error', 'Payment initialization failed. Please try again.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
            'appointment_id'      => 'required|exists:appointments,id'
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Signature verified — update payment
            $payment = Payment::where('razorpay_order_id', $request->razorpay_order_id)->firstOrFail();

            $invoiceNumber = 'CR-' . date('Y') . '-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT);

            $payment->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
                'status'              => 'successful',
                'invoice_number'      => $invoiceNumber,
            ]);

            $appointment = Appointment::with('service', 'doctor', 'user')->findOrFail($request->appointment_id);
            
            $updateData = ['status' => 'confirmed'];
            if ($appointment->mode === 'online' && empty($appointment->meet_link)) {
                $updateData['meet_link'] = 'https://meet.jit.si/ConnectRoots-Session-' . $appointment->id . '-' . bin2hex(random_bytes(4));
            }
            
            $appointment->update($updateData);

            // Send confirmation emails via Resend
            $this->sendPaymentConfirmationEmails($appointment, $payment, $invoiceNumber);

            return redirect()->route('profile.show')->with('success', '🎉 Payment successful! Appointment confirmed. Invoice ' . $invoiceNumber . ' sent to your email.');

        } catch (\Exception $e) {
            Log::error('Razorpay Verification Failed: ' . $e->getMessage());

            $payment = Payment::where('razorpay_order_id', $request->razorpay_order_id)->first();
            if ($payment) {
                $payment->update(['status' => 'failed']);
            }

            return redirect()->route('profile.show')->with('error', 'Payment verification failed. If money was deducted, it will be refunded within 5-7 business days.');
        }
    }

    private function sendPaymentConfirmationEmails(Appointment $appointment, Payment $payment, string $invoiceNumber): void
    {
        $user    = $appointment->user;
        $service = $appointment->service;
        $doctor  = $appointment->doctor;
        $start   = Carbon::parse($appointment->start_datetime);

        $meetSection = $appointment->mode === 'online' && $appointment->meet_link
            ? "<p style='background:#e8f5e9;border-left:4px solid #2d6a4f;padding:12px 16px;border-radius:6px;margin:16px 0;'>
                <strong>🎥 Video Call Link:</strong><br>
                <a href='{$appointment->meet_link}' style='color:#2d6a4f;'>{$appointment->meet_link}</a>
               </p>"
            : "<p style='background:#fff3e0;border-left:4px solid #f4a261;padding:12px 16px;border-radius:6px;margin:16px 0;'>
                <strong>📍 In-Clinic Visit:</strong><br>KG-2/46 G.F, near U.K Nursing Home, Vikaspuri, New Delhi - 110018
               </p>";

        // Email to patient
        $patientHtml = "
        <div style='font-family:Arial,sans-serif;max-width:600px;margin:0 auto;background:#f4f6f0;padding:20px;'>
          <div style='background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05);'>
            <div style='background:linear-gradient(135deg,#1b4332,#2d6a4f);padding:40px 24px;text-align:center;'>
                <div style='background:white;width:60px;height:60px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;'>
                    <span style='font-size:30px;'>🌱</span>
                </div>
                <h1 style='color:white;margin:0;font-size:24px;letter-spacing:-0.5px;'>Appointment Confirmed</h1>
                <p style='color:rgba(255,255,255,0.8);margin:8px 0 0;font-size:14px;'>Invoice #{$invoiceNumber}</p>
            </div>
            
            <div style='padding:32px 24px;'>
                <p style='margin:0 0 16px;color:#374151;'>Dear <strong>{$user->name}</strong>,</p>
                <p style='margin:0 0 24px;color:#374151;line-height:1.6;'>Thank you for choosing Connect Roots. Your payment has been successfully processed, and your slot is officially reserved.</p>

                <div style='background:#f9fafb;border-radius:12px;padding:24px;margin-bottom:24px;'>
                    <h3 style='margin:0 0 16px;font-size:14px;text-transform:uppercase;letter-spacing:1px;color:#6b7280;'>Session Summary</h3>
                    <table style='width:100%;border-collapse:collapse;'>
                        <tr>
                            <td style='padding:8px 0;color:#6b7280;font-size:14px;'>Service</td>
                            <td style='padding:8px 0;text-align:right;font-weight:600;color:#111827;'>{$service->title}</td>
                        </tr>
                        <tr>
                            <td style='padding:8px 0;color:#6b7280;font-size:14px;'>Specialist</td>
                            <td style='padding:8px 0;text-align:right;font-weight:600;color:#111827;'>" . ($doctor ? $doctor->name : 'Specialist Assigned') . "</td>
                        </tr>
                        <tr>
                            <td style='padding:8px 0;color:#6b7280;font-size:14px;'>Date & Time</td>
                            <td style='padding:8px 0;text-align:right;font-weight:600;color:#111827;'>" . $start->format('d M Y, h:i A') . "</td>
                        </tr>
                        <tr>
                            <td style='padding:8px 0;color:#6b7280;font-size:14px;'>Mode</td>
                            <td style='padding:8px 0;text-align:right;font-weight:600;color:#2d6a4f;'>" . ucfirst($appointment->mode) . "</td>
                        </tr>
                        <tr style='border-top:1px solid #e5e7eb;'>
                            <td style='padding:16px 0 0;font-weight:700;color:#111827;'>Total Paid</td>
                            <td style='padding:16px 0 0;text-align:right;font-weight:800;color:#2d6a4f;font-size:18px;'>₹" . number_format($payment->amount, 2) . "</td>
                        </tr>
                    </table>
                </div>

                <div style='background:#fffbeb;border-radius:12px;padding:20px;margin-bottom:24px;'>
                    <h4 style='margin:0 0 8px;font-size:13px;color:#92400e;text-transform:uppercase;'>Transaction Details</h4>
                    <p style='margin:0;font-size:12px;color:#b45309;font-family:monospace;'>
                        Payment ID: {$payment->razorpay_payment_id}<br>
                        Order ID: {$payment->razorpay_order_id}<br>
                        Reg No: UDYAM-DL-11-0152999
                    </p>
                </div>

                {$meetSection}

                <div style='border-top:1px solid #eee;padding-top:24px;text-align:center;'>
                    <p style='margin:0;font-size:13px;color:#6b7280;'>Need to reschedule? WhatsApp us at</p>
                    <a href='https://wa.me/919334892585' style='display:inline-block;margin-top:8px;background:#25D366;color:white;text-decoration:none;padding:10px 20px;border-radius:50px;font-weight:600;font-size:14px;'>
                        <img src='https://cdn-icons-png.flaticon.com/512/733/733585.png' width='16' style='vertical-align:middle;margin-right:8px;'> Chat on WhatsApp
                    </a>
                </div>
            </div>

            <div style='background:#f9fafb;padding:24px;text-align:center;border-top:1px solid #eee;'>
                <p style='margin:0;font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;'>JoinRoots Therapy Centre</p>
                <p style='margin:4px 0 0;font-size:11px;color:#9ca3af;'>KG-2/46 G.F, near U.K Nursing Home, Vikaspuri, New Delhi - 110018</p>
            </div>
          </div>
        </div>";

        Http::withHeaders(['Authorization' => 'Bearer ' . env('RESEND_API_KEY'), 'Content-Type' => 'application/json'])
            ->post('https://api.resend.com/emails', [
                'from'    => 'Connect Roots <onboarding@resend.dev>',
                'to'      => [$user->email],
                'subject' => "✅ Appointment Confirmed — Invoice #{$invoiceNumber} | Connect Roots",
                'html'    => $patientHtml,
            ]);

        // Admin notification
        $adminHtml = "
        <div style='font-family:Arial,sans-serif;max-width:600px;'>
          <div style='background:#1b1f2a;padding:20px 24px;border-radius:12px 12px 0 0;'>
            <h2 style='color:white;margin:0;'>💰 New Payment Received</h2>
            <p style='color:#9ca3af;margin:4px 0 0;'>Invoice {$invoiceNumber}</p>
          </div>
          <div style='background:white;padding:24px;border:1px solid #e5e7eb;border-top:none;border-radius:0 0 12px 12px;'>
            <table style='width:100%;border-collapse:collapse;font-size:14px;'>
              <tr style='border-bottom:1px solid #f3f4f6;'><td style='padding:10px 0;color:#6b7280;'>Patient</td><td style='padding:10px 0;font-weight:600;'>{$user->name} ({$user->email})</td></tr>
              <tr style='border-bottom:1px solid #f3f4f6;'><td style='padding:10px 0;color:#6b7280;'>Phone</td><td style='padding:10px 0;font-weight:600;'>" . ($user->phone ?? 'N/A') . "</td></tr>
              <tr style='border-bottom:1px solid #f3f4f6;'><td style='padding:10px 0;color:#6b7280;'>Service</td><td style='padding:10px 0;font-weight:600;'>{$service->title}</td></tr>
              <tr style='border-bottom:1px solid #f3f4f6;'><td style='padding:10px 0;color:#6b7280;'>Doctor</td><td style='padding:10px 0;font-weight:600;'>" . ($doctor ? $doctor->name : 'N/A') . "</td></tr>
              <tr style='border-bottom:1px solid #f3f4f6;'><td style='padding:10px 0;color:#6b7280;'>Date & Time</td><td style='padding:10px 0;font-weight:600;'>" . $start->format('d M Y, h:i A') . "</td></tr>
              <tr style='border-bottom:1px solid #f3f4f6;'><td style='padding:10px 0;color:#6b7280;'>Mode</td><td style='padding:10px 0;font-weight:600;'>" . ucfirst($appointment->mode) . "</td></tr>
              <tr><td style='padding:10px 0;color:#6b7280;'>Amount</td><td style='padding:10px 0;font-weight:700;color:#2d6a4f;font-size:16px;'>₹" . number_format($payment->amount, 0) . "</td></tr>
            </table>
          </div>
        </div>";

        Http::withHeaders(['Authorization' => 'Bearer ' . env('RESEND_API_KEY'), 'Content-Type' => 'application/json'])
            ->post('https://api.resend.com/emails', [
                'from'    => 'Connect Roots <onboarding@resend.dev>',
                'to'      => [env('ADMIN_EMAIL', 'connnectingroots.support@gmail.com')],
                'subject' => "💰 New Booking — {$user->name} | ₹" . number_format($payment->amount, 0) . " | {$invoiceNumber}",
                'html'    => $adminHtml,
            ]);
    }
}
