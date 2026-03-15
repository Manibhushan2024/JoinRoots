@extends('layouts.app')

@section('title', 'Manage Contacts')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ route('admin.services.index') }}" class="list-group-item list-group-item-action">Services</a>
            <a href="{{ route('admin.appointments.index') }}" class="list-group-item list-group-item-action">Appointments</a>
            <a href="{{ route('admin.contacts.index') }}" class="list-group-item list-group-item-action active">Contacts</a>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">Manage Contact Inquiries</div>

            <div class="card-body">
                @if($contacts->isEmpty())
                    <p>No messages found.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone ?? 'N/A' }}</td>
                                <td>{{ Str::limit($contact->message, 50) }}</td>
                                <td>
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?');">
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
