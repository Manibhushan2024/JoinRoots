<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment — JoinRoots</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fraunces:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #2d6a4f;
            --primary-lt: #52b788;
            --accent: #f4a261;
            --dark: #1b1f2a;
            --muted: #6b7280;
            --border: rgba(0,0,0,.08);
            --bg: #f4f6f0;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Top Bar */
        .topbar {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand { display: flex; align-items: center; gap: .75rem; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem; }
        .brand-name { font-weight: 700; font-size: 1.1rem; color: var(--dark); }
        .brand-name span { color: var(--primary); }
        .secure-badge { display: flex; align-items: center; gap: .5rem; font-size: .8rem; color: var(--primary); font-weight: 600; background: rgba(45,106,79,.08); padding: .4rem .9rem; border-radius: 50px; }

        /* Main Layout */
        .payment-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1rem;
        }
        .payment-container {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        @media(max-width: 640px) {
            .payment-container { grid-template-columns: 1fr; }
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }
        .card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .card-title i { color: var(--primary); }

        /* Summary */
        .summary-header {
            background: linear-gradient(135deg, var(--primary), #40916c);
            border-radius: 14px;
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
        }
        .summary-service { font-size: 1.1rem; font-weight: 700; margin-bottom: .25rem; }
        .summary-mode { font-size: .82rem; opacity: .85; display: flex; align-items: center; gap: .4rem; }
        .summary-rows { display: flex; flex-direction: column; gap: .85rem; }
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: .85rem 0;
            border-bottom: 1px solid var(--border);
            font-size: .88rem;
        }
        .summary-row:last-child { border-bottom: none; }
        .summary-label { color: var(--muted); display: flex; align-items: center; gap: .5rem; }
        .summary-label i { width: 16px; color: var(--primary-lt); }
        .summary-value { font-weight: 600; color: var(--dark); }
        .total-row {
            background: rgba(45,106,79,.05);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: .5rem;
        }
        .total-label { font-weight: 700; color: var(--dark); }
        .total-amount { font-size: 1.6rem; font-weight: 800; color: var(--primary); font-family: 'Fraunces', serif; }

        /* Trust badges */
        .trust-badges {
            display: flex;
            gap: .75rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }
        .badge-item {
            display: flex;
            align-items: center;
            gap: .4rem;
            font-size: .72rem;
            color: var(--muted);
            font-weight: 500;
        }
        .badge-item i { color: var(--primary-lt); }

        /* Payment Right */
        .step-indicator {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 1.5rem;
        }
        .step { display: flex; align-items: center; gap: .4rem; font-size: .78rem; }
        .step-dot { width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .65rem; font-weight: 700; }
        .step-dot.done { background: var(--primary); color: white; }
        .step-dot.active { background: var(--accent); color: white; }
        .step-dot.pending { background: var(--border); color: var(--muted); }
        .step-label { color: var(--muted); font-weight: 500; }
        .step-label.active { color: var(--dark); font-weight: 700; }
        .step-line { flex: 1; height: 1px; background: var(--border); }

        .pay-btn {
            width: 100%;
            background: linear-gradient(135deg, #f4a261, #e76f51);
            color: white;
            border: none;
            padding: 1.1rem 2rem;
            border-radius: 14px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .75rem;
            transition: all .25s ease;
            box-shadow: 0 6px 20px rgba(244,162,97,.35);
            margin-top: 1.5rem;
        }
        .pay-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(244,162,97,.45); }
        .pay-btn:active { transform: translateY(0); }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            font-size: .78rem;
            color: var(--muted);
            margin-top: 1rem;
        }
        .razorpay-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            margin-top: 1.25rem;
            opacity: .6;
            font-size: .75rem;
            color: var(--muted);
        }

        .info-box {
            background: rgba(82,183,136,.1);
            border-left: 3px solid var(--primary-lt);
            border-radius: 8px;
            padding: .85rem 1rem;
            font-size: .82rem;
            color: #1b4332;
            margin-bottom: 1.25rem;
        }
        .info-box i { color: var(--primary); margin-right: .4rem; }
    </style>
</head>
<body>

<!-- Top bar -->
<div class="topbar">
    <a href="/" class="brand">
        <div class="brand-icon"><i class="fas fa-seedling"></i></div>
        <div class="brand-name">Connect <span>Roots</span></div>
    </a>
    <div class="secure-badge">
        <i class="fas fa-shield-alt"></i> 256-bit SSL Encrypted Checkout
    </div>
</div>

<div class="payment-wrapper">
    <div class="payment-container">

        <!-- LEFT: Order Summary -->
        <div class="card">
            <div class="card-title"><i class="fas fa-receipt"></i> Order Summary</div>

            <div class="summary-header">
                <div class="summary-service">{{ $appointment->service->title }}</div>
                <div class="summary-mode">
                    <i class="fas fa-{{ $appointment->mode == 'online' ? 'video' : 'clinic-medical' }}"></i>
                    {{ ucfirst($appointment->mode) }} Session
                </div>
            </div>

            <div class="summary-rows">
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-calendar-alt"></i> Date</div>
                    <div class="summary-value">{{ \Carbon\Carbon::parse($appointment->start_datetime)->format('d M Y') }}</div>
                </div>
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-clock"></i> Time</div>
                    <div class="summary-value">{{ \Carbon\Carbon::parse($appointment->start_datetime)->format('h:i A') }}</div>
                </div>
                @if($appointment->doctor)
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-user-md"></i> Specialist</div>
                    <div class="summary-value">{{ $appointment->doctor->name }}</div>
                </div>
                @endif
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-hourglass-half"></i> Duration</div>
                    <div class="summary-value">{{ $appointment->duration_minutes ?? 60 }} Minutes</div>
                </div>
                @if($appointment->mode == 'online')
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-link"></i> Meet Link</div>
                    <div class="summary-value" style="font-size:.78rem;color:var(--primary);">Sent after payment</div>
                </div>
                @endif
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-tag"></i> Session Fee</div>
                    <div class="summary-value">₹{{ number_format($amount, 0) }}</div>
                </div>
            </div>

            <div class="total-row">
                <div class="total-label">Total Payable</div>
                <div class="total-amount">₹{{ number_format($amount, 0) }}</div>
            </div>

            <div class="trust-badges">
                <span class="badge-item"><i class="fas fa-shield-alt"></i> Secure Payment</span>
                <span class="badge-item"><i class="fas fa-undo"></i> Refund Policy</span>
                <span class="badge-item"><i class="fas fa-certificate"></i> Govt. Registered</span>
                <span class="badge-item"><i class="fas fa-headset"></i> 24/7 Support</span>
            </div>
        </div>

        <!-- RIGHT: Payment -->
        <div class="card">
            <div class="step-indicator">
                <div class="step">
                    <div class="step-dot done"><i class="fas fa-check" style="font-size:.55rem;"></i></div>
                    <span class="step-label">Booked</span>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-dot active">2</div>
                    <span class="step-label active">Payment</span>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-dot pending">3</div>
                    <span class="step-label">Confirmed</span>
                </div>
            </div>

            <div class="card-title"><i class="fas fa-credit-card"></i> Complete Payment</div>

            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                You'll receive an <strong>email confirmation</strong> and <strong>WhatsApp message</strong> instantly after payment.
            </div>

            <div class="summary-rows">
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-user"></i> Name</div>
                    <div class="summary-value">{{ auth()->user()->name }}</div>
                </div>
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-envelope"></i> Email</div>
                    <div class="summary-value" style="font-size:.82rem;">{{ auth()->user()->email }}</div>
                </div>
                @if(auth()->user()->phone)
                <div class="summary-row">
                    <div class="summary-label"><i class="fas fa-phone"></i> Phone</div>
                    <div class="summary-value">{{ auth()->user()->phone }}</div>
                </div>
                @endif
            </div>

            {{-- Razorpay Form --}}
            <form id="razorpay-form" action="{{ route('payment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $razorpayOrder['id'] }}">
                <input type="hidden" name="razorpay_signature" id="razorpay_signature">
            </form>

            <button id="rzp-button" class="pay-btn">
                <i class="fas fa-lock"></i>
                Pay ₹{{ number_format($amount, 0) }} Securely
            </button>

            <div class="secure-note">
                <i class="fas fa-shield-alt" style="color:var(--primary-lt);"></i>
                Your payment is fully secured by Razorpay
            </div>

            <div class="razorpay-logo">
                Powered by <strong style="margin-left:.3rem;">Razorpay</strong>
                <i class="fas fa-lock" style="margin-left:.3rem;font-size:.65rem;"></i>
            </div>
        </div>

    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $razorpayKey }}",
        "amount": "{{ $amount * 100 }}",
        "currency": "INR",
        "name": "JoinRoots",
        "description": "{{ $appointment->service->title }} - {{ ucfirst($appointment->mode) }} Session",
        "image": "https://ui-avatars.com/api/?name=Connect+Roots&background=2d6a4f&color=fff&size=120",
        "order_id": "{{ $razorpayOrder['id'] }}",
        "handler": function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value  = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value  = response.razorpay_signature;
            document.getElementById('razorpay-form').submit();
        },
        "prefill": {
            "name":    "{{ auth()->user()->name }}",
            "email":   "{{ auth()->user()->email }}",
            "contact": "{{ auth()->user()->phone ?? '' }}"
        },
        "notes": {
            "appointment_id": "{{ $appointment->id }}",
            "service": "{{ $appointment->service->title }}"
        },
        "theme": {
            "color": "#2d6a4f"
        },
        "modal": {
            "ondismiss": function() {
                // User closed Razorpay without paying — do nothing
            }
        }
    };

    var rzp = new Razorpay(options);

    document.getElementById('rzp-button').onclick = function (e) {
        e.preventDefault();
        rzp.open();
    };
</script>
</body>
</html>
