@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h4>{{ isset($team) ? 'Edit' : 'Add' }} Team Member</h4>
            </div>
            <div class="card-body">
                <form action="{{ isset($team) ? route('admin.teams.update', $team->id) : route('admin.teams.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($team))
                        @method('PUT')
                    @endif

                    <!-- Name Field -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{ old('name', $team->name ?? '') }}"
                            class="form-control" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Surname Field -->
                    <div class="mb-3">
                        <label class="form-label">Surname</label>
                        <input type="text" name="surname" value="{{ old('surname', $team->surname ?? '') }}"
                            class="form-control" required>
                        @error('surname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Designation Field -->
                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" name="designation" value="{{ old('designation', $team->designation ?? '') }}"
                            class="form-control" required>
                        @error('designation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Experience Field -->
                    <div class="mb-3">
                        <label class="form-label">Experience</label>
                        <input type="text" name="experience" value="{{ old('experience', $team->experience ?? '') }}"
                            class="form-control">
                        @error('experience')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Profile Image Field -->
                    <div class="mb-3">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="profile_image" class="form-control">
                        @if (isset($team) && $team->profile_image)
                            <img src="{{ asset('storage/' . $team->profile_image) }}" class="mt-2" width="100">
                        @endif
                        @error('profile_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Checkbox -->
                    <div class="form-check mb-3">
                        <input type="checkbox" name="status" class="form-check-input" id="statusCheck"
                            {{ old('status', $team->status ?? true) ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="statusCheck">Active</label>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
