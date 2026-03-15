@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="fas fa-lock-open fa-2x"></i>
                        </div>
                        <h3 class="fw-bold" style="font-family: 'Fraunces', serif;">Update Password</h3>
                        <p class="text-muted small">Choose a new secure password for your account.</p>
                    </div>

                    <form method="POST" action="{{ route('password.otp.reset.submit') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="otp" value="{{ $otp }}">
                        
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold text-uppercase text-muted">New Password</label>
                            <input id="password" type="password" class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label small fw-bold text-uppercase text-muted">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg bg-light border-0" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold" style="background: linear-gradient(135deg, #1b4332, #2d6a4f); border:none;">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
