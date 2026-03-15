@extends('layouts.admin')

@section('title', 'Invoice #' . ($payment->invoice_number ?? $payment->id))

@section('admin_content')
<div style="padding:2rem;max-width:760px;margin:0 auto;">

    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;">
        <a href="{{ route('admin.payments.index') }}" style="color:#6b7280;text-decoration:none;display:flex;align-items:center;gap:.4rem;font-size:.85rem;">
            <i class="fas fa-arrow-left"></i> Back to Payments
        </a>
    </div>

    <!-- Invoice Card -->
    <div id="invoice-print" style="background:white;border-radius:24px;box-shadow:0 8px 40px rgba(0,0,0,0.08);overflow:hidden;">

        <!-- Invoice Header -->
        <div style="background:linear-gradient(135deg,#1b1f2a,#2d3748);padding:2.5rem;display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1rem;">
                    <div style="width:40px;height:40px;background:#2d6a4f;border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div style="color:white;font-weight:700;font-size:1.2rem;">Connect <span style="color:#52b788;">Roots</span></div>
                </div>
                <div style="color:#9ca3af;font-size:.8rem;line-height:1.6;">
                    KG-2/46 G.F, near U.K Nursing Home<br>
                    Vikaspuri, New Delhi - 110018<br>
                    UDYAM-DL-11-0152999
                </div>
            </div>
            <div style="text-align:right;">
                <div style="color:white;font-size:1.5rem;font-weight:800;margin-bottom:.25rem;">INVOICE</div>
                <div style="color:#52b788;font-family:monospace;font-size:1rem;font-weight:700;">{{ $payment->invoice_number ?? ('CR-' . $payment->id) }}</div>
                <div style="color:#6b7280;font-size:.8rem;margin-top:.5rem;">
                    {{ $payment->created_at->format('d M Y') }}
                </div>
                <div style="margin-top:.75rem;">
                    @php
                        $colors = [
                            'successful' => ['bg'=>'rgba(34,197,94,.15)','color'=>'#22c55e'],
                            'pending'    => ['bg'=>'rgba(245,158,11,.15)','color'=>'#f59e0b'],
                            'failed'     => ['bg'=>'rgba(239,68,68,.15)', 'color'=>'#ef4444'],
                        ];
                        $c = $colors[$payment->status] ?? ['bg'=>'rgba(255,255,255,.1)','color'=>'#9ca3af'];
                    @endphp
                    <span style="background:{{ $c['bg'] }};color:{{ $c['color'] }};padding:.35rem 1rem;border-radius:50px;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em;">
                        {{ $payment->status }}
                    </span>
                </div>
            </div>
        </div>

        <div style="padding:2.5rem;">

            <!-- Patient & Payment Info -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem;">
                <div>
                    <div style="font-size:.75rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.75rem;">Billed To</div>
                    <div style="font-weight:700;color:#1b1f2a;font-size:1rem;">{{ $payment->user->name ?? 'N/A' }}</div>
                    <div style="color:#6b7280;font-size:.85rem;margin-top:.25rem;">{{ $payment->user->email ?? '' }}</div>
                    <div style="color:#6b7280;font-size:.85rem;">{{ $payment->user->phone ?? '' }}</div>
                </div>
                <div>
                    <div style="font-size:.75rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.75rem;">Payment Info</div>
                    <div style="font-size:.85rem;line-height:1.8;color:#374151;">
                        <div>Razorpay Order: <span style="font-family:monospace;font-size:.75rem;">{{ $payment->razorpay_order_id ?? '—' }}</span></div>
                        <div>Payment ID: <span style="font-family:monospace;font-size:.75rem;">{{ $payment->razorpay_payment_id ?? '—' }}</span></div>
                        <div>Currency: <strong>{{ $payment->currency }}</strong></div>
                    </div>
                </div>
            </div>

            <!-- Appointment Details -->
            @if($payment->appointment)
            <div style="background:#f9faf8;border-radius:16px;padding:1.5rem;margin-bottom:2rem;">
                <div style="font-size:.75rem;font-weight:700;color:#9ca3af;text-transform:uppercase;letter-spacing:.05em;margin-bottom:1rem;">Session Details</div>
                <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:.85rem;">
                    <div>
                        <div style="font-size:.75rem;color:#9ca3af;">Service</div>
                        <div style="font-weight:600;color:#1b1f2a;">{{ $payment->appointment->service->title ?? '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#9ca3af;">Specialist</div>
                        <div style="font-weight:600;color:#1b1f2a;">{{ $payment->appointment->doctor->name ?? '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#9ca3af;">Date & Time</div>
                        <div style="font-weight:600;color:#1b1f2a;">{{ \Carbon\Carbon::parse($payment->appointment->start_datetime)->format('d M Y, h:i A') }}</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#9ca3af;">Mode</div>
                        <div style="font-weight:600;color:#1b1f2a;">{{ ucfirst($payment->appointment->mode) }}</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#9ca3af;">Status</div>
                        <div style="font-weight:600;color:#2d6a4f;">{{ ucfirst($payment->appointment->status) }}</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#9ca3af;">Duration</div>
                        <div style="font-weight:600;color:#1b1f2a;">{{ $payment->appointment->duration_minutes ?? 60 }} minutes</div>
                    </div>
                    @if($payment->appointment->mode === 'online' && $payment->appointment->meet_link)
                    <div style="grid-column: span 2; margin-top: .5rem; background: white; padding: .75rem; border-radius: 8px; border: 1px dashed #2d6a4f;">
                        <div style="font-size:.7rem;color:#2d6a4f;text-transform:uppercase;font-weight:700;">Meeting Link</div>
                        <a href="{{ $payment->appointment->meet_link }}" target="_blank" style="font-size:.8rem;color:#1b4332;word-break:break-all;">{{ $payment->appointment->meet_link }}</a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Amount Table -->
            <table style="width:100%;border-collapse:collapse;font-size:.9rem;margin-bottom:1.5rem;">
                <thead>
                    <tr style="background:#1b1f2a;color:white;">
                        <th style="padding:.85rem 1.25rem;text-align:left;border-radius:10px 0 0 10px;">Description</th>
                        <th style="padding:.85rem 1.25rem;text-align:right;border-radius:0 10px 10px 0;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:1rem 1.25rem;color:#374151;">
                            {{ $payment->appointment->service->title ?? 'Therapy Session' }} — {{ ucfirst($payment->appointment->mode ?? 'online') }}
                        </td>
                        <td style="padding:1rem 1.25rem;text-align:right;font-weight:600;">₹{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:1rem 1.25rem;font-weight:700;color:#1b1f2a;font-size:1rem;">Total</td>
                        <td style="padding:1rem 1.25rem;text-align:right;font-weight:800;color:#2d6a4f;font-size:1.2rem;">₹{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            @if($payment->notes)
            <div style="background:#fffbeb;border-radius:12px;padding:1rem;margin-bottom:1.5rem;font-size:.85rem;color:#92400e;">
                <strong>Notes:</strong> {{ $payment->notes }}
            </div>
            @endif

            <div style="border-top:1px solid #e5e7eb;padding-top:1.5rem;text-align:center;color:#9ca3af;font-size:.78rem;">
                <p>Thank you for choosing JoinRoots. For any queries contact us at connnectingroots.support@gmail.com</p>
                <p style="margin-top:.4rem;">+91 9334892585 | vikaspuri.connectroots.in | UDYAM-DL-11-0152999</p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div style="display:flex;gap:1rem;margin-top:1.5rem;justify-content:flex-end;">
        <button onclick="window.print()" style="display:flex;align-items:center;gap:.5rem;background:#1b1f2a;color:white;border:none;padding:.75rem 1.5rem;border-radius:12px;cursor:pointer;font-weight:600;font-size:.88rem;">
            <i class="fas fa-print"></i> Print / Download
        </button>
    </div>
</div>

<style>
@media print {
    body * { visibility: hidden; }
    #invoice-print, #invoice-print * { visibility: visible; }
    #invoice-print { position: absolute; left: 0; top: 0; width: 100%; }
}
</style>
@endsection
