@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="fas fa-key fa-2x"></i>
                        </div>
                        <h3 class="fw-bold" style="font-family: 'Fraunces', serif;">Reset Password</h3>
                        <p class="text-muted small">Enter your email to receive a 6-digit OTP code.</p>
                    </div>

                    <form method="POST" action="{{ route('password.otp.send') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                            <input id="email" type="email" class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold" style="background: linear-gradient(135deg, #1b4332, #2d6a4f); border:none;">
                                Send OTP Code
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none small text-muted">
                            <i class="fas fa-arrow-left me-1"></i> Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
