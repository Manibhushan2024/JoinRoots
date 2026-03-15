@extends('layouts.admin')

@section('title', 'Edit Doctor')

@section('admin_content')
<div class="card admin-card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom border-light d-flex align-items-center">
        @if($doctor->photo_url)
            <img src="{{ $doctor->photo_url }}" class="rounded-circle me-3 border shadow-sm" style="width: 48px; height: 48px; object-fit: cover;">
        @else
            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px">
                <i class="fas fa-user-md fa-lg"></i>
            </div>
        @endif
        <h5 class="m-0 fw-bold text-dark">Edit: {{ $doctor->name }}</h5>
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
        
        <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.doctors.form', ['doctor' => $doctor])
        </form>
    </div>
</div>
@endsection
