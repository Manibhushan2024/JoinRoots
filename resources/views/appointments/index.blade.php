@extends('layouts.app')

@section('title', 'Book a Consultation | JoinRoots')

@section('content')
<div class="py-5 bg-primary text-white text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #2D6A4F 0%, #1B4332 100%);">
    <div class="container position-relative z-index-1 py-5">
        <h1 class="display-4 fw-bold mb-3">Book Your Child's Therapy Session</h1>
        <p class="lead mx-auto" style="max-width: 600px; color: rgba(255,255,255,.8);">
            Expert RCI-certified therapists in Vikaspuri, Delhi. Online sessions available pan-India. Takes less than 2 minutes to book.
        </p>
        <!-- Trust bar -->
        <div style="display:flex;justify-content:center;flex-wrap:wrap;gap:1.5rem;margin-top:1.75rem;">
            <div style="display:flex;align-items:center;gap:.5rem;font-size:.83rem;color:rgba(255,255,255,.85);">
                <i class="fas fa-shield-alt" style="color:#52B788;"></i> RCI Certified Therapists
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;font-size:.83rem;color:rgba(255,255,255,.85);">
                <i class="fas fa-star" style="color:#F4A261;"></i> 4.9★ Parent Rating
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;font-size:.83rem;color:rgba(255,255,255,.85);">
                <i class="fas fa-lock" style="color:#52B788;"></i> Secure & Confidential
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;font-size:.83rem;color:rgba(255,255,255,.85);">
                <i class="fas fa-video" style="color:#52B788;"></i> Online Sessions Available
            </div>
        </div>
    </div>
</div>

<div class="container py-5 my-3">
    <div class="row justify-content-center g-5">
        <!-- Trust Sidebar -->
        <div class="col-lg-4 d-none d-lg-block">
            <div class="sticky-top" style="top:90px;">
                <div class="card border-0 shadow-sm rounded-4 mb-4" style="background:linear-gradient(135deg,#EAF5EE,#F0FFF4);">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-shield-alt text-success me-2"></i>Why Families Choose Us</h6>
                        <ul class="list-unstyled mb-0" style="font-size:.88rem;color:#374151;">
                            <li class="mb-3 d-flex align-items-start gap-2"><i class="fas fa-check-circle text-success mt-1"></i><span><strong>RCI Certified</strong> therapists — India's national rehabilitation standard</span></li>
                            <li class="mb-3 d-flex align-items-start gap-2"><i class="fas fa-check-circle text-success mt-1"></i><span><strong>Govt. Registered</strong> center (UDYAM-DL-11-0152999)</span></li>
                            <li class="mb-3 d-flex align-items-start gap-2"><i class="fas fa-check-circle text-success mt-1"></i><span><strong>500+ families</strong> helped across Delhi & India</span></li>
                            <li class="mb-3 d-flex align-items-start gap-2"><i class="fas fa-check-circle text-success mt-1"></i><span><strong>Online + In-clinic</strong> sessions available</span></li>
                            <li class="d-flex align-items-start gap-2"><i class="fas fa-check-circle text-success mt-1"></i><span><strong>Personalised</strong> therapy plan for every child</span></li>
                        </ul>
                    </div>
                </div>
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4 text-center">
                        <div style="font-size:2rem;font-weight:800;color:#2D6A4F;">4.9★</div>
                        <div style="font-size:.82rem;color:#6B7280;">From 300+ parent reviews</div>
                        <div style="color:#F59E0B;font-size:1.1rem;margin:.5rem 0;">★★★★★</div>
                        <p style="font-size:.82rem;color:#374151;font-style:italic;">"My son started speaking full sentences within 3 months. Best decision we made."</p>
                        <p style="font-size:.75rem;color:#6B7280;">— Priya S., Delhi</p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm rounded-4" style="background:#25D366;">
                    <div class="card-body p-4 text-center text-white">
                        <i class="fab fa-whatsapp fs-3 mb-2"></i>
                        <p class="mb-2" style="font-size:.88rem;">Have a question before booking?</p>
                        <a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20want%20to%20know%20more%20before%20booking" target="_blank" rel="noopener" class="btn btn-light btn-sm rounded-pill fw-bold px-3" style="color:#25D366;">
                            Chat on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
                                        <option
                                            value="{{ $service->id }}"
                                            data-online-original="{{ $service->online_price }}"
                                            data-online-final="{{ $service->discounted_online_price }}"
                                            data-online-discount="{{ $service->online_discount }}"
                                            data-offline-original="{{ $service->offline_price }}"
                                            data-offline-final="{{ $service->discounted_offline_price }}"
                                            data-offline-discount="{{ $service->offline_discount }}"
                                            {{ old('service_id') == $service->id ? 'selected' : '' }}
                                        >
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
                                        <input class="form-check-input" type="radio" name="mode" id="mode_offline" value="offline" {{ old('mode', 'offline') === 'offline' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mode_offline">
                                            <strong>In-Clinic</strong> (Delhi NCR) - <span id="price_offline" class="text-success fw-bold">&#8377;0</span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mode" id="mode_online" value="online" {{ old('mode') === 'online' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mode_online">
                                            <strong>Online Video</strong> - <span id="price_online" class="text-success fw-bold">&#8377;0</span>
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
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm py-3" style="background: linear-gradient(135deg, #2D6A4F, #52B788); border: none; font-size:1.05rem;">
                                <i class="fas fa-calendar-check me-2"></i> Confirm My Booking
                            </button>
                            <small class="text-center text-muted mt-3"><i class="fas fa-lock me-1"></i> Your information is secure and confidential. We never share data.</small>
                        </div>
                        <div class="text-center mt-4" style="font-size:.85rem;color:#6B7280;">
                            Prefer to book by phone?
                            <a href="tel:+919334892585" class="text-decoration-none fw-bold" style="color:#2D6A4F;">Call +91 93348 92585</a>
                            &nbsp;or&nbsp;
                            <a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20want%20to%20book%20a%20session" target="_blank" rel="noopener" class="text-decoration-none fw-bold" style="color:#25D366;"><i class="fab fa-whatsapp"></i> WhatsApp us</a>
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
    const formatMoney = (value) => new Intl.NumberFormat('en-IN', {
        minimumFractionDigits: value % 1 === 0 ? 0 : 2,
        maximumFractionDigits: 2,
    }).format(value);

    function renderPrice(original, finalPrice, discount) {
        if (discount > 0) {
            return `<span class="text-muted text-decoration-line-through me-2">&#8377;${formatMoney(original)}</span><span class="text-success fw-bold">&#8377;${formatMoney(finalPrice)}</span>`;
        }

        return `<span class="text-success fw-bold">&#8377;${formatMoney(finalPrice)}</span>`;
    }

    function updatePrices() {
        const option = serviceSelect.options[serviceSelect.selectedIndex];
        if (option && option.value) {
            const offlineOriginal = parseFloat(option.getAttribute('data-offline-original')) || 0;
            const offlineFinal = parseFloat(option.getAttribute('data-offline-final')) || 0;
            const offlineDiscount = parseFloat(option.getAttribute('data-offline-discount')) || 0;
            const onlineOriginal = parseFloat(option.getAttribute('data-online-original')) || 0;
            const onlineFinal = parseFloat(option.getAttribute('data-online-final')) || 0;
            const onlineDiscount = parseFloat(option.getAttribute('data-online-discount')) || 0;

            priceOffline.innerHTML = renderPrice(offlineOriginal, offlineFinal, offlineDiscount);
            priceOnline.innerHTML = renderPrice(onlineOriginal, onlineFinal, onlineDiscount);
        } else {
            priceOffline.innerHTML = '&#8377;0';
            priceOnline.innerHTML = '&#8377;0';
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
            .catch(() => {
                slotsContainer.innerHTML = '<div class="text-danger small">Failed to load slots. Please refresh.</div>';
            });
    }

    serviceSelect.addEventListener('change', updatePrices);
    doctorSelect.addEventListener('change', fetchSlots);
    dateInput.addEventListener('change', fetchSlots);
    updatePrices();
});
</script>
@endsection
