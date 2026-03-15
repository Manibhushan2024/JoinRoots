@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name ?? '') }}" required>
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Designation <span class="text-danger">*</span></label>
        <input type="text" name="designation" class="form-control" value="{{ old('designation', $doctor->designation ?? '') }}" required>
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Qualification</label>
        <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $doctor->qualification ?? '') }}">
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Specializations</label>
        <input type="text" name="specializations" class="form-control" placeholder="e.g. ASD, ADHD, Speech" value="{{ old('specializations', $doctor->specializations ?? '') }}">
        <div class="form-text">Comma separated values</div>
    </div>
    
    <div class="col-md-12">
        <label class="form-label fw-bold">Bio</label>
        <textarea name="bio" class="form-control" rows="4">{{ old('bio', $doctor->bio ?? '') }}</textarea>
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Years of Experience <span class="text-danger">*</span></label>
        <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years', $doctor->experience_years ?? 0) }}" min="0" required>
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Display Order</label>
        <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $doctor->display_order ?? 0) }}" min="0">
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email ?? '') }}">
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone ?? '') }}">
    </div>
    
    <div class="col-md-6">
        <label class="form-label fw-bold">Profile Photo</label>
        <input type="file" name="photo" class="form-control" accept="image/*">
        @if(isset($doctor) && $doctor->photo_url)
            <div class="mt-2 text-muted">Current photo uploaded.</div>
        @endif
    </div>
    
    <div class="col-md-12 mt-4">
        <div class="form-check form-switch fs-5">
            <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="isActive" {{ old('is_active', $doctor->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isActive">Active (Display on website)</label>
        </div>
    </div>
</div>

<div class="mt-4 pt-3 border-top d-flex justify-content-end">
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
    <button type="submit" class="btn btn-success"><i class="fas fa-save me-1"></i> Save Doctor</button>
</div>
