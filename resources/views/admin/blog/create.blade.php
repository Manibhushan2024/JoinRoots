@extends('layouts.admin')

@section('title', 'Admin Blog Form')

@section('admin_content')
<div class="card admin-card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="{{ isset($blog) ? 'fas fa-edit' : 'fas fa-plus-circle' }} me-2 text-primary"></i>{{ isset($blog) ? 'Edit Post: ' . $blog->title : 'Create New Post' }}</h5>
    </div>
    <div class="card-body p-4 border border-top-0 rounded-bottom">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ isset($blog) ? route('admin.blog.update', $blog) : route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($blog)) @method('PUT') @endif
            
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Post Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control form-control-lg" value="{{ old('title', $blog->title ?? '') }}" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Author</label>
                    <input type="text" name="author" class="form-control" value="{{ old('author', $blog->author ?? 'JoinRoots Team') }}">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Category</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $blog->category ?? 'General') }}">
                </div>
                
                <div class="col-md-12">
                    <label class="form-label fw-bold">Short Excerpt (Teaser)</label>
                    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                </div>
                
                <div class="col-md-12">
                    <label class="form-label fw-bold">Main Content (HTML Supported) <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control" rows="15" required>{{ old('content', $blog->content ?? '') }}</textarea>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Cover Image</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                    @if(isset($blog) && $blog->cover_image_url)
                        <div class="mt-2 text-success"><i class="fas fa-check-circle"></i> Image already uploaded. Uploading new replaces it.</div>
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold"><i class="fab fa-youtube text-danger me-1"></i> Video URL (YouTube / Vimeo)</label>
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $blog->video_url ?? '') }}" placeholder="https://www.youtube.com/embed/VIDEO_ID">
                    <div class="form-text text-muted">Paste a YouTube embed URL. Leave blank if no video.</div>
                </div>
                
                <div class="col-md-12 mt-4">
                    <div class="form-check form-switch fs-5 p-3 bg-light rounded border border-success border-opacity-25">
                        <input class="form-check-input ms-0 me-3 mt-1" type="checkbox" role="switch" name="is_published" id="isPublished" {{ old('is_published', $blog->is_published ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isPublished">Publish immediately</label>
                        <div class="text-muted fs-6 mb-0 mt-1 ms-4 d-block" style="padding-left: 1.5rem">Checking this makes the post visible to the public.</div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-top d-flex justify-content-end">
                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Post</button>
            </div>
        </form>
    </div>
</div>
@endsection
