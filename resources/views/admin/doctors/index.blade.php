@extends('layouts.admin')

@section('title', 'Manage Doctors')

@section('admin_content')
<div class="card admin-card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="fas fa-user-md me-2 text-success"></i>Manage Doctors & Team</h5>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-success"><i class="fas fa-plus me-1"></i> Add Doctor</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Doctor</th>
                        <th>Qualifications</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    @if($doctor->photo_url)
                                        <img src="{{ $doctor->photo_url }}" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $doctor->name }}</h6>
                                        <small class="text-muted">{{ $doctor->designation }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-dark small">{{ Str::limit($doctor->qualification, 40) }}</div>
                                <small class="text-muted">{{ $doctor->experience_years }} years exp</small>
                            </td>
                            <td>
                                @if($doctor->is_active)
                                    <span class="badge bg-success rounded-pill px-3">Active</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $doctor->display_order }}</td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-outline-primary shadow-sm me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this doctor?');">
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
                                <i class="fas fa-user-md fa-3x mb-3 text-light"></i>
                                <h6>No doctors found</h6>
                                <p class="mb-0">Get started by adding your first team member.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
