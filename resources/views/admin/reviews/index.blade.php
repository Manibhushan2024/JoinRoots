@extends('layouts.admin')

@section('title', 'Manage Reviews')

@section('admin_content')
<div class="card admin-card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="fas fa-star me-2 text-warning"></i>Manage Client Reviews</h5>
        <a href="{{ route('admin.reviews.create') }}" class="btn btn-warning text-dark"><i class="fas fa-plus me-1"></i> Add Review</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Reviewer</th>
                        <th>Rating</th>
                        <th>Snippet</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; background-color: {{ $review->avatar_color }}">
                                        {{ substr($review->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $review->name }}</h6>
                                        <small class="text-muted">{{ $review->role }}{{ $review->location ? ', ' . $review->location : '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-warning">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-black-50' }}"></i>
                                    @endfor
                                </div>
                            </td>
                            <td><div class="text-dark small" style="max-width:300px">{{ Str::limit($review->review_text, 50) }}</div></td>
                            <td>
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm shadow-sm {{ $review->is_approved ? 'btn-success' : 'btn-outline-secondary' }}">
                                        @if($review->is_approved)
                                            <i class="fas fa-check me-1"></i> Approved
                                        @else
                                            <i class="fas fa-times me-1"></i> Hidden
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-sm btn-outline-primary shadow-sm me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this review?');">
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
                                <i class="fas fa-star text-warning text-opacity-50 fa-3x mb-3"></i>
                                <h6>No reviews found</h6>
                                <p class="mb-0">Get started by capturing feedback from your clients.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
