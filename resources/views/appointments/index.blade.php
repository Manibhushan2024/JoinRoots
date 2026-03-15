@extends('layouts.app')

@section('title', 'Book a Consultation | JoinRoots')

@section('content')
<div class="py-5 bg-primary text-white text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #2D6A4F 0%, #1B4332 100%);">
    <div class="container position-relative z-index-1 py-5">
        <h1 class="display-4 fw-bold mb-3">Schedule Your Session</h1>
        <p class="lead mx-auto" style="max-width: 600px; color: rgba(255,255,255,.8);">
            Take the first step towards better care. Select your therapy, prefered specialist, and a convenient time slot.
        </p>
    </div>
</div>

<div class="container py-5 my-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-4 border-0 bg-success bg-opacity-10 text-success rounded-3">
                            <i class="fas fa-check-circle me-3 fs-4"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger bg-danger bg-opacity-10 border-0 text-danger rounded-3 mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('appointments.store.public') }}" method="POST">
                        @csrf
                        
                        <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">1. Your Details</h5>
                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <label for="name" class="form-label fw-bold small text-muted text-uppercase">Patient/Parent Name</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0" name="name" id="name" value="{{ auth()->check() ? auth()->user()->name : old('name') }}" required placeholder="e.g. Aditi Sharma">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold small text-muted text-uppercase">Email Address</label>
                                <input type="email" class="form-control form-control-lg bg-light border-0" name="email" id="email" value="{{ auth()->check() ? auth()->user()->email : old('email') }}" required placeholder="aditi@example.com">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold small text-muted text-uppercase">Phone Number</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0" name="phone" id="phone" value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}" required placeholder="10-digit number">
                            </div>
                        </div>

                        <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">2. Clinical Requirements</h5>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label for="service_id" class="form-label fw-bold small text-muted text-uppercase">Therapy Service</label>
                                <select name="service_id" id="service_id" class="form-select form-select-lg bg-light border-0" required>
                                    <option value="">-- Choose Therapy --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" data-online="{{ $service->online_price }}" data-offline="{{ $service->offline_price }}">
                                            {{ $service->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="doctor_id" class="form-label fw-bold small text-muted text-uppercase">Specialist</label>
                                <select name="doctor_id" id="doctor_id" class="form-select form-select-lg bg-light border-0" required>
                                    <option value="">-- Choose Specialist --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">
                                            {{ $doctor->name }} ({{ $doctor->designation }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <label class="form-label fw-bold small text-muted text-uppercase">Mode of Consultation</label>
                                <div class="d-flex gap-4 mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mode" id="mode_offline" value="offline" checked>
                                        <label class="form-check-label" for="mode_offline">
                                            <strong>In-Clinic</strong> (Delhi NCR) - <span id="price_offline" class="text-success fw-bold">₹0</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mode" id="mode_online" value="online">
                                        <label class="form-check-label" for="mode_online">
                                            <strong>Online Video</strong> - <span id="price_online" class="text-success fw-bold">₹0</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-4 text-primary border-bottom pb-2">3. Select Date & Time</h5>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label for="appointment_date" class="form-label fw-bold small text-muted text-uppercase">Consultation Date</label>
                                <input type="date" class="form-control form-control-lg bg-light border-0" id="appointment_date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
                            </div>
                            
                            <div class="col-md-12 mt-4">
                                <label class="form-label fw-bold small text-muted text-uppercase d-block">Available Time Slots</label>
                                <div id="time_slots_container" class="d-flex flex-wrap gap-2 mt-2">
                                    <p class="text-muted small fst-italic">Please select a specialist and date to view available time slots.</p>
                                </div>
                                <input type="hidden" name="appointment_time" id="appointment_time" required>
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm py-3" style="background: linear-gradient(135deg, #2D6A4F, #52B788); border: none;">
                                Confirm Booking <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <small class="text-center text-muted mt-3"><i class="fas fa-lock me-1"></i> Your information is secure and encrypted.</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_id');
    const doctorSelect = document.getElementById('doctor_id');
    const dateInput = document.getElementById('appointment_date');
    const slotsContainer = document.getElementById('time_slots_container');
    const timeInput = document.getElementById('appointment_time');
    const priceOffline = document.getElementById('price_offline');
    const priceOnline = document.getElementById('price_online');

    function updatePrices() {
        const option = serviceSelect.options[serviceSelect.selectedIndex];
        if(option && option.value) {
            priceOffline.innerText = '₹' + parseFloat(option.getAttribute('data-offline')).toLocaleString('en-IN');
            priceOnline.innerText = '₹' + parseFloat(option.getAttribute('data-online')).toLocaleString('en-IN');
        } else {
            priceOffline.innerText = '₹0';
            priceOnline.innerText = '₹0';
        }
    }

    function fetchSlots() {
        const doctorId = doctorSelect.value;
        const date = dateInput.value;
        
        if (!doctorId || !date) {
            slotsContainer.innerHTML = '<p class="text-muted small fst-italic">Please select a specialist and date to view available time slots.</p>';
            timeInput.value = '';
            return;
        }
        
        slotsContainer.innerHTML = '<div class="spinner-border spinner-border-sm text-primary" role="status"></div>';
        
        fetch(`{{ route('api.available-slots') }}?doctor_id=${doctorId}&date=${date}`)
            .then(res => res.json())
            .then(data => {
                slotsContainer.innerHTML = '';
                timeInput.value = '';
                
                if (data.length === 0) {
                    slotsContainer.innerHTML = '<div class="alert alert-warning py-2 w-100 mb-0">No slots available for this day. Please select another date.</div>';
                    return;
                }
                
                data.forEach(slot => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn btn-outline-primary fw-bold shadow-sm slot-btn';
                    btn.style.borderRadius = '50px';
                    btn.textContent = slot.time_12;
                    btn.dataset.time = slot.time_24;
                    
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('.slot-btn').forEach(b => {
                            b.classList.remove('btn-primary', 'text-white');
                            b.classList.add('btn-outline-primary');
                        });
                        this.classList.remove('btn-outline-primary');
                        this.classList.add('btn-primary', 'text-white');
                        timeInput.value = this.dataset.time;
                    });
                    
                    slotsContainer.appendChild(btn);
                });
            })
            .catch(err => {
                slotsContainer.innerHTML = '<div class="text-danger small">Failed to load slots. Please refresh.</div>';
            });
    }

    serviceSelect.addEventListener('change', updatePrices);
    doctorSelect.addEventListener('change', fetchSlots);
    dateInput.addEventListener('change', fetchSlots);
});
</script>
@endsection
