@extends('layouts.admin')

@section('title', 'Add Review')

@section('admin_content')
<div class="card admin-card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="fas fa-plus-circle me-2 text-warning"></i>Add Client Review</h5>
    </div>
    <div class="card-body p-4 border border-top-0 rounded-bottom">
        <form action="{{ route('admin.reviews.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Role/Relation</label>
                    <input type="text" name="role" class="form-control" placeholder="e.g. Mother of 7-year-old">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Location</label>
                    <input type="text" name="location" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Rating (1-5) <span class="text-danger">*</span></label>
                    <input type="number" name="rating" class="form-control" value="5" min="1" max="5" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Review Text <span class="text-danger">*</span></label>
                    <textarea name="review_text" class="form-control" rows="4" required></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Display Order</label>
                    <input type="number" name="display_order" class="form-control" value="0" min="0">
                </div>
                <div class="col-md-12 mt-4">
                    <div class="form-check form-switch fs-5">
                        <input class="form-check-input" type="checkbox" role="switch" name="is_approved" id="isApproved" checked>
                        <label class="form-check-label" for="isApproved">Approved (Display on website)</label>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-warning"><i class="fas fa-save me-1"></i> Save Review</button>
            </div>
        </form>
    </div>
</div>
@endsection
