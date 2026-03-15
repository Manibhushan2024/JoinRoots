<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Icons -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('status'))
                    <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                        <i class="fas fa-info-circle me-2"></i> {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>
        
        <!-- Global Floating Widget -->
        <div class="position-fixed" style="bottom: 30px; right: 30px; z-index: 1050; display: flex; flex-direction: column; gap: 15px;">
            <a href="mailto:connnectingroots.support@gmail.com" class="btn btn-primary rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; font-size: 1.4rem; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Email Us">
                <i class="fas fa-envelope"></i>
            </a>
            <a href="https://wa.me/919334892585?text={{ urlencode('Hello JoinRoots, I want to inquire about a session.') }}" target="_blank" class="btn btn-success rounded-circle shadow-lg d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #25D366; border: none; font-size: 1.8rem; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="WhatsApp Us">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>

        {{-- Smart Booking Popup — Only for users without appointments, once per session --}}
        @php $showPopup = !auth()->check() || (auth()->check() && auth()->user()->appointments()->count() === 0); @endphp
        @if($showPopup)
        <div id="booking-popup" style="display:none; position:fixed; bottom:100px; left:50%; transform:translateX(-50%); z-index:2000; width:min(480px, 92vw);">
            <div style="background:white; border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.18); overflow:hidden; border:2px solid rgba(45,106,79,0.15);">
                <div style="background:linear-gradient(135deg,#1b4332,#2d6a4f); padding:20px 24px; display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <p style="color:rgba(255,255,255,0.8); margin:0; font-size:12px; text-transform:uppercase; letter-spacing:1px;">Join Roots Speech Therapy Centre</p>
                        <h3 style="color:white; margin:4px 0 0; font-size:18px; font-weight:700;">Ready to start your journey? 🌱</h3>
                    </div>
                    <button onclick="document.getElementById('booking-popup').style.display='none'; sessionStorage.setItem('jr_popup_shown','1');" style="background:rgba(255,255,255,0.15); border:none; color:white; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;" title="Close">✕</button>
                </div>
                <div style="padding:24px;">
                    <p style="color:#374151; margin:0 0 16px; line-height:1.6;">Our expert therapists are ready to support your child's development. Book your first session today — available online and in-clinic!</p>
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <a href="{{ route('appointments.create.public') }}" style="background:linear-gradient(135deg,#1b4332,#2d6a4f); color:white; text-decoration:none; padding:12px 24px; border-radius:50px; font-weight:700; font-size:14px; flex:1; text-align:center; min-width:140px;">
                            📅 Book Appointment
                        </a>
                        <a href="https://wa.me/919334892585" target="_blank" style="background:#25D366; color:white; text-decoration:none; padding:12px 18px; border-radius:50px; font-weight:700; font-size:14px; text-align:center; white-space:nowrap;">
                            💬 WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <script>
        (function() {
            if (sessionStorage.getItem('jr_popup_shown')) return;
            setTimeout(function() {
                var popup = document.getElementById('booking-popup');
                if (popup) {
                    popup.style.display = 'block';
                    popup.style.animation = 'popupSlideUp 0.4s ease';
                }
            }, 60000);
        })();
        </script>
        <style>
        @keyframes popupSlideUp {
            from { opacity:0; transform:translateX(-50%) translateY(30px); }
            to   { opacity:1; transform:translateX(-50%) translateY(0); }
        }
        </style>
        @endif

    </div>
</body>
</html>

