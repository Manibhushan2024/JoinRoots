@extends('layouts.admin')

@section('title', 'Manage Appointment')

@section('admin_content')
<div class="card admin-card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="fas fa-edit me-2 text-primary"></i>Manage Appointment: #{{ $appointment->id }}</h5>
    </div>
    <div class="card-body p-4 border border-top-0 rounded-bottom">
        <div class="row mb-4">
            <div class="col-md-6 border-end">
                <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.8rem;">Patient Details</h6>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-user text-primary me-2" style="width: 20px;"></i>
                    <strong>{{ $appointment->user->name ?? $appointment->name ?? 'Guest' }}</strong>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-envelope text-primary me-2" style="width: 20px;"></i>
                    <span>{{ $appointment->user->email ?? $appointment->email ?? 'N/A' }}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-phone text-primary me-2" style="width: 20px;"></i>
                    <span>{{ $appointment->user->profile->phone ?? $appointment->phone ?? 'N/A' }}</span>
                </div>
            </div>
            <div class="col-md-6 ps-4">
                <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.8rem;">Session Info</h6>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-stethoscope text-success me-2" style="width: 20px;"></i>
                    <strong>{{ $appointment->service->title ?? 'N/A' }}</strong>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-calendar-day text-success me-2" style="width: 20px;"></i>
                    <span>{{ $appointment->start_datetime ? \Carbon\Carbon::parse($appointment->start_datetime)->format('F d, Y at H:i') : 'Flexible / TBD' }}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-laptop-medical text-success me-2" style="width: 20px;"></i>
                    <span>{{ ucfirst($appointment->mode) }}</span>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="bg-light p-4 rounded-4 border">
            @csrf @method('PUT')
            
            <h6 class="text-muted text-uppercase fw-bold mb-3" style="font-size: 0.8rem;">Administration</h6>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Assignment <span class="text-success">(Doctor/Therapist)</span></label>
                    <select name="doctor_id" class="form-select border-success border-opacity-50">
                        <option value="">-- Unassigned --</option>
                        @foreach(\App\Models\Doctor::orderBy('name')->get() as $doc)
                            <option value="{{ $doc->id }}" {{ $appointment->doctor_id == $doc->id ? 'selected' : '' }}>
                                {{ $doc->name }} ({{ $doc->designation }})
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select fw-bold {{ $appointment->status == 'confirmed' ? 'text-success border-success' : ($appointment->status == 'pending' ? 'text-warning border-warning' : '') }}">
                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="no_show" {{ $appointment->status == 'no_show' ? 'selected' : '' }}>No Show</option>
                    </select>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label fw-bold">Admin Notes (Private - Not visible to patient)</label>
                    <textarea name="admin_notes" class="form-control bg-white" rows="4" placeholder="Enter notes re: diagnosis, next steps, feedback...">{{ old('admin_notes', $appointment->admin_notes) }}</textarea>
                </div>
                
                @if($appointment->notes)
                <div class="col-md-12 mt-3">
                    <div class="alert alert-info py-2 mb-0">
                        <strong>Patient's Note:</strong> {{ $appointment->notes }}
                    </div>
                </div>
                @endif
                
                <div class="col-md-12 mt-4 pt-3 border-top d-flex justify-content-end">
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary me-2">Back to List</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Appointment</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
