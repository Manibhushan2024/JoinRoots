@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('admin_content')
<h2 class="mb-4 fw-bold">Dashboard Overview</h2>

<div class="row g-4 mb-4">
    <!-- Appointments Stat -->
    <div class="col-md-3">
        <div class="admin-card card bg-white h-100 admin-card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold mb-0 text-uppercase">Appointments</h6>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2">
                        <i class="fas fa-calendar-check fa-lg"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0 text-dark">{{ $totalAppointments }}</h2>
            </div>
        </div>
    </div>
    
    <!-- Contacts Stat -->
    <div class="col-md-3">
        <div class="admin-card card bg-white h-100 admin-card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold mb-0 text-uppercase">Inquiries</h6>
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0 text-dark">{{ $totalContacts }}</h2>
            </div>
        </div>
    </div>

    <!-- Doctors Stat -->
    <div class="col-md-3">
        <div class="admin-card card bg-white h-100 admin-card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold mb-0 text-uppercase">Team Doctors</h6>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2">
                        <i class="fas fa-user-md fa-lg"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0 text-dark">{{ $totalDoctors }}</h2>
            </div>
        </div>
    </div>

    <!-- Reviews Stat -->
    <div class="col-md-3">
        <div class="admin-card card bg-white h-100 admin-card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold mb-0 text-uppercase">Client Reviews</h6>
                    <div class="bg-info bg-opacity-10 text-info rounded-circle p-2">
                        <i class="fas fa-star fa-lg"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0 text-dark">{{ $totalReviews }}</h2>
            </div>
        </div>
    </div>
    
    <!-- Users Stat -->
    <div class="col-md-3">
        <div class="admin-card card bg-white h-100 admin-card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold mb-0 text-uppercase">Total Users</h6>
                    <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle p-2">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0 text-dark">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>

    <!-- Blog Posts Stat -->
    <div class="col-md-3">
        <div class="admin-card card bg-white h-100 admin-card-stat">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold mb-0 text-uppercase">Blog Posts</h6>
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle p-2">
                        <i class="fas fa-blog fa-lg"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0 text-dark">{{ $totalPosts }}</h2>
            </div>
        </div>
    </div>

    <!-- Revenue Stat -->
    <div class="col-md-3">
        <div class="admin-card card bg-white h-100 admin-card-stat" style="border-bottom: 4px solid #2d6a4f;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-muted fw-bold mb-0 text-uppercase">Total Revenue</h6>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2">
                        <i class="fas fa-receipt fa-lg"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0 text-dark">₹{{ number_format($totalRevenue, 0) }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Appointments -->
    <div class="col-md-7">
        <div class="admin-card card h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-calendar-check me-2 text-primary"></i>Recent Appointments</h6>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-primary shadow-sm">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Client Name</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAppointments as $apt)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px">
                                                {{ substr($apt->user->name ?? $apt->name ?? 'U', 0, 1) }}
                                            </div>
                                            <strong>{{ $apt->user->name ?? $apt->name ?? 'Unknown' }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($apt->service->title ?? 'N/A', 25) }}</td>
                                    <td>{{ $apt->start_datetime ? \Carbon\Carbon::parse($apt->start_datetime)->format('M d, Y') : 'N/A' }}</td>
                                    <td>
                                        @if($apt->status == 'confirmed')
                                            <span class="badge bg-success rounded-pill px-3 py-2">Confirmed</span>
                                        @elseif($apt->status == 'pending')
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3 py-2">{{ ucfirst($apt->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No recent appointments.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-md-5">
        <div class="admin-card card h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom border-light">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-envelope-open me-2 text-warning"></i>Recent Inquiries</h6>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-warning shadow-sm">View All</a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($recentContacts as $contact)
                    <li class="list-group-item py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong>{{ $contact->name }}</strong>
                            <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="text-muted mb-0 small">{{ Str::limit($contact->message, 60) }}</p>
                    </li>
                @empty
                    <li class="list-group-item text-center py-4 text-muted">No recent messages.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
