@extends('layouts.admin')

@section('title', 'Payments & Invoices')

@section('admin_content')
<div style="padding: 2rem;">

    <!-- Header -->
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#1b1f2a;margin:0;">Payments & Invoices</h1>
            <p style="color:#6b7280;margin:.25rem 0 0;font-size:.9rem;">All transactions and payment records</p>
        </div>
    </div>

    <!-- Stats Row -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem;margin-bottom:2rem;">
        <div style="background:linear-gradient(135deg,#2d6a4f,#40916c);border-radius:16px;padding:1.5rem;color:white;">
            <div style="font-size:.8rem;opacity:.85;margin-bottom:.5rem;">Total Revenue</div>
            <div style="font-size:1.8rem;font-weight:800;">₹{{ number_format($totalRevenue, 0) }}</div>
            <div style="font-size:.75rem;opacity:.7;margin-top:.4rem;">From confirmed payments</div>
        </div>
        <div style="background:white;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb;">
            <div style="font-size:.8rem;color:#6b7280;margin-bottom:.5rem;">Successful</div>
            <div style="font-size:1.8rem;font-weight:800;color:#2d6a4f;">{{ $totalSuccessful }}</div>
            <div style="font-size:.75rem;color:#52b788;margin-top:.4rem;display:flex;align-items:center;gap:.3rem;"><i class="fas fa-check-circle"></i> Confirmed</div>
        </div>
        <div style="background:white;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb;">
            <div style="font-size:.8rem;color:#6b7280;margin-bottom:.5rem;">Pending</div>
            <div style="font-size:1.8rem;font-weight:800;color:#f59e0b;">{{ $totalPending }}</div>
            <div style="font-size:.75rem;color:#f59e0b;margin-top:.4rem;display:flex;align-items:center;gap:.3rem;"><i class="fas fa-clock"></i> Awaiting</div>
        </div>
        <div style="background:white;border-radius:16px;padding:1.5rem;border:1px solid #e5e7eb;">
            <div style="font-size:.8rem;color:#6b7280;margin-bottom:.5rem;">Failed</div>
            <div style="font-size:1.8rem;font-weight:800;color:#ef4444;">{{ $totalFailed }}</div>
            <div style="font-size:.75rem;color:#ef4444;margin-top:.4rem;display:flex;align-items:center;gap:.3rem;"><i class="fas fa-times-circle"></i> Failed</div>
        </div>
    </div>

    <!-- Table -->
    <div style="background:white;border-radius:20px;box-shadow:0 4px 20px rgba(0,0,0,0.04);overflow:hidden;border:1px solid #e5e7eb;">
        <div style="padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb;display:flex;align-items:center;gap:.6rem;">
            <i class="fas fa-receipt" style="color:#2d6a4f;"></i>
            <strong style="font-size:.95rem;">All Transactions</strong>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:.85rem;">
                <thead>
                    <tr style="background:#f9faf8;">
                        <th style="padding:1rem 1.25rem;text-align:left;font-weight:600;color:#6b7280;white-space:nowrap;">Invoice #</th>
                        <th style="padding:1rem 1.25rem;text-align:left;font-weight:600;color:#6b7280;">Patient</th>
                        <th style="padding:1rem 1.25rem;text-align:left;font-weight:600;color:#6b7280;">Service</th>
                        <th style="padding:1rem 1.25rem;text-align:left;font-weight:600;color:#6b7280;">Doctor</th>
                        <th style="padding:1rem 1.25rem;text-align:left;font-weight:600;color:#6b7280;">Mode</th>
                        <th style="padding:1rem 1.25rem;text-align:right;font-weight:600;color:#6b7280;">Amount</th>
                        <th style="padding:1rem 1.25rem;text-align:left;font-weight:600;color:#6b7280;">Status</th>
                        <th style="padding:1rem 1.25rem;text-align:left;font-weight:600;color:#6b7280;">Date</th>
                        <th style="padding:1rem 1.25rem;text-align:center;font-weight:600;color:#6b7280;">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($payments as $payment)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:1rem 1.25rem;">
                            <span style="font-family:monospace;font-weight:600;color:#2d6a4f;font-size:.8rem;">
                                {{ $payment->invoice_number ?? '—' }}
                            </span>
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            <div style="font-weight:600;color:#1b1f2a;">{{ $payment->user->name ?? 'N/A' }}</div>
                            <div style="font-size:.75rem;color:#9ca3af;">{{ $payment->user->email ?? '' }}</div>
                        </td>
                        <td style="padding:1rem 1.25rem;color:#374151;">
                            {{ $payment->appointment->service->title ?? '—' }}
                        </td>
                        <td style="padding:1rem 1.25rem;color:#374151;">
                            {{ $payment->appointment->doctor->name ?? '—' }}
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @if($payment->appointment)
                            <span style="background:{{ $payment->appointment->mode == 'online' ? 'rgba(45,106,79,.1)' : 'rgba(244,162,97,.15)' }};color:{{ $payment->appointment->mode == 'online' ? '#2d6a4f' : '#c05621' }};padding:.2rem .7rem;border-radius:50px;font-size:.72rem;font-weight:600;">
                                {{ ucfirst($payment->appointment->mode) }}
                            </span>
                            @endif
                        </td>
                        <td style="padding:1rem 1.25rem;text-align:right;font-weight:700;color:#1b1f2a;">
                            ₹{{ number_format($payment->amount, 0) }}
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            @php
                                $colors = [
                                    'successful' => ['bg'=>'rgba(34,197,94,.1)','color'=>'#15803d'],
                                    'pending'    => ['bg'=>'rgba(245,158,11,.1)','color'=>'#b45309'],
                                    'failed'     => ['bg'=>'rgba(239,68,68,.1)', 'color'=>'#b91c1c'],
                                ];
                                $c = $colors[$payment->status] ?? ['bg'=>'#f3f4f6','color'=>'#6b7280'];
                            @endphp
                            <span style="background:{{ $c['bg'] }};color:{{ $c['color'] }};padding:.25rem .8rem;border-radius:50px;font-size:.72rem;font-weight:700;text-transform:capitalize;">
                                {{ $payment->status }}
                            </span>
                        </td>
                        <td style="padding:1rem 1.25rem;color:#6b7280;white-space:nowrap;font-size:.8rem;">
                            {{ $payment->created_at->format('d M Y') }}<br>
                            <span style="color:#9ca3af;">{{ $payment->created_at->format('h:i A') }}</span>
                        </td>
                        <td style="padding:1rem 1.25rem;text-align:center;">
                            <a href="{{ route('admin.payments.show', $payment) }}" style="color:#2d6a4f;font-size:.8rem;font-weight:600;text-decoration:none;background:rgba(45,106,79,.06);padding:.35rem .8rem;border-radius:8px;">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" style="padding:3rem;text-align:center;color:#9ca3af;">
                            <i class="fas fa-receipt" style="font-size:2.5rem;margin-bottom:1rem;display:block;"></i>
                            No payment records yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($payments->hasPages())
        <div style="padding:1rem 1.5rem;border-top:1px solid #e5e7eb;">
            {{ $payments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
