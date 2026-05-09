<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout — JoinRoots</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Fraunces:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green:   #2d6a4f;
            --green-lt:#52b788;
            --orange:  #f4a261;
            --dark:    #1b1f2a;
            --muted:   #6b7280;
            --border:  #e5e7eb;
            --bg:      #f4f6f0;
        }
        body { font-family:'Inter',sans-serif; background:var(--bg); min-height:100vh; display:flex; flex-direction:column; }

        /* ── Topbar ── */
        .topbar { background:white; border-bottom:1px solid var(--border); padding:.9rem 2rem; display:flex; align-items:center; justify-content:space-between; }
        .brand { display:flex; align-items:center; gap:.7rem; text-decoration:none; }
        .brand-icon { width:36px; height:36px; background:var(--green); border-radius:10px; display:flex; align-items:center; justify-content:center; color:white; }
        .brand-name { font-weight:700; font-size:1.05rem; color:var(--dark); }
        .brand-name span { color:var(--green); }
        .secure-badge { display:flex; align-items:center; gap:.4rem; font-size:.78rem; color:var(--green); font-weight:600; background:rgba(45,106,79,.08); padding:.35rem .9rem; border-radius:50px; }

        /* ── Layout ── */
        .wrapper { flex:1; display:flex; align-items:flex-start; justify-content:center; padding:2rem 1rem 4rem; }
        .container { width:100%; max-width:940px; display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; }
        @media(max-width:660px) { .container { grid-template-columns:1fr; } }

        /* ── Cards ── */
        .card { background:white; border-radius:20px; padding:1.75rem; box-shadow:0 2px 20px rgba(0,0,0,.06); }

        /* ── Order summary ── */
        .summary-header { background:linear-gradient(135deg,var(--green),#40916c); border-radius:14px; padding:1.25rem 1.5rem; color:white; margin-bottom:1.25rem; }
        .summary-service { font-size:1.05rem; font-weight:700; }
        .summary-mode { font-size:.8rem; opacity:.82; margin-top:.3rem; display:flex; align-items:center; gap:.4rem; }
        .row { display:flex; justify-content:space-between; align-items:center; padding:.75rem 0; border-bottom:1px solid var(--border); font-size:.875rem; }
        .row:last-child { border-bottom:none; }
        .row-label { color:var(--muted); display:flex; align-items:center; gap:.45rem; }
        .row-label i { width:15px; color:var(--green-lt); }
        .row-value { font-weight:600; color:var(--dark); }
        .total-box { background:rgba(45,106,79,.06); border-radius:12px; padding:.9rem 1.25rem; display:flex; justify-content:space-between; align-items:center; margin-top:.75rem; }
        .total-label { font-weight:700; color:var(--dark); }
        .total-amount { font-size:1.55rem; font-weight:800; color:var(--green); font-family:'Fraunces',serif; }
        .trust-row { display:flex; flex-wrap:wrap; gap:.6rem; margin-top:1.25rem; }
        .trust-item { display:flex; align-items:center; gap:.35rem; font-size:.7rem; color:var(--muted); }
        .trust-item i { color:var(--green-lt); }

        /* ── Steps ── */
        .steps { display:flex; align-items:center; gap:.5rem; margin-bottom:1.5rem; }
        .step-dot { width:24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.65rem; font-weight:700; flex-shrink:0; }
        .step-dot.done   { background:var(--green); color:white; }
        .step-dot.active { background:var(--orange); color:white; }
        .step-dot.wait   { background:var(--border); color:var(--muted); }
        .step-label { font-size:.75rem; color:var(--muted); font-weight:500; }
        .step-label.active { color:var(--dark); font-weight:700; }
        .step-line { flex:1; height:1px; background:var(--border); }

        /* ── Info box ── */
        .info-box { background:rgba(82,183,136,.1); border-left:3px solid var(--green-lt); border-radius:8px; padding:.85rem 1rem; font-size:.82rem; color:#1b4332; margin-bottom:1.25rem; line-height:1.55; }
        .info-box i { color:var(--green); margin-right:.4rem; }

        /* ── Divider ── */
        .divider { display:flex; align-items:center; gap:.75rem; margin:1.5rem 0; }
        .divider-line { flex:1; height:1px; background:var(--border); }
        .divider-text { font-size:.72rem; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:.06em; white-space:nowrap; }

        /* ── Pay buttons ── */
        .btn-pay-primary {
            width:100%; background:linear-gradient(135deg,#f4a261,#e76f51);
            color:white; border:none; padding:1rem 2rem; border-radius:14px;
            font-size:1rem; font-weight:700; cursor:pointer;
            display:flex; align-items:center; justify-content:center; gap:.65rem;
            transition:all .25s; box-shadow:0 6px 20px rgba(244,162,97,.35);
        }
        .btn-pay-primary:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(244,162,97,.45); }
        .btn-pay-primary:disabled { opacity:.6; cursor:not-allowed; transform:none; }

        .btn-pay-link {
            width:100%; background:white; color:var(--green);
            border:2px solid var(--green); padding:.9rem 2rem; border-radius:14px;
            font-size:.92rem; font-weight:700; cursor:pointer;
            display:flex; align-items:center; justify-content:center; gap:.65rem;
            transition:all .25s; text-decoration:none; margin-top:.75rem;
        }
        .btn-pay-link:hover { background:rgba(45,106,79,.06); transform:translateY(-1px); }

        .secure-note { display:flex; align-items:center; justify-content:center; gap:.45rem; font-size:.75rem; color:var(--muted); margin-top:.9rem; }
        .rzp-logo { display:flex; align-items:center; justify-content:center; gap:.4rem; margin-top:.75rem; opacity:.5; font-size:.72rem; color:var(--muted); }

        /* ── Spinner ── */
        #pay-spinner { display:none; }
        .spinner { width:18px; height:18px; border:2.5px solid rgba(255,255,255,.4); border-top-color:white; border-radius:50%; animation:spin .7s linear infinite; }
        @keyframes spin { to { transform:rotate(360deg); } }

        /* ── Method badge ── */
        .method-badge { display:inline-flex; align-items:center; gap:.35rem; font-size:.7rem; font-weight:700; padding:.25rem .7rem; border-radius:50px; margin-bottom:.85rem; }
        .badge-primary { background:#FEF3C7; color:#92400E; }
        .badge-link    { background:#DBEAFE; color:#1D4ED8; }
    </style>
</head>
<body>

{{-- Topbar --}}
<div class="topbar">
    <a href="{{ url('/') }}" class="brand">
        <div class="brand-icon"><i class="fas fa-seedling"></i></div>
        <div class="brand-name">Join <span>Roots</span></div>
    </a>
    <div class="secure-badge"><i class="fas fa-shield-alt"></i> 256-bit SSL Secured</div>
</div>

<div class="wrapper">
    <div class="container">

        {{-- ── Left: Order Summary ── --}}
        <div class="card">
            <div style="font-size:.78rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:.9rem;">
                <i class="fas fa-receipt" style="color:var(--green);margin-right:.35rem;"></i>Order Summary
            </div>

            <div class="summary-header">
                <div class="summary-service">{{ $appointment->service->title }}</div>
                <div class="summary-mode">
                    <i class="fas fa-{{ $appointment->mode === 'online' ? 'video' : 'clinic-medical' }}"></i>
                    {{ ucfirst($appointment->mode) }} Session
                </div>
            </div>

            <div class="row">
                <div class="row-label"><i class="fas fa-calendar-alt"></i> Date</div>
                <div class="row-value">{{ \Carbon\Carbon::parse($appointment->start_datetime)->format('d M Y') }}</div>
            </div>
            <div class="row">
                <div class="row-label"><i class="fas fa-clock"></i> Time</div>
                <div class="row-value">{{ \Carbon\Carbon::parse($appointment->start_datetime)->format('h:i A') }}</div>
            </div>
            @if($appointment->doctor)
            <div class="row">
                <div class="row-label"><i class="fas fa-user-md"></i> Therapist</div>
                <div class="row-value">{{ $appointment->doctor->name }}</div>
            </div>
            @endif
            <div class="row">
                <div class="row-label"><i class="fas fa-hourglass-half"></i> Duration</div>
                <div class="row-value">{{ $appointment->duration_minutes ?? 60 }} min</div>
            </div>
            @if($appointment->mode === 'online')
            <div class="row">
                <div class="row-label"><i class="fas fa-link"></i> Meet Link</div>
                <div class="row-value" style="font-size:.78rem;color:var(--green);">Sent after payment</div>
            </div>
            @endif
            <div class="row">
                <div class="row-label"><i class="fas fa-tag"></i> Session Fee</div>
                <div class="row-value">
                    @if($discountAmount > 0)
                        <span style="text-decoration:line-through;color:var(--muted);margin-right:.4rem;font-weight:400;">
                            &#8377;{{ number_format($originalAmount, 0) }}
                        </span>
                    @endif
                    &#8377;{{ number_format($amount, 0) }}
                </div>
            </div>
            @if($discountAmount > 0)
            <div class="row">
                <div class="row-label"><i class="fas fa-percent"></i> Discount</div>
                <div class="row-value" style="color:var(--green);">− &#8377;{{ number_format($discountAmount, 0) }}</div>
            </div>
            @endif

            <div class="total-box">
                <div class="total-label">Total Payable</div>
                <div class="total-amount">&#8377;{{ number_format($amount, 0) }}</div>
            </div>

            <div class="trust-row">
                <span class="trust-item"><i class="fas fa-shield-alt"></i> Secure</span>
                <span class="trust-item"><i class="fas fa-undo"></i> Refund Policy</span>
                <span class="trust-item"><i class="fas fa-certificate"></i> Govt. Registered</span>
                <span class="trust-item"><i class="fas fa-lock"></i> Encrypted</span>
            </div>
        </div>

        {{-- ── Right: Payment Methods ── --}}
        <div class="card">

            {{-- Step indicator --}}
            <div class="steps">
                <div class="step-dot done"><i class="fas fa-check" style="font-size:.55rem;"></i></div>
                <span class="step-label">Booked</span>
                <div class="step-line"></div>
                <div class="step-dot active">2</div>
                <span class="step-label active">Payment</span>
                <div class="step-line"></div>
                <div class="step-dot wait">3</div>
                <span class="step-label">Confirmed</span>
            </div>

            {{-- Patient details --}}
            <div style="margin-bottom:1.25rem;">
                <div class="row" style="padding:.5rem 0;">
                    <div class="row-label"><i class="fas fa-user"></i> Name</div>
                    <div class="row-value">{{ auth()->user()->name }}</div>
                </div>
                <div class="row" style="padding:.5rem 0;">
                    <div class="row-label"><i class="fas fa-envelope"></i> Email</div>
                    <div class="row-value" style="font-size:.8rem;">{{ auth()->user()->email }}</div>
                </div>
                @if(auth()->user()->phone)
                <div class="row" style="padding:.5rem 0;">
                    <div class="row-label"><i class="fas fa-phone"></i> Phone</div>
                    <div class="row-value">{{ auth()->user()->phone }}</div>
                </div>
                @endif
            </div>

            <div class="info-box">
                <i class="fas fa-check-circle"></i>
                You'll receive an <strong>email confirmation</strong> + <strong>meeting link</strong> instantly after payment.
            </div>

            {{-- ── METHOD 1: Razorpay Standard Checkout ── --}}
            <div class="method-badge badge-primary">
                <i class="fas fa-star"></i> Recommended
            </div>

            <form id="rzp-form" action="{{ route('payment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="appointment_id"      value="{{ $appointment->id }}">
                <input type="hidden" name="razorpay_payment_id" id="rzp_payment_id">
                <input type="hidden" name="razorpay_order_id"   id="rzp_order_id"   value="{{ $razorpayOrder['id'] }}">
                <input type="hidden" name="razorpay_signature"  id="rzp_signature">
            </form>

            <button id="rzp-btn" class="btn-pay-primary" onclick="openRazorpay()">
                <span id="pay-text">
                    <i class="fas fa-lock"></i>
                    Pay &#8377;{{ number_format($amount, 0) }} via Card / UPI / NetBanking
                </span>
                <span id="pay-spinner"><div class="spinner"></div> Processing…</span>
            </button>

            {{-- ── Divider ── --}}
            <div class="divider">
                <div class="divider-line"></div>
                <div class="divider-text">or pay via link</div>
                <div class="divider-line"></div>
            </div>

            {{-- ── METHOD 2: Razorpay Payment Link ── --}}
            <div class="method-badge badge-link">
                <i class="fas fa-link"></i> Payment Link
            </div>

            @if(!empty($paymentLink) && !empty($paymentLink['short_url']))
                <a href="{{ $paymentLink['short_url'] }}" target="_blank" class="btn-pay-link" id="link-btn">
                    <i class="fas fa-external-link-alt"></i>
                    Open Razorpay Payment Page
                </a>
                <p style="font-size:.72rem;color:var(--muted);text-align:center;margin-top:.6rem;line-height:1.5;">
                    Opens a Razorpay-hosted page. Your booking is automatically confirmed after payment.
                </p>
            @else
                {{-- Fallback to the static payment link --}}
                <a href="https://rzp.io/rzp/xNn5lQmL" target="_blank" class="btn-pay-link" id="link-btn">
                    <i class="fas fa-external-link-alt"></i>
                    Pay &#8377;{{ number_format($amount, 0) }} via Razorpay Page
                </a>
                <p style="font-size:.72rem;color:var(--muted);text-align:center;margin-top:.6rem;line-height:1.5;">
                    After payment, WhatsApp us your transaction ID at
                    <a href="https://wa.me/919334892585" style="color:#25D366;font-weight:600;">+91 93348 92585</a>
                    to confirm your booking instantly.
                </p>
            @endif

            <div class="secure-note">
                <i class="fas fa-shield-alt" style="color:var(--green-lt);"></i>
                Secured by Razorpay &nbsp;·&nbsp; 256-bit SSL Encryption
            </div>
            <div class="rzp-logo">
                Powered by <strong style="margin-left:.3rem;">Razorpay</strong>
                <i class="fas fa-lock" style="font-size:.6rem;margin-left:.3rem;"></i>
            </div>
        </div>

    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var rzpOptions = {
        key:         "{{ $razorpayKey }}",
        amount:      "{{ (int) round($amount * 100) }}",
        currency:    "INR",
        name:        "JoinRoots",
        description: "{{ $appointment->service->title }} — {{ ucfirst($appointment->mode) }} Session",
        image:       "https://ui-avatars.com/api/?name=JR&background=2d6a4f&color=fff&size=120&bold=true",
        order_id:    "{{ $razorpayOrder['id'] }}",
        handler: function (response) {
            document.getElementById('rzp-btn').disabled = true;
            document.getElementById('pay-text').style.display   = 'none';
            document.getElementById('pay-spinner').style.display = 'flex';
            document.getElementById('rzp_payment_id').value = response.razorpay_payment_id;
            document.getElementById('rzp_order_id').value   = response.razorpay_order_id;
            document.getElementById('rzp_signature').value  = response.razorpay_signature;
            document.getElementById('rzp-form').submit();
        },
        prefill: {
            name:    "{{ auth()->user()->name }}",
            email:   "{{ auth()->user()->email }}",
            contact: "{{ auth()->user()->phone ?? '' }}"
        },
        notes: {
            appointment_id: "{{ $appointment->id }}",
            service:        "{{ $appointment->service->title }}"
        },
        theme: { color: "#2d6a4f" },
        modal: {
            backdropclose: false,
            escape:        false,
            ondismiss: function () {
                document.getElementById('rzp-btn').disabled = false;
            }
        }
    };

    function openRazorpay() {
        var rzp = new Razorpay(rzpOptions);
        rzp.on('payment.failed', function (response) {
            alert('Payment failed: ' + response.error.description + '\n\nPlease try again or use the Payment Link option below.');
        });
        rzp.open();
    }

    // Warn before leaving page if payment in progress
    var paymentStarted = false;
    document.getElementById('rzp-btn').addEventListener('click', function() {
        paymentStarted = true;
    });
    window.addEventListener('beforeunload', function(e) {
        if (paymentStarted) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
</script>
</body>
</html>
