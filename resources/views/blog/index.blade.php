@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="py-5 bg-light" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold text-dark mb-3">Therapy & Parenting Insights</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            Expert articles, tips, and updates from the JoinRoots Team of pediatricians, psychologists, and therapists in Delhi NCR.
        </p>
    </div>
</div>

<div class="container py-5 my-4">
    <div class="row g-4">
        @forelse($blogs as $blog)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden blog-card">
                    @if($blog->cover_image_url)
                        <img src="{{ $blog->cover_image_url }}" class="card-img-top" alt="{{ $blog->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-success bg-opacity-10 d-flex align-items-center justify-content-center text-success" style="height: 200px;">
                            <i class="fas fa-image fa-3x opacity-50"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium">{{ $blog->category }}</span>
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> {{ $blog->published_at->format('M d, Y') }}</small>
                        </div>
                        <h4 class="card-title fw-bold">
                            <a href="{{ route('blog.show', $blog) }}" class="text-dark text-decoration-none text-hover-success">{{ $blog->title }}</a>
                        </h4>
                        <p class="card-text text-muted mb-4">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}</p>
                        <div class="mt-auto d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold me-2" style="width:32px; height:32px; font-size:14px;">
                                    {{ substr($blog->author, 0, 1) }}
                                </div>
                                <span class="fw-medium small text-dark">{{ $blog->author }}</span>
                            </div>
                            <a href="{{ route('blog.show', $blog) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-light rounded-4">
                    <i class="fas fa-book-open fa-3x text-muted mb-3 opacity-50"></i>
                    <h3 class="fw-bold">No articles yet</h3>
                    <p class="text-muted">Check back soon for insights from our expert team.</p>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="d-flex justify-content-center mt-5">
        {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
</div>

<style>
    .blog-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .text-hover-success:hover {
        color: #198754 !important;
    }
</style>
@endsection
