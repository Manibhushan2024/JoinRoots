@extends('layouts.admin')

@section('title', 'Manage Blog')

@section('admin_content')
<div class="card admin-card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="fas fa-blog me-2 text-primary"></i>Manage Blog Posts</h5>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> New Post</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td class="ps-4">
                                <h6 class="mb-0 fw-bold text-dark">{{ Str::limit($post->title, 50) }}</h6>
                                <small class="text-muted">By {{ $post->author }}</small>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $post->category }}</span></td>
                            <td>
                                @if($post->is_published)
                                    <span class="badge bg-success rounded-pill px-3">Published</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('M d, Y') : '-' }}</td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-outline-primary shadow-sm me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-newspaper fa-3x mb-3 text-light"></i>
                                <h6>No blog posts found</h6>
                                <p class="mb-0">Start sharing your expertise and stories.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
