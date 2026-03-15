@extends('layouts.app')

@section('title', 'Contact Us | JoinRoots')

@section('content')
<!-- Hero Section -->
<div class="py-5 bg-primary text-white text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #2D6A4F 0%, #1B4332 100%);">
    <div class="container position-relative z-index-1 py-5">
        <h1 class="display-4 fw-bold mb-3">Get in Touch</h1>
        <p class="lead mx-auto" style="max-width: 600px; color: rgba(255,255,255,.8);">
            We are here to support your child's journey. Reach out to us for appointments, inquiries, or any questions you might have.
        </p>
    </div>
    <!-- Decor -->
    <div class="position-absolute" style="top: -50px; left: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
    <div class="position-absolute" style="bottom: -100px; right: 10%; width: 300px; height: 300px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
</div>

<div class="container py-5 my-5">
    <div class="row g-5">
        <!-- Contact Information -->
        <div class="col-lg-5">
            <div class="pe-lg-4">
                <h2 class="fw-bold mb-4" style="color: #1B2B25; font-family: 'Fraunces', serif;">How Can We Help?</h2>
                <p class="text-muted mb-5" style="font-size: 1.1rem; line-height: 1.7;">
                    Whether you're looking for a specific therapy, want to confirm an appointment locally across Delhi NCR, or need general advice, our team is ready to listen.
                </p>

                <div class="d-flex align-items-center mb-4 p-4 rounded-4 shadow-sm bg-white" style="transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-4" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Call Us Directly</h5>
                        <p class="text-muted mb-0">+91 93348 92585</p>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 p-4 rounded-4 shadow-sm bg-white" style="transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-4" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">WhatsApp Us</h5>
                        <a href="https://wa.me/919334892585?text=Hi%20Connect%20Roots" target="_blank" class="text-decoration-none text-muted stretched-link">+91 93348 92585</a>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4 p-4 rounded-4 shadow-sm bg-white" style="transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-4" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Email Support</h5>
                        <a href="mailto:connnectingroots.support@gmail.com" class="text-muted text-decoration-none stretched-link" style="word-break: break-all;">connnectingroots.support@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="background: #fff;">
                <div class="card-body p-5">
                    <h3 class="fw-bold mb-4">Send a Message</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-4 border-0 bg-success bg-opacity-10 text-success rounded-3" role="alert">
                            <i class="fas fa-check-circle me-3 fs-4"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold small text-muted text-uppercase letter-spacing-1">Your Name</label>
                                <input type="text" class="form-control form-control-lg bg-light border-0" id="name" name="name" value="{{ old('name', auth()->user()->name ?? '') }}" required placeholder="John Doe">
                                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold small text-muted text-uppercase letter-spacing-1">Email Address</label>
                                <input type="email" class="form-control form-control-lg bg-light border-0" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required placeholder="john@example.com">
                                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label fw-bold small text-muted text-uppercase letter-spacing-1">Phone Number (Optional)</label>
                                <input type="tel" class="form-control form-control-lg bg-light border-0" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" placeholder="+91 0000 000000">
                                @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label fw-bold small text-muted text-uppercase letter-spacing-1">Your Message</label>
                                <textarea class="form-control form-control-lg bg-light border-0" id="message" name="message" rows="5" required placeholder="How can we help you today?">{{ old('message') }}</textarea>
                                @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 rounded-pill fw-bold shadow-sm" style="background: linear-gradient(135deg, #2D6A4F, #52B788); border: none;">
                                    Send Message <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="bg-light py-5 mt-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold text-uppercase mb-3 letter-spacing-1">FAQ</span>
            <h2 class="fw-bold font-fraunces" style="font-family: 'Fraunces', serif; color: #1B2B25;">Frequently Asked Questions</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">Find answers to common questions about our therapy services, bookings, and policies.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="faqAccordion">
                    
                    <div class="accordion-item bg-transparent border-bottom py-3">
                        <h2 class="accordion-header" id="faq-1">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1">
                                How do I book an appointment?
                            </button>
                        </h2>
                        <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted line-height-lg">
                                You can easily book an appointment by navigating to our booking portal. Choose your preferred service, therapist, and available time slot. You can opt for an online consultation or an in-clinic visit in Delhi NCR.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent border-bottom py-3">
                        <h2 class="accordion-header" id="faq-2">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2">
                                What is the duration of a standard therapy session?
                            </button>
                        </h2>
                        <div id="collapse-2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted line-height-lg">
                                Therapy sessions generally last for 60 minutes. Therapists maintain a 15-minute gap between appointments to ensure privacy, preparation, and proper sanitisation of the clinical space.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent border-bottom py-3">
                        <h2 class="accordion-header" id="faq-3">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3">
                                Do you provide early intervention for Autism (ASD) and ADHD?
                            </button>
                        </h2>
                        <div id="collapse-3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted line-height-lg">
                                Yes, our clinic specializes in child development and neurology. We have highly experienced Child Psychologists, Speech Therapists, and ABA/Behavioral experts that provide tailored early interventions for neurodivergent children.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item bg-transparent border-bottom py-3">
                        <h2 class="accordion-header" id="faq-4">
                            <button class="accordion-button collapsed bg-transparent fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4">
                                Which payment methods do you accept?
                            </button>
                        </h2>
                        <div id="collapse-4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted line-height-lg">
                                We securely process partial and full payments online (UPI, Cards, NetBanking). For in-clinic sessions, we also accept direct offline payments via card terminals and UPI scanners.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .font-fraunces { font-family: 'Fraunces', serif; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .line-height-lg { line-height: 1.8; }
    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%232D6A4F'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    .accordion-button:hover {
        color: #2D6A4F;
    }
    .accordion-button:not(.collapsed) {
        color: #2D6A4F;
        background-color: transparent;
        box-shadow: none;
    }
    .accordion-button:focus {
        border-color: transparent;
        box-shadow: none;
    }
</style>
@endsection
