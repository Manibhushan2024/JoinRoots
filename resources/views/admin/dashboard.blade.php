@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin_content')

{{-- ── Founder Quote Card ─────────────────────────────── --}}
<div class="card border-0 mb-4 shadow-sm" style="background:linear-gradient(135deg,#1B2B25 0%,#2D6A4F 100%);border-radius:16px;overflow:hidden;">
    <div class="card-body p-4">
        <div class="d-flex align-items-start gap-3">
            <div style="width:52px;height:52px;background:rgba(255,255,255,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="fas fa-user-md text-white fs-5"></i>
            </div>
            <div>
                <div style="font-size:.72rem;font-weight:700;color:rgba(255,255,255,.5);text-transform:uppercase;letter-spacing:.1em;margin-bottom:.4rem;">
                    From the Founder's Desk &nbsp;·&nbsp; Ms. Deepali Sahani
                </div>
                <blockquote class="mb-1" style="font-size:1.05rem;font-style:italic;color:rgba(255,255,255,.92);line-height:1.6;font-family:'Fraunces',serif;">
                    "{{ $todayQuote['quote'] }}"
                </blockquote>
                <div style="font-size:.78rem;color:rgba(255,255,255,.45);margin-top:.35rem;">{{ $todayQuote['context'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Stats Row ──────────────────────────────────────── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body py-3 px-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size:.7rem;">Appointments</span>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:rgba(45,106,79,.1);">
                        <i class="fas fa-calendar-check text-success" style="font-size:.85rem;"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0">{{ $totalAppointments }}</h3>
                <small class="text-muted" style="font-size:.72rem;">{{ $todayAppointments->count() }} today</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body py-3 px-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size:.7rem;">Revenue</span>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:rgba(34,197,94,.1);">
                        <i class="fas fa-rupee-sign text-success" style="font-size:.85rem;"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0">₹{{ number_format($totalRevenue, 0) }}</h3>
                <small class="text-muted" style="font-size:.72rem;">paid sessions</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body py-3 px-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size:.7rem;">Inquiries</span>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:rgba(245,158,11,.1);">
                        <i class="fas fa-envelope text-warning" style="font-size:.85rem;"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0">{{ $totalContacts }}</h3>
                <small class="text-muted" style="font-size:.72rem;">total messages</small>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
            <div class="card-body py-3 px-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size:.7rem;">Team</span>
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:rgba(99,102,241,.1);">
                        <i class="fas fa-user-md text-indigo" style="font-size:.85rem;color:#6366f1;"></i>
                    </div>
                </div>
                <h3 class="fw-bold mb-0">{{ $totalDoctors }}</h3>
                <small class="text-muted" style="font-size:.72rem;">therapists active</small>
            </div>
        </div>
    </div>
</div>

{{-- ── Today's Schedule ────────────────────────────────── --}}
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center" style="border-radius:16px 16px 0 0;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:10px;height:10px;border-radius:50%;background:#22c55e;box-shadow:0 0 0 3px rgba(34,197,94,.2);"></div>
                    <h6 class="m-0 fw-bold text-dark">
                        Today's Sessions &nbsp;
                        <span class="badge rounded-pill" style="background:#EAF5EE;color:#2D6A4F;font-size:.72rem;">
                            {{ $todayAppointments->count() }} booked
                        </span>
                    </h6>
                </div>
                <span class="text-muted small">{{ \Carbon\Carbon::today()->format('l, d M Y') }}</span>
            </div>
            <div class="card-body p-0">
                @if($todayAppointments->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-calendar-day fa-2x mb-2 opacity-25"></i>
                        <p class="mb-0">No sessions scheduled for today.</p>
                    </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Time</th>
                                <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Patient</th>
                                <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Service</th>
                                <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Therapist</th>
                                <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Mode</th>
                                <th style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($todayAppointments as $apt)
                            <tr>
                                <td>
                                    <div class="fw-bold" style="color:#2D6A4F;font-size:.95rem;">
                                        {{ \Carbon\Carbon::parse($apt->start_datetime)->format('h:i A') }}
                                    </div>
                                    <div class="text-muted" style="font-size:.72rem;">
                                        → {{ \Carbon\Carbon::parse($apt->end_datetime)->format('h:i A') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#2D6A4F,#52B788);color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;flex-shrink:0;">
                                            {{ strtoupper(substr($apt->user->name ?? $apt->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold" style="font-size:.88rem;">{{ $apt->user->name ?? $apt->name ?? 'Unknown' }}</div>
                                            <div class="text-muted" style="font-size:.72rem;">{{ $apt->user->phone ?? $apt->phone ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:.85rem;">{{ Str::limit($apt->service->title ?? 'N/A', 28) }}</td>
                                <td style="font-size:.85rem;">{{ $apt->doctor->name ?? '—' }}</td>
                                <td>
                                    @if($apt->mode === 'online')
                                        <span class="badge" style="background:#DBEAFE;color:#1D4ED8;font-size:.72rem;"><i class="fas fa-video me-1"></i>Online</span>
                                    @else
                                        <span class="badge" style="background:#DCFCE7;color:#166534;font-size:.72rem;"><i class="fas fa-clinic-medical me-1"></i>In-Clinic</span>
                                    @endif
                                </td>
                                <td>
                                    @if($apt->status === 'confirmed')
                                        <span class="badge bg-success rounded-pill px-3">Confirmed</span>
                                    @elseif($apt->status === 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill px-3">Pending</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3">{{ ucfirst($apt->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ── Tomorrow + Upcoming ─────────────────────────────── --}}
<div class="row g-4 mb-4">
    {{-- Tomorrow --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center" style="border-radius:16px 16px 0 0;">
                <h6 class="m-0 fw-bold text-dark">
                    <i class="fas fa-calendar-day me-2 text-primary"></i>Tomorrow
                    <span class="badge rounded-pill ms-1" style="background:#EDE9FE;color:#7C3AED;font-size:.72rem;">{{ $tomorrowAppointments->count() }}</span>
                </h6>
                <span class="text-muted small">{{ \Carbon\Carbon::tomorrow()->format('d M Y') }}</span>
            </div>
            <div class="card-body p-0">
                @if($tomorrowAppointments->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-moon fa-2x mb-2 opacity-25"></i>
                        <p class="mb-0 small">No sessions scheduled for tomorrow.</p>
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                    @foreach($tomorrowAppointments as $apt)
                        <li class="list-group-item px-4 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-bold" style="font-size:.88rem;">
                                        {{ $apt->user->name ?? $apt->name ?? 'Unknown' }}
                                    </div>
                                    <div class="text-muted" style="font-size:.78rem;">
                                        {{ Str::limit($apt->service->title ?? '', 30) }}
                                        &nbsp;·&nbsp; {{ $apt->doctor->name ?? '' }}
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold" style="color:#7C3AED;font-size:.9rem;">
                                        {{ \Carbon\Carbon::parse($apt->start_datetime)->format('h:i A') }}
                                    </div>
                                    @if($apt->mode === 'online')
                                        <span class="badge" style="background:#DBEAFE;color:#1D4ED8;font-size:.68rem;">Online</span>
                                    @else
                                        <span class="badge" style="background:#DCFCE7;color:#166534;font-size:.68rem;">Clinic</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    {{-- Upcoming 7 days --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom py-3 px-4">
                <h6 class="m-0 fw-bold text-dark">
                    <i class="fas fa-calendar-week me-2 text-warning"></i>Next 7 Days
                    <span class="badge rounded-pill ms-1" style="background:#FEF3C7;color:#92400E;font-size:.72rem;">{{ $upcomingAppointments->count() }}</span>
                </h6>
            </div>
            <div class="card-body p-0">
                @if($upcomingAppointments->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-calendar-times fa-2x mb-2 opacity-25"></i>
                        <p class="mb-0 small">No upcoming sessions in next 7 days.</p>
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                    @foreach($upcomingAppointments->take(8) as $apt)
                        <li class="list-group-item px-4 py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold" style="font-size:.85rem;">{{ $apt->user->name ?? $apt->name ?? 'Unknown' }}</div>
                                    <div class="text-muted" style="font-size:.75rem;">{{ Str::limit($apt->service->title ?? '', 28) }}</div>
                                </div>
                                <div class="text-end">
                                    <div style="font-size:.8rem;color:#D97706;font-weight:600;">
                                        {{ \Carbon\Carbon::parse($apt->start_datetime)->format('D, d M') }}
                                    </div>
                                    <div style="font-size:.75rem;color:#6B7280;">{{ \Carbon\Carbon::parse($apt->start_datetime)->format('h:i A') }}</div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                @endif
            </div>
            @if($upcomingAppointments->count() > 8)
            <div class="card-footer bg-white text-center border-top">
                <a href="{{ route('admin.appointments.index') }}" class="text-primary small fw-bold text-decoration-none">
                    View all {{ $upcomingAppointments->count() }} upcoming →
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- ── Recent Appointments + Contacts ─────────────────── --}}
<div class="row g-4">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom" style="border-radius:16px 16px 0 0;">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-history me-2 text-primary"></i>Recent Bookings</h6>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius:50px;font-size:.78rem;">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="font-size:.72rem;text-transform:uppercase;">Client</th>
                                <th style="font-size:.72rem;text-transform:uppercase;">Service</th>
                                <th style="font-size:.72rem;text-transform:uppercase;">Date</th>
                                <th style="font-size:.72rem;text-transform:uppercase;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAppointments as $apt)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#2D6A4F,#52B788);color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;flex-shrink:0;">
                                                {{ strtoupper(substr($apt->user->name ?? $apt->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div class="fw-semibold" style="font-size:.85rem;">{{ $apt->user->name ?? $apt->name ?? 'Unknown' }}</div>
                                        </div>
                                    </td>
                                    <td style="font-size:.82rem;">{{ Str::limit($apt->service->title ?? 'N/A', 22) }}</td>
                                    <td style="font-size:.82rem;">{{ $apt->start_datetime ? \Carbon\Carbon::parse($apt->start_datetime)->format('d M, h:i A') : 'N/A' }}</td>
                                    <td>
                                        @if($apt->status === 'confirmed')
                                            <span class="badge bg-success rounded-pill px-2" style="font-size:.7rem;">Confirmed</span>
                                        @elseif($apt->status === 'pending')
                                            <span class="badge bg-warning text-dark rounded-pill px-2" style="font-size:.7rem;">Pending</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-2" style="font-size:.7rem;">{{ ucfirst($apt->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted small">No appointments yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom" style="border-radius:16px 16px 0 0;">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-envelope-open-text me-2 text-warning"></i>Recent Inquiries</h6>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-warning" style="border-radius:50px;font-size:.78rem;">View All</a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($recentContacts as $contact)
                    <li class="list-group-item py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong style="font-size:.88rem;">{{ $contact->name }}</strong>
                            <small class="text-muted" style="font-size:.72rem;">{{ $contact->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="text-muted mb-0" style="font-size:.8rem;">{{ Str::limit($contact->message, 65) }}</p>
                    </li>
                @empty
                    <li class="list-group-item text-center py-4 text-muted small">No recent messages.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

@endsection
