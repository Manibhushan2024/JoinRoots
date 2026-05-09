<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JoinRoots | Best Speech Therapy & Child Rehabilitation in Delhi | Vikaspuri</title>
    <meta name="description" content="Delhi's trusted speech therapy & child rehabilitation center in Vikaspuri. RCI-certified therapists for Autism, Speech Delay, ADHD, Cerebral Palsy & special needs children. Book online or in-clinic. Govt. Registered.">
    <meta name="keywords" content="speech therapy Delhi, speech therapist Vikaspuri, autism therapy Delhi, child rehabilitation Delhi, speech delay treatment Delhi, ADHD therapy Delhi, special needs child Delhi, occupational therapy Delhi, RCI certified therapist Delhi, best speech therapy West Delhi">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">
    <!-- Open Graph -->
    <meta property="og:title" content="JoinRoots | Best Speech Therapy & Child Rehabilitation in Delhi">
    <meta property="og:description" content="Delhi's trusted speech therapy & child rehabilitation center. RCI-certified therapists for Autism, Speech Delay, ADHD & special needs children in Vikaspuri, New Delhi.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/hero_therapy_image.png') }}">
    <!-- Schema.org Local Business -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "MedicalOrganization",
      "name": "JoinRoots Child Rehabilitation & Therapy Center",
      "url": "{{ url('/') }}",
      "telephone": "+919334892585",
      "email": "connnectingroots.support@gmail.com",
      "description": "Delhi's trusted speech therapy & child rehabilitation center for autism, speech delay, ADHD and special needs children.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "KG-2/46 G.F, near U.K Nursing Home",
        "addressLocality": "Vikaspuri",
        "addressRegion": "New Delhi",
        "postalCode": "110018",
        "addressCountry": "IN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "28.6386",
        "longitude": "77.0689"
      },
      "openingHours": "Mo-Sa 09:00-18:00",
      "priceRange": "₹₹",
      "medicalSpecialty": ["Speech Therapy", "Occupational Therapy", "Behavioral Therapy"]
    }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Fraunces:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:    #2D6A4F;
            --primary-lt: #52B788;
            --accent:     #F4A261;
            --accent-lt:  #FFD3A5;
            --dark:       #1B2B25;
            --text:       #374151;
            --muted:      #6B7280;
            --bg:         #F9FAF8;
            --white:      #FFFFFF;
            --card-bg:    #FFFFFF;
            --border:     #E5E7EB;
            --radius:     16px;
            --shadow-sm:  0 2px 8px rgba(0,0,0,.06);
            --shadow-md:  0 8px 32px rgba(0,0,0,.10);
            --shadow-lg:  0 24px 64px rgba(0,0,0,.14);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        /* ── Navbar ───────────────────────────────────── */
        .navbar {
            position: sticky; top: 0; left: 0; right: 0; z-index: 1000;
            background: rgba(255,255,255,.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 70px;
            transition: box-shadow .3s;
        }
        .navbar.scrolled { box-shadow: var(--shadow-md); }

        .brand { display: flex; align-items: center; gap: .7rem; text-decoration: none; }
        .brand-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--primary-lt));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.1rem;
        }
        .brand-name { font-family: 'Fraunces', serif; font-size: 1.25rem; font-weight: 700; color: var(--dark); }
        .brand-name span { color: var(--primary); }

        .nav-links { display: flex; align-items: center; gap: 2rem; list-style: none; }
        .nav-links a { text-decoration: none; color: var(--text); font-weight: 500; font-size: .9rem; transition: color .2s; }
        .nav-links a:hover { color: var(--primary); }

        .nav-actions { display: flex; align-items: center; gap: .75rem; }
        .btn { display: inline-flex; align-items: center; gap: .4rem; padding: .6rem 1.4rem; border-radius: 50px; font-weight: 600; font-size: .875rem; text-decoration: none; transition: all .2s; cursor: pointer; border: none; }
        .btn-ghost { background: transparent; color: var(--primary); border: 1.5px solid var(--primary); }
        .btn-ghost:hover { background: var(--primary); color: white; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-lt)); color: white; box-shadow: 0 4px 15px rgba(45,106,79,.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(45,106,79,.4); }
        .btn-accent { background: linear-gradient(135deg, var(--accent), #E76F51); color: white; box-shadow: 0 4px 15px rgba(244,162,97,.35); }
        .btn-accent:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(244,162,97,.45); }
        .btn-lg { padding: .85rem 2rem; font-size: 1rem; }

        .hamburger { display: none; font-size: 1.4rem; color: var(--dark); background: none; border: none; cursor: pointer; }

        /* ── Hero ─────────────────────────────────────── */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center;
            padding: 90px 2rem 4rem;
            background: linear-gradient(155deg, #EAF5EE 0%, #F9FAF8 55%, #FFF4E6 100%);
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 600px 600px at 90% 20%, rgba(82,183,136,.12), transparent),
                radial-gradient(ellipse 400px 400px at 10% 80%, rgba(244,162,97,.10), transparent);
            pointer-events: none;
        }
        .hero-inner { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; position: relative; }
        .hero-tag {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(45,106,79,.1); color: var(--primary);
            padding: .35rem 1rem; border-radius: 50px;
            font-size: .8rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase;
            margin-bottom: 1.25rem;
        }
        .hero-tag i { font-size: .75rem; }
        .hero h1 { font-family: 'Fraunces', serif; font-size: clamp(2.2rem, 4.5vw, 3.4rem); font-weight: 700; color: var(--dark); line-height: 1.2; margin-bottom: 1.25rem; }
        .hero h1 em { color: var(--primary); font-style: normal; }
        .hero p { font-size: 1.05rem; color: var(--muted); max-width: 480px; margin-bottom: 2rem; line-height: 1.7; }
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2.5rem; }
        .hero-stats { display: flex; gap: 2rem; flex-wrap: wrap; }
        .stat { }
        .stat-num { font-size: 1.5rem; font-weight: 800; color: var(--dark); }
        .stat-label { font-size: .8rem; color: var(--muted); }

        .hero-visual { position: relative; }
        .hero-card-main {
            background: white; border-radius: 24px; padding: 2rem;
            box-shadow: var(--shadow-lg);
            position: relative; z-index: 2;
        }
        .hc-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
        .hc-avatar {
            width: 52px; height: 52px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-lt));
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.3rem;
        }
        .hc-name { font-weight: 700; color: var(--dark); }
        .hc-role { font-size: .8rem; color: var(--muted); }
        .hc-badge { margin-left: auto; background: #DCFCE7; color: #16A34A; padding: .25rem .75rem; border-radius: 50px; font-size: .75rem; font-weight: 600; }
        .hc-services { display: flex; flex-direction: column; gap: .75rem; }
        .hc-service {
            display: flex; align-items: center; gap: .75rem;
            padding: .75rem 1rem; background: var(--bg); border-radius: 12px;
            font-size: .875rem; font-weight: 500; cursor: pointer;
            transition: all .2s;
        }
        .hc-service:hover { background: #EAF5EE; transform: translateX(4px); }
        .hc-service-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: .9rem; flex-shrink: 0; }
        .hc-service .price { margin-left: auto; color: var(--primary); font-weight: 700; }

        .floating-card {
            position: absolute; background: white; border-radius: 16px;
            padding: 1rem 1.25rem; box-shadow: var(--shadow-md);
            display: flex; align-items: center; gap: .75rem; z-index: 3;
            animation: float 4s ease-in-out infinite;
        }
        .floating-card.fc-1 { top: -30px; right: -20px; animation-delay: 0s; }
        .floating-card.fc-2 { bottom: -20px; left: -30px; animation-delay: 2s; }
        .fc-icon { width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; }
        .fc-text { font-size: .8rem; }
        .fc-title { font-weight: 700; color: var(--dark); }
        .fc-sub { color: var(--muted); font-size: .73rem; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }

        /* ── Sections shared ──────────────────────────── */
        section { padding: 6rem 2rem; }
        .container { max-width: 1200px; margin: 0 auto; }
        .section-tag { display: inline-block; background: rgba(45,106,79,.1); color: var(--primary); padding: .3rem .9rem; border-radius: 50px; font-size: .78rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase; margin-bottom: .75rem; }
        .section-title { font-family: 'Fraunces', serif; font-size: clamp(1.7rem, 3vw, 2.4rem); font-weight: 700; color: var(--dark); line-height: 1.25; margin-bottom: 1rem; }
        .section-subtitle { color: var(--muted); font-size: 1rem; max-width: 580px; line-height: 1.7; }
        .section-header { margin-bottom: 3rem; }
        .section-header.center { text-align: center; }
        .section-header.center .section-subtitle { margin: 0 auto; }

        /* ── Services ─────────────────────────────────── */
        .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        @media(max-width:960px){ .services-grid { grid-template-columns: repeat(2,1fr); } }
        @media(max-width:600px){ .services-grid { grid-template-columns: 1fr; } }
        .service-card {
            background: var(--card-bg); border-radius: var(--radius);
            border: 1px solid var(--border); transition: all .3s;
            position: relative; overflow: hidden;
            display: flex; flex-direction: column;
        }
        .service-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-lt));
            transform: scaleX(0); transform-origin: left; transition: transform .3s;
        }
        .service-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); border-color: transparent; }
        .service-card:hover::before { transform: scaleX(1); }
        .service-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.25rem; }
        .service-card h3 { font-size: 1.1rem; font-weight: 700; color: var(--dark); margin-bottom: .5rem; }
        .service-card p { font-size: .875rem; color: var(--muted); line-height: 1.6; margin-bottom: 1.25rem; }
        .service-price { display: flex; justify-content: space-between; align-items: center; }
        .price-range { font-size: .8rem; color: var(--muted); }
        .price-amount { font-weight: 700; color: var(--primary); font-size: .95rem; }

        /* ── Why Us ───────────────────────────────────── */
        .why-section { background: linear-gradient(135deg, var(--dark) 0%, #243B33 100%); }
        .why-section .section-title { color: white; }
        .why-section .section-subtitle { color: rgba(255,255,255,.65); }
        .why-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.5rem; }
        @media(max-width:900px){ .why-grid { grid-template-columns: repeat(2,1fr); } }
        @media(max-width:600px){ .why-grid { grid-template-columns: 1fr; } }
        .why-card {
            background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
            border-radius: var(--radius); padding: 2rem;
            transition: all .3s;
        }
        .why-card:hover { background: rgba(82,183,136,.12); border-color: rgba(82,183,136,.3); transform: translateY(-4px); }
        .why-icon { width: 52px; height: 52px; background: rgba(82,183,136,.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: var(--primary-lt); margin-bottom: 1.25rem; }
        .why-card h3 { font-size: 1rem; font-weight: 700; color: white; margin-bottom: .5rem; }
        .why-card p { font-size: .875rem; color: rgba(255,255,255,.6); line-height: 1.6; }

        /* ── How It Works ─────────────────────────────── */
        .steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2rem; position: relative; }
        .step { text-align: center; }
        .step-num {
            width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 1.25rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-lt));
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; font-weight: 800; color: white;
            box-shadow: 0 8px 20px rgba(45,106,79,.3);
        }
        .step h3 { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: .5rem; }
        .step p { font-size: .875rem; color: var(--muted); line-height: 1.6; }

        /* ── Testimonials ─────────────────────────────── */
        .testimonials-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
        .testimonial-card {
            background: white; border-radius: var(--radius); padding: 2rem;
            border: 1px solid var(--border); transition: box-shadow .3s;
        }
        .testimonial-card:hover { box-shadow: var(--shadow-md); }
        .stars { color: #F59E0B; margin-bottom: 1rem; font-size: .9rem; }
        .testimonial-text { font-size: .9rem; color: var(--text); line-height: 1.7; margin-bottom: 1.5rem; font-style: italic; }
        .testimonial-author { display: flex; align-items: center; gap: .75rem; }
        .author-avatar { width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem; color: white; font-weight: 700; flex-shrink: 0; }
        .author-name { font-weight: 700; color: var(--dark); font-size: .9rem; }
        .author-role { font-size: .78rem; color: var(--muted); }

        /* ── CTA ──────────────────────────────────────── */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, #1B4332 100%);
            text-align: center; padding: 5rem 2rem;
        }
        .cta-section h2 { font-family: 'Fraunces', serif; font-size: clamp(1.8rem, 3.5vw, 2.8rem); color: white; margin-bottom: 1rem; }
        .cta-section p { color: rgba(255,255,255,.75); font-size: 1.05rem; max-width: 520px; margin: 0 auto 2.5rem; line-height: 1.7; }
        .cta-buttons { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

        /* ── Footer ───────────────────────────────────── */
        footer {
            background: var(--dark); color: rgba(255,255,255,.7);
            padding: 4rem 2rem 2rem;
        }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; }
        .footer-col h4 { color: white; font-weight: 700; margin-bottom: 1rem; font-size: .95rem; }
        .footer-col p { font-size: .875rem; line-height: 1.7; }
        .footer-links { list-style: none; display: flex; flex-direction: column; gap: .5rem; }
        .footer-links a { color: rgba(255,255,255,.6); text-decoration: none; font-size: .875rem; transition: color .2s; }
        .footer-links a:hover { color: var(--primary-lt); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.1); padding-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .footer-bottom p { font-size: .8rem; }
        .social-links { display: flex; gap: .75rem; }
        .social-link { width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.08); display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,.6); text-decoration: none; transition: all .2s; font-size: .9rem; }
        .social-link:hover { background: var(--primary); color: white; }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 900px) {
            .hero-inner { grid-template-columns: 1fr; gap: 3rem; }
            .hero-visual { order: -1; max-width: 480px; margin: 0 auto; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .nav-links { display: none; }
            .hamburger { display: block; }
        }
        @media (max-width: 600px) {
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .hero-stats { gap: 1.5rem; }
        }

        /* ── Animations ───────────────────────────────── */
        @keyframes fadeUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp .7s ease both; }
        .fade-up-d1 { animation-delay:.1s; }
        .fade-up-d2 { animation-delay:.2s; }
        .fade-up-d3 { animation-delay:.3s; }

        /* color helpers */
        .bg-green-soft { background: #DCFCE7; } .c-green { color: #16A34A; }
        .bg-blue-soft  { background: #DBEAFE; } .c-blue  { color: #2563EB; }
        .bg-purple-soft{ background: #EDE9FE; } .c-purple{ color: #7C3AED; }
        .bg-orange-soft{ background: #FEF3C7; } .c-orange{ color: #D97706; }
        .bg-rose-soft  { background: #FFE4E6; } .c-rose  { color: #E11D48; }
        .bg-teal-soft  { background: #CCFBF1; } .c-teal  { color: #0D9488; }
        .bg-indigo-soft{ background: #E0E7FF; } .c-indigo{ color: #4338CA; }
        .bg-av1 { background: #2D6A4F; } .bg-av2 { background: #F4A261; }
        .bg-av3 { background: #7C3AED; }
    </style>
</head>
<body>

<!-- ── Top Urgency Bar ───────────────────────────────────── -->
<div style="background:linear-gradient(90deg,#2D6A4F,#52B788);color:white;text-align:center;padding:.55rem 1rem;font-size:.82rem;font-weight:600;letter-spacing:.02em;position:relative;z-index:1001;" id="top-bar">
    <span>🟢 &nbsp;Slots available this week in Vikaspuri &nbsp;·&nbsp; Book now before they fill up &nbsp;·&nbsp;</span>
    <a href="{{ route('appointments.create.public') }}" style="color:#FFD3A5;text-decoration:underline;font-weight:700;">Book Session →</a>
    <button onclick="document.getElementById('top-bar').style.display='none'" style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(255,255,255,.7);cursor:pointer;font-size:1rem;">✕</button>
</div>

<!-- ── Navbar ──────────────────────────────────────────── -->
<nav class="navbar" id="navbar">
    <a href="{{ url('/') }}" class="brand" id="home-brand">
        <div class="brand-icon"><i class="fas fa-seedling"></i></div>
        <div class="brand-name">Join <span>Roots</span></div>
    </a>

    <ul class="nav-links" id="nav-links">
        <li><a href="#services">Services</a></li>
        <li><a href="#how-it-works">How It Works</a></li>
        <li><a href="#team">Our Team</a></li>
        <li><a href="#testimonials">Reviews</a></li>
        <li><a href="{{ route('blog.index') }}">Blog</a></li>
        <li><a href="{{ route('contact.create') }}">Contact</a></li>
    </ul>

    <div class="nav-actions">
        @auth
            <a href="{{ route('profile.show') }}" class="btn btn-ghost">
                <i class="fas fa-user"></i> My Profile
            </a>
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                    <i class="fas fa-tachometer-alt"></i> Admin
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-ghost" id="login-btn">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary" id="register-btn">Register</a>
        @endauth
    </div>
    <button class="hamburger" id="hamburger" aria-label="Toggle menu"><i class="fas fa-bars"></i></button>
</nav>

<!-- ── Hero ────────────────────────────────────────────── -->
<section class="hero" id="hero">
    <div class="hero-inner">
        <div class="hero-content">
            <div class="hero-tag fade-up"><i class="fas fa-map-marker-alt"></i> Vikaspuri, New Delhi &nbsp;·&nbsp; RCI Certified &nbsp;·&nbsp; Govt. Registered</div>
            <h1 class="fade-up fade-up-d1">
                Is Your Child Struggling with <em>Speech, Autism or Development?</em>
            </h1>
            <p class="fade-up fade-up-d2">
                Delhi's trusted child rehabilitation center — expert RCI-certified therapists for Speech Delay, Autism, ADHD, and Special Needs. Early therapy changes everything. Take the first step today.
            </p>
            <div class="hero-actions fade-up fade-up-d3">
                <a href="{{ route('appointments.create.public') }}" class="btn btn-accent btn-lg" id="book-now-hero">
                    <i class="fas fa-calendar-plus"></i> Book a Session Now
                </a>
                <a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20want%20to%20know%20more%20about%20therapy%20for%20my%20child" target="_blank" rel="noopener" class="btn btn-ghost btn-lg" id="whatsapp-hero">
                    <i class="fab fa-whatsapp"></i> WhatsApp Us
                </a>
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:2rem;font-size:.82rem;color:var(--muted);">
                <i class="fas fa-clock" style="color:var(--primary);"></i>
                <span>Mon–Sat &nbsp;9 AM–6 PM &nbsp;|&nbsp; Online sessions available worldwide</span>
            </div>
            <div class="hero-stats fade-up fade-up-d3">
                <div class="stat">
                    <div class="stat-num">500+</div>
                    <div class="stat-label">Families Helped</div>
                </div>
                <div class="stat">
                    <div class="stat-num">RCI</div>
                    <div class="stat-label">Certified Therapists</div>
                </div>
                <div class="stat">
                    <div class="stat-num">8+</div>
                    <div class="stat-label">Years in Delhi</div>
                </div>
                <div class="stat">
                    <div class="stat-num">4.9★</div>
                    <div class="stat-label">Parent Rating</div>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-card-main">
                <div class="hc-header">
                    <div class="hc-avatar"><i class="fas fa-user-md"></i></div>
                    <div>
                        <div class="hc-name">Ms. Deepali Sahani</div>
                        <div class="hc-role">Speech-Language Pathologist & Lead Therapist</div>
                    </div>
                    <div class="hc-badge">● Available</div>
                </div>
                <div class="hc-services">
                    <div class="hc-service">
                        <div class="hc-service-icon bg-green-soft c-green"><i class="fas fa-check-circle"></i></div>
                        <span>Evidence-Based Therapies</span>
                    </div>
                    <div class="hc-service">
                        <div class="hc-service-icon bg-blue-soft c-blue"><i class="fas fa-user-md"></i></div>
                        <span>Expert Child Specialists</span>
                    </div>
                    <div class="hc-service">
                        <div class="hc-service-icon bg-purple-soft c-purple"><i class="fas fa-laptop-medical"></i></div>
                        <span>Online & In-Clinic Sessions</span>
                    </div>
                    <div class="hc-service">
                        <div class="hc-service-icon bg-orange-soft c-orange"><i class="fas fa-child"></i></div>
                        <span>Personalized Care Plans</span>
                    </div>
                </div>
            </div>

            <!-- Floating cards -->
            <div class="floating-card fc-1" aria-hidden="true">
                <div class="fc-icon bg-green-soft c-green"><i class="fas fa-video"></i></div>
                <div class="fc-text">
                    <div class="fc-title">Online Sessions</div>
                    <div class="fc-sub">Join from anywhere</div>
                </div>
            </div>
            <div class="floating-card fc-2" aria-hidden="true">
                <div class="fc-icon bg-orange-soft c-orange"><i class="fas fa-star"></i></div>
                <div class="fc-text">
                    <div class="fc-title">4.9 / 5 Rating</div>
                    <div class="fc-sub">From 300+ reviews</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── Compact Promo Banner ──────────────────────────────── -->
<section style="padding:0; margin:0;">
    <div style="background:linear-gradient(135deg,#1B2B25 0%,#2D6A4F 100%); position:relative; overflow:hidden; padding:3rem 2rem;">
        <!-- Decorative circles -->
        <div style="position:absolute;top:-80px;right:-80px;width:350px;height:350px;border-radius:50%;background:rgba(82,183,136,.08);pointer-events:none;"></div>
        <div style="position:absolute;bottom:-60px;left:-60px;width:250px;height:250px;border-radius:50%;background:rgba(244,162,97,.06);pointer-events:none;"></div>
        <div class="container">
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:2rem;align-items:center;">
                <!-- Left: Branding -->
                <div style="color:white;">
                    <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(82,183,136,.2);border:1px solid rgba(82,183,136,.3);color:#52B788;padding:.35rem 1rem;border-radius:50px;font-size:.8rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;margin-bottom:1rem;">🌱 Govt. Registered Center</div>
                    <h2 style="font-family:'Fraunces',serif;font-size:clamp(1.6rem,2.5vw,2.2rem);font-weight:700;line-height:1.2;margin-bottom:.75rem;">Delhi's Trusted Child<br/><span style="color:#52B788;">Specialist Center</span></h2>
                    <p style="color:rgba(255,255,255,.75);font-size:.9rem;line-height:1.6;margin-bottom:1.25rem;">Expert therapists. Evidence-based care. Serving families across India &amp; worldwide via online sessions.</p>
                    <div style="font-size:.78rem;color:rgba(255,255,255,.5);border-top:1px solid rgba(255,255,255,.1);padding-top:.75rem;">UDYAM-DL-11-0152999 &nbsp;|&nbsp; Vikaspuri, New Delhi</div>
                </div>
                <!-- Middle: Stats -->
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:1.25rem;text-align:center;">
                        <div style="font-size:2rem;font-weight:800;color:#52B788;line-height:1;">500+</div>
                        <div style="font-size:.78rem;color:rgba(255,255,255,.6);margin-top:.25rem;">Families Helped</div>
                    </div>
                    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:1.25rem;text-align:center;">
                        <div style="font-size:2rem;font-weight:800;color:#F4A261;line-height:1;">15+</div>
                        <div style="font-size:.78rem;color:rgba(255,255,255,.6);margin-top:.25rem;">Expert Therapists</div>
                    </div>
                    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:1.25rem;text-align:center;">
                        <div style="font-size:2rem;font-weight:800;color:#52B788;line-height:1;">14+</div>
                        <div style="font-size:.78rem;color:rgba(255,255,255,.6);margin-top:.25rem;">Therapy Services</div>
                    </div>
                    <div style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);border-radius:16px;padding:1.25rem;text-align:center;">
                        <div style="font-size:2rem;font-weight:800;color:#F4A261;line-height:1;">98%</div>
                        <div style="font-size:.78rem;color:rgba(255,255,255,.6);margin-top:.25rem;">Satisfaction Rate</div>
                    </div>
                </div>
                <!-- Right: Quick features -->
                <div style="display:flex;flex-direction:column;gap:.85rem;">
                    <div style="display:flex;align-items:center;gap:.75rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:.85rem 1rem;">
                        <div style="width:38px;height:38px;border-radius:10px;background:rgba(82,183,136,.2);display:flex;align-items:center;justify-content:center;font-size:1rem;color:#52B788;flex-shrink:0;"><i class="fas fa-video"></i></div>
                        <div><div style="font-weight:700;color:white;font-size:.88rem;">Online Worldwide</div><div style="font-size:.76rem;color:rgba(255,255,255,.5);">Join from any device, anywhere</div></div>
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:.85rem 1rem;">
                        <div style="width:38px;height:38px;border-radius:10px;background:rgba(244,162,97,.2);display:flex;align-items:center;justify-content:center;font-size:1rem;color:#F4A261;flex-shrink:0;"><i class="fas fa-map-marker-alt"></i></div>
                        <div><div style="font-weight:700;color:white;font-size:.88rem;">Vikaspuri, Delhi</div><div style="font-size:.76rem;color:rgba(255,255,255,.5);">KG-2/46, near U.K Nursing Home</div></div>
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;padding:.85rem 1rem;">
                        <div style="width:38px;height:38px;border-radius:10px;background:rgba(82,183,136,.2);display:flex;align-items:center;justify-content:center;font-size:1rem;color:#52B788;flex-shrink:0;"><i class="fas fa-lock"></i></div>
                        <div><div style="font-weight:700;color:white;font-size:.88rem;">Safe &amp; Confidential</div><div style="font-size:.76rem;color:rgba(255,255,255,.5);">HIPAA-aligned privacy standards</div></div>
                    </div>
                    <a href="{{ route('appointments.create.public') }}" style="display:flex;align-items:center;justify-content:center;gap:.5rem;background:linear-gradient(135deg,#F4A261,#E76F51);color:white;font-weight:700;font-size:.9rem;padding:.85rem 1.5rem;border-radius:50px;text-decoration:none;transition:transform .2s;box-shadow:0 4px 15px rgba(244,162,97,.4);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                        <i class="fas fa-calendar-plus"></i> Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── Conditions We Treat ───────────────────────────────── -->
<section id="conditions" style="background:#fff;padding:5rem 2rem;">
    <div class="container">
        <div class="section-header center">
            <div class="section-tag">Conditions We Treat</div>
            <h2 class="section-title">Does Your Child Need Help With Any of These?</h2>
            <p class="section-subtitle">Our expert therapists in Delhi are trained to support a wide range of childhood developmental conditions — the earlier the intervention, the better the outcome.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1.25rem;margin-bottom:2.5rem;">
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#DCFCE7,#BBF7D0);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">🗣️</div>
                    <div style="font-weight:700;color:#166534;font-size:.9rem;margin-bottom:.3rem;">Speech Delay</div>
                    <div style="font-size:.75rem;color:#16A34A;">Late talking, unclear speech</div>
                </div>
            </a>
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#DBEAFE,#BFDBFE);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">🧩</div>
                    <div style="font-weight:700;color:#1E40AF;font-size:.9rem;margin-bottom:.3rem;">Autism (ASD)</div>
                    <div style="font-size:.75rem;color:#2563EB;">Communication & social skills</div>
                </div>
            </a>
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#FEF3C7,#FDE68A);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">⚡</div>
                    <div style="font-weight:700;color:#92400E;font-size:.9rem;margin-bottom:.3rem;">ADHD</div>
                    <div style="font-size:.75rem;color:#D97706;">Attention, focus & behaviour</div>
                </div>
            </a>
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#EDE9FE,#DDD6FE);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">🦽</div>
                    <div style="font-weight:700;color:#4C1D95;font-size:.9rem;margin-bottom:.3rem;">Cerebral Palsy</div>
                    <div style="font-size:.75rem;color:#7C3AED;">Motor & speech support</div>
                </div>
            </a>
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#FFE4E6,#FECDD3);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">💛</div>
                    <div style="font-weight:700;color:#881337;font-size:.9rem;margin-bottom:.3rem;">Down Syndrome</div>
                    <div style="font-size:.75rem;color:#E11D48;">Developmental & speech</div>
                </div>
            </a>
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#CCFBF1,#99F6E4);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">📚</div>
                    <div style="font-weight:700;color:#134E4A;font-size:.9rem;margin-bottom:.3rem;">Learning Disability</div>
                    <div style="font-size:.75rem;color:#0D9488;">Dyslexia, dyscalculia</div>
                </div>
            </a>
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#FFF7ED,#FED7AA);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">🎯</div>
                    <div style="font-weight:700;color:#9A3412;font-size:.9rem;margin-bottom:.3rem;">Stammering / Fluency</div>
                    <div style="font-size:.75rem;color:#EA580C;">Stuttering, cluttering</div>
                </div>
            </a>
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;">
                <div style="background:linear-gradient(135deg,#F0FDF4,#DCFCE7);border-radius:16px;padding:1.5rem 1rem;text-align:center;transition:transform .2s;cursor:pointer;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='none'">
                    <div style="font-size:2rem;margin-bottom:.6rem;">🌟</div>
                    <div style="font-weight:700;color:#14532D;font-size:.9rem;margin-bottom:.3rem;">Other Special Needs</div>
                    <div style="font-size:.75rem;color:#16A34A;">Any developmental concern</div>
                </div>
            </a>
        </div>
        <div style="background:linear-gradient(135deg,#EAF5EE,#F0FFF4);border:1.5px solid #BBF7D0;border-radius:16px;padding:1.5rem 2rem;display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;">
            <div style="width:48px;height:48px;background:var(--primary);border-radius:12px;display:flex;align-items:center;justify-content:center;color:white;font-size:1.4rem;flex-shrink:0;"><i class="fas fa-lightbulb"></i></div>
            <div style="flex:1;">
                <div style="font-weight:700;color:var(--dark);margin-bottom:.2rem;">Early Intervention is Key</div>
                <div style="font-size:.88rem;color:var(--muted);">Research shows that children who receive therapy before age 5 show significantly better outcomes. Don't wait — every week matters.</div>
            </div>
            <a href="{{ route('appointments.create.public') }}" class="btn btn-primary" style="flex-shrink:0;"><i class="fas fa-calendar-plus"></i> Book Now</a>
        </div>
    </div>
</section>

<!-- ── Services ─────────────────────────────────────────── -->
<section id="services">
    <div class="container">
        <div class="section-header center">
            <div class="section-tag">Our Services</div>
            <h2 class="section-title">Comprehensive Care for Your Child</h2>
            <p class="section-subtitle">Every session is tailored to your child's unique needs, delivered by certified specialists with compassion and expertise.</p>
        </div>
        <div class="services-grid">
            @php
                $serviceImages = [
                    asset('images/hero_therapy_image.png'),
                    asset('images/why_choose_us_therapy.png'),
                    'https://images.unsplash.com/photo-1576765608622-067973a79f53?w=600&q=80',
                    'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=600&q=80',
                    'https://images.unsplash.com/photo-1516627145497-ae6968895b74?w=600&q=80',
                    'https://images.unsplash.com/photo-1587691592099-24045742c181?w=600&q=80',
                ];
            @endphp
            @foreach($services->take(6) as $index => $service)
            <a href="{{ route('appointments.create.public') }}" style="text-decoration:none;color:inherit;display:flex;">
                <div class="service-card" style="padding:0;width:100%;">
                    <div style="position:relative;overflow:hidden;height:240px;width:100%;">
                        <img src="{{ $serviceImages[$index % 6] }}" alt="{{ $service->title }}" style="width:100%;height:100%;object-fit:cover;object-position:center;transition:transform .4s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="position:absolute;top:12px;left:12px;background:{{ $service->color }};color:white;font-size:.7rem;font-weight:700;padding:.25rem .7rem;border-radius:50px;box-shadow:0 2px 10px rgba(0,0,0,0.2);">{{ $service->category }}</div>
                    </div>
                    <div style="padding:1.5rem;flex:1;display:flex;flex-direction:column;">
                        <div style="width:44px;height:44px;border-radius:12px;background:{{ $service->color }}18;color:{{ $service->color }};display:flex;align-items:center;justify-content:center;font-size:1.2rem;margin-bottom:.85rem;"><i class="{{ $service->icon }}"></i></div>
                        <h3 style="font-size:1rem;font-weight:700;color:var(--dark);margin-bottom:.4rem;">{{ $service->title }}</h3>
                        <p style="font-size:.82rem;color:var(--muted);line-height:1.55;flex:1;margin-bottom:1rem;">{{ Str::limit($service->description, 100) }}</p>
                        <div style="border-top:1px solid var(--border);padding-top:.85rem;">
                            <div style="font-size:.78rem;color:var(--muted);margin-bottom:.45rem;">Consultation Fee</div>
                            <div style="display:grid;gap:.35rem;">
                                <div style="display:flex;justify-content:space-between;align-items:center;gap:.75rem;">
                                    <span style="font-size:.78rem;color:var(--muted);">Online</span>
                                    <span style="text-align:right;">
                                        @if($service->has_online_discount)
                                            <span style="font-size:.78rem;color:var(--muted);text-decoration:line-through;margin-right:.35rem;">&#8377;{{ number_format($service->online_price, 0) }}</span>
                                        @endif
                                        <span style="font-weight:700;color:{{ $service->color }};font-size:.92rem;">&#8377;{{ number_format($service->discounted_online_price, 0) }}</span>
                                    </span>
                                </div>
                                <div style="display:flex;justify-content:space-between;align-items:center;gap:.75rem;">
                                    <span style="font-size:.78rem;color:var(--muted);">In-Clinic</span>
                                    <span style="text-align:right;">
                                        @if($service->has_offline_discount)
                                            <span style="font-size:.78rem;color:var(--muted);text-decoration:line-through;margin-right:.35rem;">&#8377;{{ number_format($service->offline_price, 0) }}</span>
                                        @endif
                                        <span style="font-weight:700;color:{{ $service->color }};font-size:.92rem;">&#8377;{{ number_format($service->discounted_offline_price, 0) }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:.4rem;background:{{ $service->color }};color:white;font-size:.8rem;font-weight:700;padding:.5rem 1rem;border-radius:50px;margin-top:.85rem;justify-content:center;">
                            <i class="fas fa-calendar-plus"></i> Book This Session
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @if($services->count() > 6)
        <div style="text-align:center;margin-top:2.5rem;">
            <a href="{{ route('appointments.create.public') }}" class="btn btn-ghost">View All {{ $services->count() }} Services <i class="fas fa-arrow-right"></i></a>
        </div>
        @endif
        <div style="text-align:center;margin-top:2rem;">
            <a href="{{ route('appointments.create.public') }}" class="btn btn-primary btn-lg" id="book-services">
                <i class="fas fa-calendar-plus"></i> Book a Session Now
            </a>
        </div>
    </div>
</section>

<!-- ── How It Works ─────────────────────────────────────── -->
<section id="how-it-works" style="background: linear-gradient(180deg,#EAF5EE 0%,#F9FAF8 100%);">
    <div class="container">
        <div class="section-header center">
            <div class="section-tag">Simple Process</div>
            <h2 class="section-title">Book in 4 Easy Steps</h2>
            <p class="section-subtitle">Getting started with JoinRoots is quick and hassle-free.</p>
        </div>
        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <h3>Choose a Service</h3>
                <p>Browse our range of therapy and counselling services tailored to your child's needs.</p>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <h3>Pick Date & Mode</h3>
                <p>Select your preferred date and choose between an in-clinic visit or online video call.</p>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <h3>Confirm & Pay</h3>
                <p>Complete your booking with a secure Razorpay payment. Offline visits are confirmed instantly.</p>
            </div>
            <div class="step">
                <div class="step-num">4</div>
                <h3>Attend Session</h3>
                <p>Receive an email confirmation with your meeting details or clinic address. We're ready for you!</p>
            </div>
        </div>
    </div>
</section>

<!-- ── Why Us ───────────────────────────────────────────── -->
<section class="why-section" id="why-us">
    <div class="container">
        <div class="section-header">
            <div class="section-tag" style="background:rgba(82,183,136,.2);color:var(--primary-lt);">Why Choose Us</div>
            <h2 class="section-title">Care You Can Trust</h2>
            <p class="section-subtitle">We combine clinical expertise with genuine compassion to give every child the best start.</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-user-md"></i></div>
                <h3>Certified Specialists</h3>
                <p>All our therapists are RCI-certified and nationally accredited. Continuous professional development ensures you always get world-class clinical expertise.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-video"></i></div>
                <h3>Online & In-Clinic</h3>
                <p>Flexible session formats — attend in-person at our Vikaspuri clinic or join a secure video call from anywhere in the world. Same quality care, your way.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-lock"></i></div>
                <h3>Safe & Confidential</h3>
                <p>All sessions and child records are handled under strict confidentiality protocols aligned with best clinical and digital privacy standards.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-rupee-sign"></i></div>
                <h3>Affordable Pricing</h3>
                <p>Transparent fee structure with zero hidden charges. We believe quality child therapy should be accessible to every family regardless of budget.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-clock"></i></div>
                <h3>Flexible Scheduling</h3>
                <p>Weekday and weekend time slots available from 9 AM–6 PM. Our real-time booking system shows live availability and confirms instantly.</p>
            </div>
            <div class="why-card">
                <div class="why-icon"><i class="fas fa-certificate"></i></div>
                <h3>Govt. Registered</h3>
                <p>JoinRoots is a government-registered center under Udyami (UDYAM-DL-11-0152999). You can trust us with your child's care, growth, and future.</p>
            </div>
        </div>
    </div>
</section>

<!-- ── FAQ ───────────────────────────────────────────────── -->
<section id="faq" style="background:var(--bg);padding:5rem 2rem;">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:start;" class="faq-layout">
            <div>
                <div class="section-tag">FAQ</div>
                <h2 class="section-title">Questions Parents Ask Us</h2>
                <p class="section-subtitle" style="margin-bottom:2rem;">We understand your concerns. Here are honest answers to the most common questions from Delhi parents.</p>
                <a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20have%20a%20question%20about%20therapy%20for%20my%20child" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:.6rem;background:#25D366;color:white;font-weight:700;padding:.85rem 1.75rem;border-radius:50px;text-decoration:none;font-size:.95rem;">
                    <i class="fab fa-whatsapp" style="font-size:1.2rem;"></i> Ask on WhatsApp
                </a>
            </div>
            <div style="display:flex;flex-direction:column;gap:1rem;">
                <details style="background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;" open>
                    <summary style="padding:1.25rem 1.5rem;font-weight:700;color:var(--dark);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;font-size:.95rem;">
                        At what age should I start speech therapy for my child?
                        <i class="fas fa-chevron-down" style="color:var(--primary);font-size:.8rem;transition:transform .3s;"></i>
                    </summary>
                    <div style="padding:0 1.5rem 1.25rem;color:var(--muted);font-size:.9rem;line-height:1.7;border-top:1px solid var(--border);">
                        The earlier, the better. Children as young as 6 months can start early intervention. However, most therapy begins between 18 months–5 years. If your child is not meeting speech milestones, don't wait. Early therapy gives the best results.
                    </div>
                </details>
                <details style="background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;">
                    <summary style="padding:1.25rem 1.5rem;font-weight:700;color:var(--dark);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;font-size:.95rem;">
                        Are your therapists RCI certified?
                        <i class="fas fa-chevron-down" style="color:var(--primary);font-size:.8rem;"></i>
                    </summary>
                    <div style="padding:0 1.5rem 1.25rem;color:var(--muted);font-size:.9rem;line-height:1.7;border-top:1px solid var(--border);">
                        Yes. All our therapists are certified by the Rehabilitation Council of India (RCI) — the national regulatory body for rehabilitation professionals in India. You can trust that your child is in qualified, professional hands.
                    </div>
                </details>
                <details style="background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;">
                    <summary style="padding:1.25rem 1.5rem;font-weight:700;color:var(--dark);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;font-size:.95rem;">
                        Do you offer online therapy for children outside Delhi?
                        <i class="fas fa-chevron-down" style="color:var(--primary);font-size:.8rem;"></i>
                    </summary>
                    <div style="padding:0 1.5rem 1.25rem;color:var(--muted);font-size:.9rem;line-height:1.7;border-top:1px solid var(--border);">
                        Absolutely. We offer secure video-based online sessions for families across India and worldwide. Online therapy is equally effective for many conditions, especially speech therapy, behavioural therapy, and parent coaching.
                    </div>
                </details>
                <details style="background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;">
                    <summary style="padding:1.25rem 1.5rem;font-weight:700;color:var(--dark);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;font-size:.95rem;">
                        What is the cost of speech therapy in Delhi at JoinRoots?
                        <i class="fas fa-chevron-down" style="color:var(--primary);font-size:.8rem;"></i>
                    </summary>
                    <div style="padding:0 1.5rem 1.25rem;color:var(--muted);font-size:.9rem;line-height:1.7;border-top:1px solid var(--border);">
                        Our fees are transparent and affordable — no hidden charges. Prices vary by service type and session mode (online/in-clinic). Check our Services section above for exact pricing, or WhatsApp us for a personalised quote.
                    </div>
                </details>
                <details style="background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;">
                    <summary style="padding:1.25rem 1.5rem;font-weight:700;color:var(--dark);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;font-size:.95rem;">
                        How many sessions will my child need?
                        <i class="fas fa-chevron-down" style="color:var(--primary);font-size:.8rem;"></i>
                    </summary>
                    <div style="padding:0 1.5rem 1.25rem;color:var(--muted);font-size:.9rem;line-height:1.7;border-top:1px solid var(--border);">
                        Every child is different. After an initial assessment, our therapist will create a personalised therapy plan and give you a realistic timeline. Most children show measurable progress within 8–12 weeks of consistent therapy.
                    </div>
                </details>
                <details style="background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;">
                    <summary style="padding:1.25rem 1.5rem;font-weight:700;color:var(--dark);cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;font-size:.95rem;">
                        Can parents attend the therapy session?
                        <i class="fas fa-chevron-down" style="color:var(--primary);font-size:.8rem;"></i>
                    </summary>
                    <div style="padding:0 1.5rem 1.25rem;color:var(--muted);font-size:.9rem;line-height:1.7;border-top:1px solid var(--border);">
                        Yes, and we encourage it. Parent involvement is a crucial part of our approach. We train parents with home exercises and techniques so progress continues between sessions.
                    </div>
                </details>
            </div>
        </div>
    </div>
</section>
<style>
@media(max-width:860px){.faq-layout{grid-template-columns:1fr!important;gap:2rem!important;}}
details summary::-webkit-details-marker{display:none}
details[open] summary i.fa-chevron-down{transform:rotate(180deg);}
</style>

<!-- ── Team ───────────────────────────────────────────── -->
@if($doctors->count() > 0)
<section id="team" style="background:linear-gradient(180deg, #F9FAF8 0%, #FFFFFF 100%);">
    <div class="container">
        <div class="section-header center">
            <div class="section-tag" style="background:rgba(45,106,79,.1);color:var(--primary);">Expert Specialists</div>
            <h2 class="section-title">Meet Our Dedicated Team</h2>
            <p class="section-subtitle">Compassionate professionals committed to your child's development and well-being.</p>
        </div>
        <div class="team-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:2.5rem;">
            @foreach($doctors as $doctor)
            <div class="team-card" style="background:white;border-radius:20px;border:1px solid var(--border);box-shadow:0 4px 20px rgba(0,0,0,0.03);overflow:hidden;transition:all .3s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 30px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.03)';">
                <div style="height:120px;background:linear-gradient(135deg,rgba(45,106,79,.05),rgba(45,106,79,.15));position:relative;">
                    @if($doctor->photo_url)
                        <div style="position:absolute;bottom:-60px;left:50%;transform:translateX(-50%);width:130px;height:130px;border-radius:50%;overflow:hidden;border:4px solid white;box-shadow:0 8px 16px rgba(0,0,0,0.1);background:white;">
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" style="width:100%;height:100%;object-fit:cover;object-position:top;">
                        </div>
                    @else
                        <div style="position:absolute;bottom:-60px;left:50%;transform:translateX(-50%);width:130px;height:130px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--primary-lt));color:white;display:flex;align-items:center;justify-content:center;font-size:3rem;border:4px solid white;box-shadow:0 8px 16px rgba(0,0,0,0.1);">
                            <i class="fas fa-user-md"></i>
                        </div>
                    @endif
                </div>
                <div style="padding:4.5rem 2rem 2.5rem;text-align:center;">
                    <h3 style="font-size:1.35rem;font-weight:700;color:var(--dark);margin-bottom:.25rem;font-family:'Fraunces',serif;">{{ $doctor->name }}</h3>
                    <p style="color:var(--primary);font-size:.9rem;font-weight:700;margin-bottom:1.25rem;">{{ $doctor->designation }}</p>
                    
                    <div style="font-size:.85rem;color:var(--muted);background:#F9FAF8;padding:1rem;border-radius:12px;margin-bottom:1.5rem;text-align:left;border:1px solid rgba(0,0,0,0.03);">
                        <div style="display:flex;align-items:flex-start;gap:.5rem;margin-bottom:.5rem;">
                            <i class="fas fa-graduation-cap" style="color:var(--primary-lt);margin-top:3px;"></i>
                            <span>{{ Str::limit($doctor->qualification, 75) }}</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:.5rem;font-weight:700;color:var(--dark);">
                            <i class="fas fa-briefcase" style="color:#F4A261;"></i>
                            <span>{{ $doctor->experience_years }} Years Experience</span>
                        </div>
                    </div>
                    
                    <div style="display:flex;flex-wrap:wrap;gap:.4rem;justify-content:center;">
                        @foreach(explode(',', $doctor->specializations) as $spec)
                            <span style="background:rgba(45,106,79,.08);color:var(--primary);font-size:.72rem;font-weight:600;padding:.3rem .8rem;border-radius:50px;">{{ trim($spec) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ── Testimonials ─────────────────────────────────────── -->
<section id="testimonials">
    <div class="container">
        <div class="section-header center">
            <div class="section-tag">Testimonials</div>
            <h2 class="section-title">What Families Say</h2>
            <p class="section-subtitle">Real stories from parents who've seen real change in their children.</p>
        </div>
        <div class="testimonials-grid">
            @foreach($reviews as $review)
            <div class="testimonial-card">
                <div class="stars">
                    @for($i=1; $i<=5; $i++)
                        @if($i <= $review->rating) ★ @else ☆ @endif
                    @endfor
                </div>
                <p class="testimonial-text">"{{ $review->review_text }}"</p>
                <div class="testimonial-author">
                    <div class="author-avatar" style="background: {{ $review->avatar_color }}">{{ substr($review->name, 0, 1) }}</div>
                    <div>
                        <div class="author-name">{{ $review->name }}</div>
                        <div class="author-role">{{ $review->role }}{{ $review->location ? ' · ' . $review->location : '' }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ── Blog Section ─────────────────────────────────────── -->
@if($blogs->count() > 0)
<section id="blog-section" style="background:var(--bg);">
    <div class="container">
        <div class="section-header" style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:3rem;flex-wrap:wrap;gap:1.5rem;">
            <div>
                <div class="section-tag" style="background:rgba(244,162,97,.15);color:#E76F51;">Insights</div>
                <h2 class="section-title" style="margin-bottom:0;">Latest From Our Blog</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-ghost" style="border-radius:50px;">View All Articles <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
        
        <div class="services-grid" style="grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:2rem;">
            @foreach($blogs as $blog)
            <a href="{{ route('blog.show', $blog) }}" style="text-decoration:none;">
                <div class="service-card" style="padding:0;display:flex;flex-direction:column;height:100%;">
                    @if($blog->cover_image_url)
                        <div style="width:100%;height:240px;overflow:hidden;border-radius:var(--radius) var(--radius) 0 0;">
                            <img src="{{ $blog->cover_image_url }}" alt="{{ $blog->title }}" style="width:100%;height:100%;object-fit:cover;object-position:center;transition:transform .4s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                    @else
                        <div style="width:100%;height:220px;background:rgba(45,106,79,.08);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:3rem;border-radius:var(--radius) var(--radius) 0 0;">
                            <i class="fas fa-book-open"></i>
                        </div>
                    @endif
                    <div style="padding:2rem;">
                        <span style="font-size:.75rem;font-weight:700;color:var(--primary);text-transform:uppercase;letter-spacing:1px;">{{ $blog->category }}</span>
                        <h3 style="font-size:1.2rem;margin-top:.5rem;margin-bottom:1rem;color:var(--dark);line-height:1.4;">{{ Str::limit($blog->title, 60) }}</h3>
                        <p style="color:var(--muted);font-size:.9rem;line-height:1.6;margin-bottom:1.5rem;">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 100) }}</p>
                        <div style="display:flex;align-items:center;margin-top:auto;padding-top:1.5rem;border-top:1px solid var(--border);">
                            <div style="width:36px;height:36px;border-radius:50%;background:var(--dark);color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;margin-right:.75rem;">{{ substr($blog->author, 0, 1) }}</div>
                            <div>
                                <div style="font-weight:700;font-size:.85rem;color:var(--dark);">{{ $blog->author }}</div>
                                <div style="font-size:.75rem;color:var(--muted);">{{ $blog->published_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ── Location + Map CTA ────────────────────────────────── -->
<section style="padding:0;background:var(--bg);">
    <div class="container" style="padding:4rem 0;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center;" class="map-layout">
            <div>
                <div class="section-tag">Find Us</div>
                <h2 class="section-title">Visit Us in Vikaspuri, New Delhi</h2>
                <p style="color:var(--muted);font-size:.95rem;line-height:1.7;margin-bottom:1.5rem;">
                    We are conveniently located in Vikaspuri, West Delhi — easily accessible from Dwarka, Janakpuri, Uttam Nagar, Paschim Vihar, and Rajouri Garden. Online sessions available for pan-India families.
                </p>
                <div style="display:flex;flex-direction:column;gap:.85rem;margin-bottom:1.75rem;">
                    <div style="display:flex;align-items:flex-start;gap:.75rem;">
                        <i class="fas fa-map-marker-alt" style="color:var(--primary);margin-top:3px;width:18px;"></i>
                        <span style="font-size:.9rem;color:var(--text);">KG-2/46 G.F, near U.K Nursing Home, Vikaspuri, New Delhi – 110018</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <i class="fas fa-phone" style="color:var(--primary);width:18px;"></i>
                        <a href="tel:+919334892585" style="font-size:.9rem;color:var(--text);text-decoration:none;font-weight:600;">+91 93348 92585</a>
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <i class="fas fa-clock" style="color:var(--primary);width:18px;"></i>
                        <span style="font-size:.9rem;color:var(--text);">Monday – Saturday, 9:00 AM – 6:00 PM</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <i class="fab fa-whatsapp" style="color:#25D366;width:18px;"></i>
                        <a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20want%20to%20book%20a%20session" target="_blank" rel="noopener" style="font-size:.9rem;color:#25D366;text-decoration:none;font-weight:700;">WhatsApp for quick response</a>
                    </div>
                </div>
                <div style="display:flex;gap:.75rem;flex-wrap:wrap;">
                    <a href="{{ route('appointments.create.public') }}" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> Book Session</a>
                    <a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20want%20to%20know%20more" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:.4rem;background:#25D366;color:white;font-weight:600;padding:.6rem 1.4rem;border-radius:50px;text-decoration:none;font-size:.875rem;"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                </div>
            </div>
            <div style="border-radius:20px;overflow:hidden;box-shadow:var(--shadow-md);">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.5!2d77.0689!3d28.6386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjjCsDM4JzE5LjAiTiA3N8KwMDQnMDguMCJF!5e0!3m2!1sen!2sin!4v1"
                    width="100%" height="320" style="border:0;display:block;" allowfullscreen="" loading="lazy"
                    title="JoinRoots location in Vikaspuri New Delhi">
                </iframe>
            </div>
        </div>
    </div>
</section>
<style>@media(max-width:860px){.map-layout{grid-template-columns:1fr!important;}}</style>

<!-- ── CTA ──────────────────────────────────────────────── -->
<section class="cta-section" id="cta">
    <h2>Ready to Start Your Child's Therapy Journey?</h2>
    <p>Book a session today and take the first step towards better communication, development, and a happier life for your child. Our expert team in Vikaspuri, Delhi is ready for you.</p>
    <div class="cta-buttons">
        <a href="{{ route('appointments.create.public') }}" class="btn btn-accent btn-lg" id="book-cta">
            <i class="fas fa-calendar-plus"></i> Book a Session Now
        </a>
        <a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20want%20to%20discuss%20therapy%20for%20my%20child" target="_blank" rel="noopener" class="btn btn-lg" style="background:rgba(255,255,255,.15);color:white;border:1.5px solid rgba(255,255,255,.4);" id="whatsapp-cta">
            <i class="fab fa-whatsapp"></i> WhatsApp Us
        </a>
    </div>
    <p style="margin-top:1.5rem;font-size:.82rem;color:rgba(255,255,255,.5);">No spam. No pressure. Just expert guidance for your child.</p>
</section>

<!-- ── Footer ───────────────────────────────────────────── -->
<footer>
    <div class="footer-inner">
        <div class="footer-grid">
            <div class="footer-col">
                <div class="brand" style="margin-bottom:1rem;">
                    <div class="brand-icon"><i class="fas fa-seedling"></i></div>
                    <div class="brand-name" style="color:white;">Join <span>Roots</span></div>
                </div>
                <p>A trusted child rehabilitation center helping families and children grow stronger, together. Available for clients around the world for online sessions.</p>
                <p style="margin-top: 1rem; font-size: 0.8rem; opacity: 0.8; font-weight: bold;">Udyami Registration:<br/>UDYAM-DL-11-0152999</p>
            </div>
            <div class="footer-col">
                <h4>Conditions We Treat</h4>
                <ul class="footer-links">
                    <li><a href="#conditions">Speech Delay / Late Talking</a></li>
                    <li><a href="#conditions">Autism (ASD)</a></li>
                    <li><a href="#conditions">ADHD</a></li>
                    <li><a href="#conditions">Cerebral Palsy</a></li>
                    <li><a href="#conditions">Down Syndrome</a></li>
                    <li><a href="#conditions">Stammering / Fluency</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('appointments.create.public') }}">Book Appointment</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    <li><a href="{{ route('contact.create') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <ul class="footer-links">
                    <li><a href="mailto:connnectingroots.support@gmail.com"><i class="fas fa-envelope" style="width:18px"></i> connnectingroots.support@gmail.com</a></li>
                    <li><a href="tel:+919334892585"><i class="fas fa-phone" style="width:18px"></i> +91 93348 92585</a></li>
                    <li style="display: flex; gap: 8px;"><i class="fas fa-map-marker-alt" style="width:18px; margin-top: 4px;"></i> <span>KG-2 / 46 G.F, near U.K Nursing Home, Vikaspuri, New Delhi - 110018</span></li>
                    <li><div style="display: flex; gap: 8px;"><i class="fas fa-clock" style="width:18px; margin-top: 4px;"></i> <span>Mon–Sat, 9AM–6PM</span></div></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} JoinRoots. All rights reserved. Made with ❤️ for every child.</p>
            <div class="social-links">
                <a href="https://www.facebook.com/joinroots" target="_blank" rel="noopener" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/joinroots" target="_blank" rel="noopener" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/919334892585?text=Hi%20JoinRoots" target="_blank" rel="noopener" class="social-link" aria-label="WhatsApp" style="background:#25D366;"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.youtube.com/@joinroots" target="_blank" rel="noopener" class="social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- ── Floating WhatsApp Button ──────────────────────────── -->
<a href="https://wa.me/919334892585?text=Hi%20JoinRoots%2C%20I%20want%20to%20know%20more%20about%20therapy%20for%20my%20child"
   target="_blank" rel="noopener"
   aria-label="Chat on WhatsApp"
   style="
       position:fixed; bottom:24px; right:24px; z-index:9999;
       width:60px; height:60px; border-radius:50%;
       background:#25D366; color:white;
       display:flex; align-items:center; justify-content:center;
       font-size:1.6rem; text-decoration:none;
       box-shadow:0 6px 24px rgba(37,211,102,.5);
       transition:transform .2s, box-shadow .2s;
       animation: waPulse 2.5s infinite;
   "
   onmouseover="this.style.transform='scale(1.12)'" onmouseout="this.style.transform='scale(1)'">
    <i class="fab fa-whatsapp"></i>
</a>
<!-- WhatsApp tooltip -->
<div style="position:fixed;bottom:92px;right:24px;z-index:9998;background:#1B2B25;color:white;font-size:.78rem;font-weight:600;padding:.4rem .85rem;border-radius:8px;pointer-events:none;opacity:0;transition:opacity .3s;" id="wa-tooltip">
    Chat with us!
</div>
<style>
@keyframes waPulse {
    0%,100%{box-shadow:0 6px 24px rgba(37,211,102,.5);}
    50%{box-shadow:0 6px 32px rgba(37,211,102,.85),0 0 0 12px rgba(37,211,102,.12);}
}
</style>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
    });

    // Hamburger
    document.getElementById('hamburger').addEventListener('click', () => {
        const nl = document.getElementById('nav-links');
        nl.style.display = nl.style.display === 'flex' ? 'none' : 'flex';
        nl.style.flexDirection = 'column';
        nl.style.position = 'absolute';
        nl.style.top = '70px'; nl.style.left = '0'; nl.style.right = '0';
        nl.style.background = 'white';
        nl.style.padding = '1rem 2rem';
        nl.style.boxShadow = '0 8px 32px rgba(0,0,0,.1)';
        nl.style.gap = '1rem';
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({behavior:'smooth', block:'start'}); }
        });
    });

    // Scroll reveal
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.style.opacity = 1; e.target.style.transform = 'translateY(0)'; } });
    }, { threshold: 0.1 });
    document.querySelectorAll('.service-card, .why-card, .step, .testimonial-card').forEach(el => {
        el.style.opacity = 0; el.style.transform = 'translateY(24px)';
        el.style.transition = 'opacity .6s ease, transform .6s ease';
        observer.observe(el);
    });
</script>
</body>
</html>
