@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ route('admin.services.index') }}" class="list-group-item list-group-item-action active">Services</a>
            <a href="{{ route('admin.appointments.index') }}" class="list-group-item list-group-item-action">Appointments</a>
            <a href="{{ route('admin.contacts.index') }}" class="list-group-item list-group-item-action">Contacts</a>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Edit Service: {{ $service->title }}</div>

            <div class="card-body">
                <form action="{{ route('admin.services.update', $service) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ $service->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image URL (Optional)</label>
                        <input type="url" name="image_url" class="form-control" value="{{ $service->image_url }}">
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" class="form-control" required min="15" value="{{ $service->duration_minutes }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Online Price (₹)</label>
                            <input type="number" step="0.01" name="online_price" class="form-control" required min="0" value="{{ $service->online_price }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Offline Price (₹)</label>
                            <input type="number" step="0.01" name="offline_price" class="form-control" required min="0" value="{{ $service->offline_price }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Rating (1-5)</label>
                            <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ $service->rating }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
