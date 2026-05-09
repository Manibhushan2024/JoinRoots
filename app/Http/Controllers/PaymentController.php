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
        $this->middleware('auth')->except('webhook');
    }

    /* ──────────────────────────────────────────────────────
     |  CREATE — Show checkout page
     |  Called after appointment booking (online mode)
     ────────────────────────────────────────────────────── */
    public function create(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id'
        ]);

        $appointment = Appointment::with('service', 'doctor', 'user')
            ->findOrFail($request->appointment_id);

        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        if ($appointment->status === 'confirmed') {
            return redirect()->route('profile.show')
                ->with('info', 'This appointment is already confirmed.');
        }

        $mode           = $appointment->mode === 'offline' ? 'offline' : 'online';
        $originalAmount = $appointment->service
            ? $appointment->service->originalPriceFor($mode) : 1200;
        $discountAmount = $appointment->service
            ? $appointment->service->discountAmountFor($mode) : 0;
        $amount         = $appointment->service
            ? $appointment->service->discountedPriceFor($mode) : 1200;

        $razorpayKey    = env('RAZORPAY_KEY');
        $razorpaySecret = env('RAZORPAY_SECRET');

        if (empty($razorpayKey) || empty($razorpaySecret)) {
            return redirect()->route('profile.show')
                ->with('error', 'Payment gateway not configured. Please contact support.');
        }

        try {
            $api = new Api($razorpayKey, $razorpaySecret);

            // ── 1. Create Razorpay Order (for Standard Checkout) ──
            $razorpayOrder = $api->order->create([
                'receipt'         => 'rcpt_apt_' . $appointment->id,
                'amount'          => (int) round($amount * 100), // paise
                'currency'        => 'INR',
                'payment_capture' => 1,
                'notes'           => [
                    'appointment_id' => $appointment->id,
                    'service'        => $appointment->service->title ?? '',
                    'patient'        => auth()->user()->name,
                ],
            ]);

            // ── 2. Create Razorpay Payment Link (per-appointment) ──
            $paymentLink = null;
            try {
                $paymentLink = $api->paymentLink->create([
                    'amount'       => (int) round($amount * 100),
                    'currency'     => 'INR',
                    'accept_partial' => false,
                    'reference_id'   => 'apt_' . $appointment->id,
                    'description'    => ($appointment->service->title ?? 'Therapy Session')
                                        . ' — ' . ucfirst($appointment->mode),
                    'customer'       => [
                        'name'    => auth()->user()->name,
                        'email'   => auth()->user()->email,
                        'contact' => auth()->user()->phone ?? '',
                    ],
                    'notify'         => ['sms' => true, 'email' => true],
                    'reminder_enable' => true,
                    'callback_url'    => route('payment.callback'),
                    'callback_method' => 'get',
                    'notes'           => [
                        'appointment_id' => (string) $appointment->id,
                    ],
                ]);
            } catch (\Exception $e) {
                // Payment link creation failure is non-fatal — standard checkout still works
                Log::warning('Razorpay payment link creation failed: ' . $e->getMessage());
            }

            // ── 3. Upsert pending Payment record ──
            Payment::updateOrCreate(
                ['appointment_id' => $appointment->id, 'status' => 'pending'],
                [
                    'user_id'             => auth()->id(),
                    'razorpay_order_id'   => $razorpayOrder['id'],
                    'amount'              => $amount,
                    'currency'            => 'INR',
                    'status'              => 'pending',
                    'razorpay_payment_id' => $paymentLink['id'] ?? null, // store link ID temporarily
                ]
            );

            return view('payment.create', compact(
                'appointment', 'amount', 'originalAmount', 'discountAmount',
                'razorpayOrder', 'razorpayKey', 'paymentLink'
            ));

        } catch (\Exception $e) {
            Log::error('Razorpay checkout init failed: ' . $e->getMessage());
            return redirect()->route('profile.show')
                ->with('error', 'Payment initialisation failed. Please try again or WhatsApp us.');
        }
    }

    /* ──────────────────────────────────────────────────────
     |  STORE — Verify Standard Checkout payment
     |  Called by Razorpay JS handler after payment success
     ────────────────────────────────────────────────────── */
    public function store(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
            'appointment_id'      => 'required|exists:appointments,id',
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            // Verify HMAC signature
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            $payment = Payment::where('razorpay_order_id', $request->razorpay_order_id)
                ->firstOrFail();

            $invoiceNumber = 'CR-' . date('Y') . '-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT);

            $payment->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
                'status'              => 'successful',
                'invoice_number'      => $invoiceNumber,
            ]);

            $appointment = Appointment::with('service', 'doctor', 'user')
                ->findOrFail($request->appointment_id);

            $this->confirmAppointment($appointment);
            $this->sendPaymentConfirmationEmails($appointment, $payment, $invoiceNumber);

            return redirect()->route('profile.show')
                ->with('success', 'Payment successful! Appointment confirmed. Invoice '
                    . $invoiceNumber . ' sent to your email.');

        } catch (\Exception $e) {
            Log::error('Razorpay signature verification failed: ' . $e->getMessage());

            Payment::where('razorpay_order_id', $request->razorpay_order_id)
                ->update(['status' => 'failed']);

            return redirect()->route('profile.show')
                ->with('error', 'Payment verification failed. If money was deducted, '
                    . 'it will be refunded within 5–7 business days.');
        }
    }

    /* ──────────────────────────────────────────────────────
     |  CALLBACK — Razorpay Payment Link redirect
     |  Razorpay redirects here after payment link payment
     ────────────────────────────────────────────────────── */
    public function callback(Request $request)
    {
        // razorpay_payment_id, razorpay_payment_link_id,
        // razorpay_payment_link_reference_id, razorpay_payment_link_status,
        // razorpay_signature are in the query string

        $status = $request->query('razorpay_payment_link_status');

        if ($status !== 'paid') {
            return redirect()->route('profile.show')
                ->with('error', 'Payment was not completed. Please try again.');
        }

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

            // Verify payment link signature
            $api->utility->verifyPaymentLinkSignature([
                'payment_link_id'              => $request->query('razorpay_payment_link_id'),
                'payment_link_reference_id'    => $request->query('razorpay_payment_link_reference_id'),
                'payment_link_status'          => $request->query('razorpay_payment_link_status'),
                'razorpay_payment_id'          => $request->query('razorpay_payment_id'),
                'razorpay_signature'           => $request->query('razorpay_signature'),
            ]);

            // Extract appointment ID from reference_id  (format: "apt_123")
            $referenceId   = $request->query('razorpay_payment_link_reference_id');
            $appointmentId = (int) str_replace('apt_', '', $referenceId);

            $appointment = Appointment::with('service', 'doctor', 'user')
                ->find($appointmentId);

            if (!$appointment) {
                return redirect()->route('profile.show')
                    ->with('error', 'Appointment not found. Please contact support.');
            }

            // Find or create payment record
            $payment = Payment::where('appointment_id', $appointmentId)->first();

            if (!$payment) {
                $payment = Payment::create([
                    'appointment_id'      => $appointmentId,
                    'user_id'             => $appointment->user_id,
                    'razorpay_payment_id' => $request->query('razorpay_payment_id'),
                    'amount'              => $appointment->service
                        ? $appointment->service->discountedPriceFor($appointment->mode)
                        : 0,
                    'currency'            => 'INR',
                    'status'              => 'pending',
                ]);
            }

            if ($payment->status !== 'successful') {
                $invoiceNumber = 'CR-' . date('Y') . '-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT);

                $payment->update([
                    'razorpay_payment_id' => $request->query('razorpay_payment_id'),
                    'status'              => 'successful',
                    'invoice_number'      => $invoiceNumber,
                ]);

                $this->confirmAppointment($appointment);
                $this->sendPaymentConfirmationEmails($appointment, $payment, $invoiceNumber);
            }

            return redirect()->route('profile.show')
                ->with('success', 'Payment successful! Your appointment is confirmed. '
                    . 'Invoice sent to your email.');

        } catch (\Exception $e) {
            Log::error('Payment link callback verification failed: ' . $e->getMessage());
            return redirect()->route('profile.show')
                ->with('error', 'Payment received but verification failed. '
                    . 'Please WhatsApp us at +91 93348 92585 — we will confirm manually.');
        }
    }

    /* ──────────────────────────────────────────────────────
     |  WEBHOOK — Server-side safety net
     |  Razorpay calls this even if browser is closed
     |  Route: POST /razorpay/webhook  (no CSRF, no auth)
     ────────────────────────────────────────────────────── */
    public function webhook(Request $request)
    {
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');
        $signature     = $request->header('X-Razorpay-Signature');
        $payload       = $request->getContent();

        // ── Verify webhook signature ──
        if ($webhookSecret) {
            $expected = hash_hmac('sha256', $payload, $webhookSecret);
            if (!hash_equals($expected, (string) $signature)) {
                Log::warning('Razorpay webhook: invalid signature');
                return response()->json(['error' => 'Invalid signature'], 400);
            }
        }

        $data  = json_decode($payload, true);
        $event = $data['event'] ?? null;

        Log::info('Razorpay webhook received: ' . $event);

        // ── Handle payment.captured (Standard Checkout) ──
        if ($event === 'payment.captured') {
            $entity  = $data['payload']['payment']['entity'] ?? [];
            $orderId = $entity['order_id'] ?? null;
            $paymentId = $entity['id'] ?? null;

            if ($orderId) {
                $payment = Payment::where('razorpay_order_id', $orderId)->first();

                if ($payment && $payment->status !== 'successful') {
                    $invoiceNumber = 'CR-' . date('Y') . '-'
                        . str_pad($payment->id, 5, '0', STR_PAD_LEFT);

                    $payment->update([
                        'razorpay_payment_id' => $paymentId,
                        'status'              => 'successful',
                        'invoice_number'      => $invoiceNumber,
                    ]);

                    $appointment = Appointment::with('service', 'doctor', 'user')
                        ->find($payment->appointment_id);

                    if ($appointment) {
                        $this->confirmAppointment($appointment);
                        $this->sendPaymentConfirmationEmails($appointment, $payment, $invoiceNumber);
                        Log::info('Webhook: appointment #' . $appointment->id . ' confirmed via payment.captured');
                    }
                }
            }
        }

        // ── Handle payment_link.paid (Payment Link) ──
        if ($event === 'payment_link.paid') {
            $linkEntity    = $data['payload']['payment_link']['entity'] ?? [];
            $paymentEntity = $data['payload']['payment']['entity'] ?? [];

            $referenceId   = $linkEntity['reference_id'] ?? null;  // "apt_123"
            $paymentId     = $paymentEntity['id'] ?? null;

            if ($referenceId && str_starts_with($referenceId, 'apt_')) {
                $appointmentId = (int) str_replace('apt_', '', $referenceId);
                $appointment   = Appointment::with('service', 'doctor', 'user')
                    ->find($appointmentId);

                if ($appointment && $appointment->status !== 'confirmed') {
                    $payment = Payment::firstOrCreate(
                        ['appointment_id' => $appointmentId],
                        [
                            'user_id'   => $appointment->user_id,
                            'amount'    => ($paymentEntity['amount'] ?? 0) / 100,
                            'currency'  => 'INR',
                            'status'    => 'pending',
                        ]
                    );

                    if ($payment->status !== 'successful') {
                        $invoiceNumber = 'CR-' . date('Y') . '-'
                            . str_pad($payment->id, 5, '0', STR_PAD_LEFT);

                        $payment->update([
                            'razorpay_payment_id' => $paymentId,
                            'status'              => 'successful',
                            'invoice_number'      => $invoiceNumber,
                        ]);

                        $this->confirmAppointment($appointment);
                        $this->sendPaymentConfirmationEmails($appointment, $payment, $invoiceNumber);
                        Log::info('Webhook: appointment #' . $appointmentId . ' confirmed via payment_link.paid');
                    }
                }
            }
        }

        return response()->json(['status' => 'ok'], 200);
    }

    /* ──────────────────────────────────────────────────────
     |  HELPERS
     ────────────────────────────────────────────────────── */
    private function confirmAppointment(Appointment $appointment): void
    {
        $updateData = ['status' => 'confirmed'];

        if ($appointment->mode === 'online' && empty($appointment->meet_link)) {
            $updateData['meet_link'] = 'https://meet.jit.si/JoinRoots-'
                . $appointment->id . '-' . bin2hex(random_bytes(4));
        }

        $appointment->update($updateData);
    }

    private function sendPaymentConfirmationEmails(
        Appointment $appointment,
        Payment     $payment,
        string      $invoiceNumber
    ): void {
        $user    = $appointment->user;
        $service = $appointment->service;
        $doctor  = $appointment->doctor;
        $start   = Carbon::parse($appointment->start_datetime);

        $meetSection = $appointment->mode === 'online' && $appointment->meet_link
            ? "<p style='background:#e8f5e9;border-left:4px solid #2d6a4f;padding:12px 16px;
                border-radius:6px;margin:16px 0;'>
                <strong>Video Call Link:</strong><br>
                <a href='{$appointment->meet_link}' style='color:#2d6a4f;'>{$appointment->meet_link}</a>
               </p>"
            : "<p style='background:#fff3e0;border-left:4px solid #f4a261;padding:12px 16px;
                border-radius:6px;margin:16px 0;'>
                <strong>In-Clinic Visit:</strong><br>
                KG-2/46 G.F, near U.K Nursing Home, Vikaspuri, New Delhi – 110018
               </p>";

        $patientHtml = "
        <div style='font-family:Arial,sans-serif;max-width:600px;margin:0 auto;background:#f4f6f0;padding:20px;'>
          <div style='background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.05);'>
            <div style='background:linear-gradient(135deg,#1b4332,#2d6a4f);padding:40px 24px;text-align:center;'>
              <h1 style='color:white;margin:0;font-size:24px;'>Appointment Confirmed</h1>
              <p style='color:rgba(255,255,255,.8);margin:8px 0 0;font-size:14px;'>Invoice #{$invoiceNumber}</p>
            </div>
            <div style='padding:32px 24px;'>
              <p style='color:#374151;'>Dear <strong>{$user->name}</strong>,</p>
              <p style='color:#374151;line-height:1.6;margin-bottom:24px;'>Your payment is confirmed and your slot is reserved.</p>
              <div style='background:#f9fafb;border-radius:12px;padding:24px;margin-bottom:24px;'>
                <table style='width:100%;border-collapse:collapse;'>
                  <tr><td style='padding:8px 0;color:#6b7280;font-size:14px;'>Service</td><td style='text-align:right;font-weight:600;'>{$service->title}</td></tr>
                  <tr><td style='padding:8px 0;color:#6b7280;font-size:14px;'>Specialist</td><td style='text-align:right;font-weight:600;'>" . ($doctor->name ?? 'To be assigned') . "</td></tr>
                  <tr><td style='padding:8px 0;color:#6b7280;font-size:14px;'>Date & Time</td><td style='text-align:right;font-weight:600;'>" . $start->format('d M Y, h:i A') . "</td></tr>
                  <tr><td style='padding:8px 0;color:#6b7280;font-size:14px;'>Mode</td><td style='text-align:right;font-weight:600;color:#2d6a4f;'>" . ucfirst($appointment->mode) . "</td></tr>
                  <tr style='border-top:1px solid #e5e7eb;'><td style='padding:16px 0 0;font-weight:700;'>Total Paid</td><td style='text-align:right;font-weight:800;color:#2d6a4f;font-size:18px;padding:16px 0 0;'>&#8377;" . number_format($payment->amount, 0) . "</td></tr>
                </table>
              </div>
              {$meetSection}
              <div style='text-align:center;margin-top:24px;'>
                <p style='font-size:13px;color:#6b7280;'>Need help? WhatsApp us</p>
                <a href='https://wa.me/919334892585' style='display:inline-block;margin-top:8px;background:#25D366;color:white;text-decoration:none;padding:10px 24px;border-radius:50px;font-weight:600;font-size:14px;'>WhatsApp +91 93348 92585</a>
              </div>
            </div>
            <div style='background:#f9fafb;padding:16px 24px;text-align:center;border-top:1px solid #eee;'>
              <p style='margin:0;font-size:11px;color:#9ca3af;'>JoinRoots · KG-2/46, Vikaspuri, New Delhi · UDYAM-DL-11-0152999</p>
              <p style='margin:4px 0 0;font-size:10px;color:#9ca3af;'>Payment ID: {$payment->razorpay_payment_id}</p>
            </div>
          </div>
        </div>";

        Http::withHeaders([
            'Authorization' => 'Bearer ' . env('RESEND_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.resend.com/emails', [
            'from'    => 'JoinRoots <onboarding@resend.dev>',
            'to'      => [$user->email],
            'subject' => "Appointment Confirmed — Invoice #{$invoiceNumber} | JoinRoots",
            'html'    => $patientHtml,
        ]);

        // Admin notification
        Http::withHeaders([
            'Authorization' => 'Bearer ' . env('RESEND_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.resend.com/emails', [
            'from'    => 'JoinRoots <onboarding@resend.dev>',
            'to'      => [env('ADMIN_EMAIL', 'connnectingroots.support@gmail.com')],
            'subject' => "New Booking — {$user->name} | ₹" . number_format($payment->amount, 0) . " | #{$invoiceNumber}",
            'html'    => "<h3>New Payment</h3>
                <p>Patient: {$user->name} ({$user->email})</p>
                <p>Phone: " . ($user->phone ?? 'N/A') . "</p>
                <p>Service: {$service->title}</p>
                <p>Doctor: " . ($doctor->name ?? 'N/A') . "</p>
                <p>Date: " . $start->format('d M Y, h:i A') . "</p>
                <p>Mode: " . ucfirst($appointment->mode) . "</p>
                <p>Amount: &#8377;" . number_format($payment->amount, 0) . "</p>
                <p>Invoice: #{$invoiceNumber}</p>
                <p>Payment ID: {$payment->razorpay_payment_id}</p>",
        ]);
    }
}
