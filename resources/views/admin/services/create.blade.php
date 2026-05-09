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
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image URL (Optional)</label>
                        <input type="url" name="image_url" class="form-control" value="{{ old('image_url') }}">
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" class="form-control" required min="15" value="{{ old('duration_minutes', 60) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Online Price (&#8377;)</label>
                            <input type="number" step="0.01" name="online_price" id="online_price" class="form-control" required min="0" value="{{ old('online_price') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Online Discount (&#8377;)</label>
                            <input type="number" step="0.01" name="online_discount" id="online_discount" class="form-control" min="0" value="{{ old('online_discount', 0) }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Offline Price (&#8377;)</label>
                            <input type="number" step="0.01" name="offline_price" id="offline_price" class="form-control" required min="0" value="{{ old('offline_price') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Offline Discount (&#8377;)</label>
                            <input type="number" step="0.01" name="offline_discount" id="offline_discount" class="form-control" min="0" value="{{ old('offline_discount', 0) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Rating (1-5, Optional)</label>
                            <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating') }}">
                        </div>
                    </div>
                    <div class="alert alert-light border">
                        Customers will see the original price crossed out and the discounted price beside it.
                        Online final price: <strong id="online_final_preview">&#8377;0</strong>.
                        Offline final price: <strong id="offline_final_preview">&#8377;0</strong>.
                    </div>
                    <button type="submit" class="btn btn-primary">Save Service</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const onlinePrice = document.getElementById('online_price');
    const onlineDiscount = document.getElementById('online_discount');
    const offlinePrice = document.getElementById('offline_price');
    const offlineDiscount = document.getElementById('offline_discount');
    const onlinePreview = document.getElementById('online_final_preview');
    const offlinePreview = document.getElementById('offline_final_preview');

    const formatMoney = (value) => new Intl.NumberFormat('en-IN', {
        minimumFractionDigits: value % 1 === 0 ? 0 : 2,
        maximumFractionDigits: 2,
    }).format(value);

    const updatePreview = () => {
        const onlineFinal = Math.max(0, (parseFloat(onlinePrice.value) || 0) - (parseFloat(onlineDiscount.value) || 0));
        const offlineFinal = Math.max(0, (parseFloat(offlinePrice.value) || 0) - (parseFloat(offlineDiscount.value) || 0));

        onlinePreview.innerHTML = '&#8377;' + formatMoney(onlineFinal);
        offlinePreview.innerHTML = '&#8377;' + formatMoney(offlineFinal);
    };

    [onlinePrice, onlineDiscount, offlinePrice, offlineDiscount].forEach((input) => {
        input.addEventListener('input', updatePreview);
    });

    updatePreview();
});
</script>
@endsection
