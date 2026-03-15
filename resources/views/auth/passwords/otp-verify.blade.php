@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h3 class="fw-bold" style="font-family: 'Fraunces', serif;">Verify OTP</h3>
                        <p class="text-muted small">We've sent a 6-digit code to <strong>{{ $email }}</strong></p>
                    </div>

                    <form method="POST" action="{{ route('password.otp.verify.submit') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        
                        <div class="mb-4 text-center">
                            <label for="otp" class="form-label small fw-bold text-uppercase text-muted d-block mb-3">Enter 6-Digit Code</label>
                            <input id="otp" type="text" class="form-control form-control-lg bg-light border-0 text-center fw-bold @error('otp') is-invalid @enderror" name="otp" required maxlength="6" pattern="\d{6}" style="font-size: 24px; letter-spacing: 8px;" autofocus placeholder="000000">
                            @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold" style="background: linear-gradient(135deg, #1b4332, #2d6a4f); border:none;">
                                Verify Code
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center">
                        <form method="POST" action="{{ route('password.otp.send') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <button type="submit" class="btn btn-link btn-sm text-decoration-none text-muted">Didn't get the code? Resend</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
