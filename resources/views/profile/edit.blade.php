@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Profile</div>

            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>
                        <div class="col-md-6">
                            <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age', $user->age) }}">
                            @error('age')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="relation_with_child" class="col-md-4 col-form-label text-md-end">{{ __('Relation with Child') }}</label>
                        <div class="col-md-6">
                            <input id="relation_with_child" type="text" class="form-control @error('relation_with_child') is-invalid @enderror" name="relation_with_child" value="{{ old('relation_with_child', $user->relation_with_child) }}">
                            @error('relation_with_child')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                        <div class="col-md-6">
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address', $user->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="medical_history" class="col-md-4 col-form-label text-md-end">{{ __('Medical History') }}</label>
                        <div class="col-md-6">
                            <textarea id="medical_history" class="form-control @error('medical_history') is-invalid @enderror" name="medical_history">{{ old('medical_history', $user->medical_history) }}</textarea>
                            @error('medical_history')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="profile_image" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>
                        <div class="col-md-6">
                            <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/'.$user->profile_image) }}" class="mt-2" style="max-height: 100px;">
                            @endif
                            @error('profile_image')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
