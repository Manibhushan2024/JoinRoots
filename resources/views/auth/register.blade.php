@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-4 d-none d-md-block" style="background: linear-gradient(135deg, #1b4332, #2d6a4f); color: white;">
                        <div class="p-5 h-100 d-flex flex-column justify-content-center text-center">
                            <i class="fas fa-hand-holding-heart fa-4x mb-4"></i>
                            <h2 class="fw-bold mb-3" style="font-family: 'Fraunces', serif;">Join Our Community</h2>
                            <p class="small opacity-75">Register today to start your journey towards holistic healing and developmental growth for your child.</p>
                            <div class="mt-4 pt-4 border-top border-white border-opacity-25">
                                <ul class="list-unstyled text-start small mb-0">
                                    <li class="mb-3"><i class="fas fa-check-circle me-2 text-success"></i> Expert consultations</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2 text-success"></i> Secure online sessions</li>
                                    <li><i class="fas fa-check-circle me-2 text-success"></i> Detailed therapy tracking</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="p-5">
                            <div class="mb-4">
                                <h3 class="fw-bold" style="font-family: 'Fraunces', serif;">Patient Registration</h3>
                                <p class="text-muted small">Fill in the details below to create your account.</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6 text-start">
                                        <label for="name" class="form-label small fw-bold text-uppercase text-muted">Full Name</label>
                                        <input id="name" type="text" class="form-control bg-light border-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">
                                        @error('name') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-md-6 text-start">
                                        <label for="email" class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                                        <input id="email" type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="john@example.com">
                                        @error('email') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-md-6 text-start">
                                        <label for="password" class="form-label small fw-bold text-uppercase text-muted">Password</label>
                                        <input id="password" type="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-md-6 text-start">
                                        <label for="password-confirm" class="form-label small fw-bold text-uppercase text-muted">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control bg-light border-0" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="col-md-6 text-start">
                                        <label for="phone" class="form-label small fw-bold text-uppercase text-muted">Phone Number</label>
                                        <input id="phone" type="text" class="form-control bg-light border-0 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="9334892585">
                                        @error('phone') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-md-3 text-start">
                                        <label for="age" class="form-label small fw-bold text-uppercase text-muted">Patient Age</label>
                                        <input id="age" type="number" class="form-control bg-light border-0 @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}">
                                        @error('age') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-md-3 text-start">
                                        <label for="relation_with_child" class="form-label small fw-bold text-uppercase text-muted">Relation</label>
                                        <input id="relation_with_child" type="text" class="form-control bg-light border-0 @error('relation_with_child') is-invalid @enderror" name="relation_with_child" value="{{ old('relation_with_child') }}" placeholder="Father/Mother">
                                        @error('relation_with_child') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-12 text-start">
                                        <label for="address" class="form-label small fw-bold text-uppercase text-muted">Full Address</label>
                                        <textarea id="address" rows="2" class="form-control bg-light border-0 @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                                        @error('address') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>

                                    <div class="col-12 text-start">
                                        <label for="medical_history" class="form-label small fw-bold text-uppercase text-muted">Previous Medical History (Optional)</label>
                                        <textarea id="medical_history" rows="2" class="form-control bg-light border-0 @error('medical_history') is-invalid @enderror" name="medical_history">{{ old('medical_history') }}</textarea>
                                        @error('medical_history') <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span> @enderror
                                    </div>
                                </div>

                                <div class="d-grid mt-4 pt-2">
                                    <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold py-3" style="background: linear-gradient(135deg, #1b4332, #2d6a4f); border:none; box-shadow: 0 10px 20px rgba(27,67,50,0.2);">
                                        Create My Account
                                    </button>
                                </div>

                                <div class="text-center mt-4 pt-2">
                                    <p class="small text-muted mb-0">Already have an account? <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">Sign In instead</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

