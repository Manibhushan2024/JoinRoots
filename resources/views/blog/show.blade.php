@extends('layouts.app')

@section('content')
<div class="container py-5 my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-success text-decoration-none">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 30) }}</li>
                </ol>
            </nav>

            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium mb-3">{{ $blog->category }}</span>
            <h1 class="display-5 fw-bold text-dark mb-4">{{ $blog->title }}</h1>
            
            <div class="d-flex align-items-center mb-5 pb-4 border-bottom">
                <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold me-3 fs-5" style="width:48px; height:48px;">
                    {{ substr($blog->author, 0, 1) }}
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">{{ $blog->author }}</h6>
                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> Published on {{ $blog->published_at->format('F d, Y') }}</small>
                </div>
            </div>
            
            @if($blog->cover_image_url)
                <img src="{{ $blog->cover_image_url }}" class="img-fluid rounded-4 mb-5 shadow-sm w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $blog->title }}">
            @endif

            @if($blog->video_url)
            <div class="mb-5">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="fab fa-youtube text-danger fs-5"></i>
                    <span class="fw-bold text-dark">Watch Video</span>
                </div>
                <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
                    <iframe src="{{ $blog->video_url }}" title="Blog Video" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" class="border-0"></iframe>
                </div>
            </div>
            @endif

            <div class="blog-content fs-5 text-dark" style="line-height: 1.8;">
                {!! $blog->content !!}
            </div>
            
            <div class="mt-5 pt-4 border-top text-center">
                <p class="fw-bold mb-3">Share this article</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; padding: 0; line-height: 40px;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="btn btn-outline-info rounded-circle" style="width: 40px; height: 40px; padding: 0; line-height: 40px;"><i class="fab fa-twitter"></i></a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . request()->url()) }}" target="_blank" class="btn btn-outline-success rounded-circle" style="width: 40px; height: 40px; padding: 0; line-height: 40px;"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($relatedBlogs->count() > 0)
<div class="bg-light py-5 mt-5">
    <div class="container py-4">
        <h3 class="fw-bold mb-4">Related Articles</h3>
        <div class="row g-4">
            @foreach($relatedBlogs as $related)
                <div class="col-md-4">
                    <a href="{{ route('blog.show', $related) }}" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden blog-card">
                            <div class="card-body p-4">
                                <span class="text-primary small fw-bold text-uppercase mb-2 d-block">{{ $related->category }}</span>
                                <h5 class="card-title fw-bold text-dark mb-3">{{ $related->title }}</h5>
                                <div class="d-flex align-items-center mt-auto">
                                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> {{ $related->published_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<style>
    .blog-content h2, .blog-content h3 {
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #1A4331;
    }
    .blog-content p {
        margin-bottom: 1.5rem;
    }
    .blog-content ul, .blog-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    .blog-content li {
        margin-bottom: 0.5rem;
    }
    .blog-card {
        transition: transform 0.3s ease;
    }
    .blog-card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
