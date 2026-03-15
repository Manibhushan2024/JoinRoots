@extends('layouts.app')

@section('title', 'Patient Dashboard')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        {{-- Profile Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 text-center" style="background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);">
                    <div class="position-relative d-inline-block mb-3">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/'.$user->profile_image) }}" class="rounded-circle border border-4 border-white shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-white border border-4 border-white shadow-sm d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                                <i class="fas fa-user-circle text-muted" style="font-size: 80px;"></i>
                            </div>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="position-absolute bottom-0 end-0 bg-success text-white rounded-circle p-2 shadow-sm" style="line-height: 1;">
                            <i class="fas fa-camera" style="font-size: 14px;"></i>
                        </a>
                    </div>
                    <h3 class="fw-bold mb-1" style="font-family: 'Fraunces', serif;">{{ $user->name }}</h3>
                    <p class="text-muted small mb-0">{{ $user->email }}</p>
                    <div class="badge bg-success bg-opacity-10 text-success mt-2 px-3 rounded-pill">Patient Account</div>
                </div>
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-bold text-muted small mb-3">Personal Details</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Phone</span>
                            <span class="small fw-semibold">{{ $user->phone ?? 'Not set' }}</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Relation</span>
                            <span class="small fw-semibold">{{ $user->relation_with_child ?? 'Self' }}</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Age</span>
                            <span class="small fw-semibold">{{ $user->age ?? 'N/A' }}</span>
                        </li>
                        <li class="mb-2">
                            <span class="text-muted small d-block mb-1">Address</span>
                            <span class="small fw-semibold text-wrap d-block">{{ $user->address ?? 'No address provided' }}</span>
                        </li>
                    </ul>
                    <hr class="my-3 opacity-10">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-success btn-sm w-100 rounded-pill">
                        <i class="fas fa-edit me-1"></i> Update Profile
                    </a>
                </div>
            </div>

            {{-- Support Card --}}
            <div class="card border-0 shadow-sm rounded-4 mt-4 bg-dark text-white overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-10">
                        <i class="fas fa-comments" style="font-size: 60px;"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Need Help?</h5>
                    <p class="small opacity-75 mb-4">Have questions about your treatment or need to reschedule?</p>
                    <a href="https://wa.me/919334892585" target="_blank" class="btn btn-success w-100 rounded-pill fw-bold">
                        <i class="fab fa-whatsapp me-2"></i> Chat Support
                    </a>
                </div>
            </div>
        </div>

        {{-- Appointments Main Content --}}
        <div class="col-lg-8">
            {{-- Upcoming/Recent Spotlight --}}
            @php $nextApt = $appointments->where('status', 'confirmed')->where('start_datetime', '>=', now())->first(); @endphp
            
            @if($nextApt)
            <div class="card border-0 shadow-sm rounded-4 mb-4 bg-success text-white">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="text-uppercase small fw-bold opacity-75 mb-2">Next Scheduled Session</h6>
                            <h4 class="fw-bold mb-2" style="font-family: 'Fraunces', serif;">{{ $nextApt->service->title }}</h4>
                            <div class="d-flex flex-wrap gap-3 mt-3">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-calendar-alt opacity-75"></i>
                                    <span class="small fw-medium">{{ \Carbon\Carbon::parse($nextApt->start_datetime)->format('D, M j') }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-clock opacity-75"></i>
                                    <span class="small fw-medium">{{ \Carbon\Carbon::parse($nextApt->start_datetime)->format('h:i A') }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-{{ $nextApt->mode == 'online' ? 'video' : 'map-marker-alt' }} opacity-75"></i>
                                    <span class="small fw-medium text-capitalize">{{ $nextApt->mode }} Session</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            @if($nextApt->mode == 'online' && $nextApt->meet_link)
                                <a href="{{ $nextApt->meet_link }}" target="_blank" class="btn btn-light rounded-pill px-4 fw-bold">
                                    Join Meeting <i class="fas fa-external-link-alt ms-1" style="font-size: 12px;"></i>
                                </a>
                            @else
                                <div class="badge bg-white bg-opacity-20 rounded-pill px-3 py-2">Confirmed</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- All Appointments List --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0" style="font-family: 'Fraunces', serif;">Your Sessions</h5>
                    <a href="{{ route('appointments.create.public') }}" class="btn btn-success btn-sm rounded-pill px-3">
                        <i class="fas fa-plus me-1"></i> Book New
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 border-0 small text-uppercase text-muted fw-bold">Service / Date</th>
                                    <th class="py-3 border-0 small text-uppercase text-muted fw-bold">Specialist</th>
                                    <th class="py-3 border-0 small text-uppercase text-muted fw-bold">Payment</th>
                                    <th class="py-3 border-0 small text-uppercase text-muted fw-bold">Status</th>
                                    <th class="pe-4 py-3 border-0 text-center small text-uppercase text-muted fw-bold">Join</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $apt)
                                <tr>
                                    <td class="ps-4 py-4">
                                        <div class="fw-bold text-dark">{{ $apt->service->title ?? 'Consultation' }}</div>
                                        <div class="text-muted small">
                                            {{ \Carbon\Carbon::parse($apt->start_datetime)->format('d M, Y') }} at 
                                            {{ \Carbon\Carbon::parse($apt->start_datetime)->format('h:i A') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small fw-semibold text-dark">{{ $apt->doctor->name ?? 'Specialist' }}</div>
                                        <div class="small text-muted text-capitalize">{{ $apt->mode }} session</div>
                                    </td>
                                    <td>
                                        @if($apt->latestPayment && $apt->latestPayment->status == 'successful')
                                            <div class="text-success small fw-bold">
                                                <i class="fas fa-check-circle me-1"></i> Paid
                                            </div>
                                            <div class="small text-muted" style="font-size: 10px;">{{ $apt->latestPayment->invoice_number }}</div>
                                        @elseif($apt->mode == 'online' && $apt->status == 'pending')
                                            <a href="{{ route('payment.create', ['appointment_id' => $apt->id]) }}" class="btn btn-outline-warning btn-xs py-0 px-2 rounded-pill fw-bold" style="font-size: 10px;">
                                                Pay Now
                                            </a>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'confirmed' => 'bg-success',
                                                'pending'   => 'bg-warning',
                                                'cancelled' => 'bg-danger'
                                            ][$apt->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeClass }} bg-opacity-10 {{ str_replace('bg-', 'text-', $badgeClass) }} rounded-pill px-3 py-2 fw-bold text-capitalize" style="font-size: 11px;">
                                            {{ $apt->status }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-center">
                                        @if($apt->mode == 'online' && $apt->status == 'confirmed')
                                            @if($apt->meet_link)
                                                <a href="{{ $apt->meet_link }}" target="_blank" class="btn btn-success btn-sm rounded-circle p-2" title="Join Session">
                                                    <i class="fas fa-video"></i>
                                                </a>
                                            @else
                                                <span class="text-muted small">Link pending</span>
                                            @endif
                                        @elseif($apt->mode == 'offline' && $apt->status == 'confirmed')
                                            <i class="fas fa-clinic-medical text-primary opacity-50" title="In-Clinic Visit"></i>
                                        @else
                                            <i class="fas fa-lock text-muted opacity-25"></i>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-center">
                                        <div class="opacity-25 mb-3">
                                            <i class="fas fa-calendar-times" style="font-size: 60px;"></i>
                                        </div>
                                        <p class="text-muted">You haven't booked any sessions yet.</p>
                                        <a href="{{ route('appointments.create.public') }}" class="btn btn-success rounded-pill px-4">Book Your First Session</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Info Notice --}}
            <div class="alert bg-light border-0 rounded-4 p-4 mt-4">
                <div class="d-flex gap-3">
                    <div class="text-success mt-1">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Important Note</h6>
                        <p class="small text-muted mb-0">For online sessions, the meeting link will be visible here 15 minutes before the scheduled time. In-clinic sessions are held at our Vikaspuri center. Please arrive 10 minutes early.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-xs { padding: 2px 8px; font-size: 11px; }
    .table > :not(caption) > * > * { border-bottom-width: 0; }
    .table tbody tr { border-bottom: 1px solid #f3f4f6; transition: all 0.2s; }
    .table tbody tr:last-child { border-bottom: 0; }
    .table tbody tr:hover { background-color: #f9fafb !important; }
</style>
@endsection
