@extends('layouts.admin')

@section('title', $doctor->name . ' – Schedule')

@section('admin_content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-light border"><i class="fas fa-arrow-left me-1"></i> Doctors</a>
    <div>
        <h4 class="mb-0 fw-bold">{{ $doctor->name }}'s Schedule</h4>
        <div class="text-muted small">{{ $doctor->designation }}</div>
    </div>
</div>

<div class="row g-4">

    {{-- ── Left: Date picker + Appointment list ─────────── --}}
    <div class="col-lg-8">

        {{-- Date picker form --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-calendar-alt me-2 text-primary"></i>View Appointments by Date</h6>
                <form method="GET" action="{{ route('admin.doctors.schedule', $doctor) }}" class="d-flex gap-3 align-items-end flex-wrap">
                    <div>
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size:.7rem;">Select Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $selectedDate }}" style="min-width:200px;">
                    </div>
                    <button type="submit" class="btn btn-primary px-4" style="background:linear-gradient(135deg,#2D6A4F,#52B788);border:none;border-radius:50px;">
                        <i class="fas fa-search me-1"></i> View
                    </button>
                    @if($selectedDate !== \Carbon\Carbon::today()->toDateString())
                    <a href="{{ route('admin.doctors.schedule', $doctor) }}" class="btn btn-outline-secondary px-4" style="border-radius:50px;">Today</a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Appointment list for selected date --}}
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom py-3 px-4 d-flex justify-content-between align-items-center" style="border-radius:16px 16px 0 0;">
                <div>
                    <h6 class="m-0 fw-bold text-dark">
                        Sessions on {{ \Carbon\Carbon::parse($selectedDate)->format('l, d M Y') }}
                        <span class="badge rounded-pill ms-1" style="background:#EAF5EE;color:#2D6A4F;font-size:.72rem;">
                            {{ $appointments->count() }} sessions
                        </span>
                    </h6>
                </div>
            </div>
            <div class="card-body p-0">
                @if($appointments->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-calendar-day fa-2x mb-2 opacity-25"></i>
                        <p class="mb-1">No sessions scheduled for this date.</p>
                        @if($nextAppointment && $selectedDate !== \Carbon\Carbon::today()->toDateString())
                        <p class="small">
                            Next appointment: <a href="{{ route('admin.doctors.schedule', ['doctor' => $doctor, 'date' => \Carbon\Carbon::parse($nextAppointment->start_datetime)->toDateString()]) }}" class="text-primary fw-bold">
                                {{ \Carbon\Carbon::parse($nextAppointment->start_datetime)->format('D, d M') }}
                            </a>
                        </p>
                        @endif
                    </div>
                @else
                    {{-- Timeline view --}}
                    <div class="p-4">
                        <div style="position:relative;">
                            @foreach($appointments as $apt)
                            <div class="d-flex gap-3 mb-4" style="position:relative;">
                                {{-- Time column --}}
                                <div style="width:80px;flex-shrink:0;text-align:right;">
                                    <div class="fw-bold" style="color:#2D6A4F;font-size:.95rem;">
                                        {{ \Carbon\Carbon::parse($apt->start_datetime)->format('h:i A') }}
                                    </div>
                                    <div class="text-muted" style="font-size:.72rem;">
                                        {{ \Carbon\Carbon::parse($apt->end_datetime)->format('h:i A') }}
                                    </div>
                                </div>

                                {{-- Dot + line --}}
                                <div style="display:flex;flex-direction:column;align-items:center;flex-shrink:0;">
                                    <div style="width:14px;height:14px;border-radius:50%;background:{{ $apt->status === 'confirmed' ? '#22c55e' : ($apt->status === 'pending' ? '#f59e0b' : '#6b7280') }};border:2px solid white;box-shadow:0 0 0 3px {{ $apt->status === 'confirmed' ? 'rgba(34,197,94,.2)' : 'rgba(245,158,11,.2)' }};margin-top:4px;"></div>
                                    @if(!$loop->last)
                                    <div style="width:2px;flex:1;background:#e5e7eb;margin:6px 0;min-height:30px;"></div>
                                    @endif
                                </div>

                                {{-- Appointment card --}}
                                <div class="card border-0 flex-grow-1" style="background:#f9fafb;border-radius:12px;">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <div class="fw-bold" style="font-size:.92rem;">{{ $apt->user->name ?? $apt->name ?? 'Unknown' }}</div>
                                                <div class="text-muted" style="font-size:.78rem;">
                                                    {{ $apt->user->phone ?? $apt->phone ?? '' }}
                                                    @if($apt->user->email ?? $apt->email)
                                                        &nbsp;·&nbsp; {{ $apt->user->email ?? $apt->email }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 align-items-center">
                                                @if($apt->mode === 'online')
                                                    <span class="badge" style="background:#DBEAFE;color:#1D4ED8;font-size:.7rem;"><i class="fas fa-video me-1"></i>Online</span>
                                                    @if($apt->meet_link)
                                                    <a href="{{ $apt->meet_link }}" target="_blank" class="btn btn-sm" style="background:#4285f4;color:white;border-radius:50px;font-size:.72rem;padding:.2rem .65rem;">
                                                        <i class="fas fa-video me-1"></i>Join
                                                    </a>
                                                    @endif
                                                @else
                                                    <span class="badge" style="background:#DCFCE7;color:#166534;font-size:.7rem;"><i class="fas fa-clinic-medical me-1"></i>In-Clinic</span>
                                                @endif
                                                @if($apt->status === 'confirmed')
                                                    <span class="badge bg-success" style="font-size:.7rem;">Confirmed</span>
                                                @elseif($apt->status === 'pending')
                                                    <span class="badge bg-warning text-dark" style="font-size:.7rem;">Pending</span>
                                                @else
                                                    <span class="badge bg-secondary" style="font-size:.7rem;">{{ ucfirst($apt->status) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div style="font-size:.82rem;color:#374151;">
                                            <i class="fas fa-stethoscope me-1 text-success"></i>
                                            <strong>{{ $apt->service->title ?? 'Unknown Service' }}</strong>
                                            &nbsp;·&nbsp; {{ $apt->duration_minutes ?? 60 }} min
                                        </div>
                                        @if($apt->admin_notes)
                                        <div class="mt-2 p-2 rounded" style="background:#FEF3C7;font-size:.78rem;color:#92400E;">
                                            <i class="fas fa-sticky-note me-1"></i>{{ $apt->admin_notes }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ── Right: Next appointment + Working schedule ────── --}}
    <div class="col-lg-4">

        {{-- Next upcoming appointment --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;background:linear-gradient(135deg,#EAF5EE,#F0FFF4);">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-clock me-2" style="color:#2D6A4F;"></i>Next Appointment</h6>
                @if($nextAppointment)
                    <div style="background:white;border-radius:12px;padding:1rem;">
                        <div class="fw-bold" style="font-size:1rem;">{{ \Carbon\Carbon::parse($nextAppointment->start_datetime)->format('D, d M Y') }}</div>
                        <div style="font-size:1.4rem;font-weight:800;color:#2D6A4F;">{{ \Carbon\Carbon::parse($nextAppointment->start_datetime)->format('h:i A') }}</div>
                        <div class="mt-2" style="font-size:.85rem;color:#374151;">
                            <strong>{{ $nextAppointment->user->name ?? $nextAppointment->name ?? 'Unknown' }}</strong>
                        </div>
                        <div class="text-muted" style="font-size:.78rem;">{{ $nextAppointment->service->title ?? '' }}</div>
                        <div class="mt-2">
                            @if($nextAppointment->mode === 'online')
                                <span class="badge" style="background:#DBEAFE;color:#1D4ED8;font-size:.7rem;"><i class="fas fa-video me-1"></i>Online</span>
                            @else
                                <span class="badge" style="background:#DCFCE7;color:#166534;font-size:.7rem;"><i class="fas fa-clinic-medical me-1"></i>In-Clinic</span>
                            @endif
                            <a href="{{ route('admin.doctors.schedule', ['doctor' => $doctor, 'date' => \Carbon\Carbon::parse($nextAppointment->start_datetime)->toDateString()]) }}" class="ms-2 small text-primary text-decoration-none fw-bold">View full day →</a>
                        </div>
                    </div>
                    <div class="mt-3 text-center text-muted" style="font-size:.78rem;">
                        {{ \Carbon\Carbon::parse($nextAppointment->start_datetime)->diffForHumans() }}
                    </div>
                @else
                    <div class="text-center py-3 text-muted">
                        <i class="fas fa-calendar-check fa-2x mb-2 opacity-25"></i>
                        <p class="mb-0 small">No upcoming appointments.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Working schedule editor --}}
        <div class="card border-0 shadow-sm" style="border-radius:16px;">
            <div class="card-header bg-white border-bottom py-3 px-4" style="border-radius:16px 16px 0 0;">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-sliders-h me-2 text-warning"></i>Working Schedule</h6>
            </div>
            <div class="card-body p-4">
                @if(session('schedule_success'))
                    <div class="alert alert-success border-0 rounded-3 py-2 mb-3" style="font-size:.83rem;">
                        <i class="fas fa-check-circle me-1"></i> {{ session('schedule_success') }}
                    </div>
                @endif
                <form action="{{ route('admin.doctors.update-schedule', $doctor) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size:.7rem;">Working Days</label>
                        @php
                            $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
                            $activeDays = $doctor->available_days ?? ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                        @endphp
                        <div class="d-flex flex-wrap gap-2 mt-1">
                            @foreach($days as $day)
                            <label class="d-flex align-items-center gap-1" style="cursor:pointer;">
                                <input type="checkbox" name="available_days[]" value="{{ $day }}"
                                    {{ in_array($day, $activeDays) ? 'checked' : '' }}
                                    class="form-check-input mt-0" style="width:16px;height:16px;">
                                <span style="font-size:.82rem;font-weight:500;">{{ substr($day, 0, 3) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase" style="font-size:.7rem;">Start Time</label>
                            <input type="time" name="work_start_time" class="form-control form-control-sm"
                                value="{{ $doctor->work_start_time ?? '09:00' }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-muted text-uppercase" style="font-size:.7rem;">End Time</label>
                            <input type="time" name="work_end_time" class="form-control form-control-sm"
                                value="{{ $doctor->work_end_time ?? '18:00' }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase" style="font-size:.7rem;">Session Duration (minutes)</label>
                        <select name="slot_duration" class="form-select form-select-sm">
                            @foreach([30, 45, 60, 90, 120] as $dur)
                            <option value="{{ $dur }}" {{ ($doctor->slot_duration ?? 60) == $dur ? 'selected' : '' }}>
                                {{ $dur }} min
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" style="background:linear-gradient(135deg,#2D6A4F,#52B788);border:none;border-radius:50px;font-size:.88rem;">
                        <i class="fas fa-save me-1"></i> Save Schedule
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
