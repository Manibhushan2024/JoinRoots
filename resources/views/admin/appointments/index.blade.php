@extends('layouts.admin')

@section('title', 'Manage Appointments')

@section('admin_content')
<div class="card admin-card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="fas fa-calendar-alt me-2 text-primary"></i>All Appointments</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Patient</th>
                        <th>Service & Doctor</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $apt)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px">
                                        {{ substr($apt->user->name ?? $apt->name ?? '?', 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $apt->user->name ?? $apt->name ?? 'Guest/Unknown' }}</h6>
                                        <small class="text-muted">{{ ucfirst($apt->mode) }} Session</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-dark fw-medium small">{{ Str::limit($apt->service->title ?? 'N/A', 30) }}</div>
                                @if($apt->doctor)
                                    <small class="text-success"><i class="fas fa-user-md me-1"></i> {{ $apt->doctor->name }}</small>
                                @else
                                    <small class="text-muted fst-italic">Unassigned</small>
                                @endif
                            </td>
                            <td>
                                <div class="text-dark small"><i class="far fa-calendar-alt me-1"></i> {{ $apt->start_datetime ? \Carbon\Carbon::parse($apt->start_datetime)->format('M d, Y') : 'N/A' }}</div>
                                @if($apt->start_datetime)
                                    <small class="text-muted"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($apt->start_datetime)->format('H:i') }}</small>
                                @endif
                            </td>
                            <td>
                                @if($apt->status == 'confirmed')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Confirmed</span>
                                @elseif($apt->status == 'pending')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                @elseif($apt->status == 'cancelled')
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Cancelled</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">{{ ucfirst($apt->status) }}</span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.appointments.edit', $apt) }}" class="btn btn-sm btn-outline-primary shadow-sm me-1" title="Edit & Assign">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.appointments.destroy', $apt) }}" method="POST" class="d-inline" onsubmit="return confirm('Strictly delete this appointment? Usually, you should just cancel it.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-calendar-check fa-3x mb-3 text-light"></i>
                                <h6>No appointments found</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
