@extends('layouts.admin')

@section('title', 'Add Doctor')

@section('admin_content')
<div class="card admin-card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom border-light">
        <h5 class="m-0 fw-bold text-dark"><i class="fas fa-plus-circle me-2 text-success"></i>Add New Doctor/Therapist</h5>
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
        
        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.doctors.form')
        </form>
    </div>
</div>
@endsection
