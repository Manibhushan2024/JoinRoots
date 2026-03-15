@extends('layouts.app')

@section('title', 'Add New Service')

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
            <div class="card-header">Add New Service</div>

            <div class="card-body">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image URL (Optional)</label>
                        <input type="url" name="image_url" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label>Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" class="form-control" required min="15" value="60">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Online Price (₹)</label>
                            <input type="number" step="0.01" name="online_price" class="form-control" required min="0">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Offline Price (₹)</label>
                            <input type="number" step="0.01" name="offline_price" class="form-control" required min="0">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Rating (1-5, Optional)</label>
                            <input type="number" name="rating" class="form-control" min="1" max="5">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Service</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
