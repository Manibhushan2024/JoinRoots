@extends('layouts.app')

@section('title', 'Manage Services')

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
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Manage Services</span>
                <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary">Add New Service</a>
            </div>

            <div class="card-body">
                @if($services->isEmpty())
                    <p>No services found.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Online Pricing</th>
                                <th>Offline Pricing</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->duration_minutes }} min</td>
                                <td>
                                    <div class="fw-semibold">&#8377;{{ number_format($service->online_price, 2) }}</div>
                                    @if($service->has_online_discount)
                                        <div class="small text-danger">Discount: -&#8377;{{ number_format($service->online_discount, 2) }}</div>
                                        <div class="small fw-semibold text-success">Final: &#8377;{{ number_format($service->discounted_online_price, 2) }}</div>
                                    @else
                                        <div class="small text-muted">No discount</div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold">&#8377;{{ number_format($service->offline_price, 2) }}</div>
                                    @if($service->has_offline_discount)
                                        <div class="small text-danger">Discount: -&#8377;{{ number_format($service->offline_discount, 2) }}</div>
                                        <div class="small fw-semibold text-success">Final: &#8377;{{ number_format($service->discounted_offline_price, 2) }}</div>
                                    @else
                                        <div class="small text-muted">No discount</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
