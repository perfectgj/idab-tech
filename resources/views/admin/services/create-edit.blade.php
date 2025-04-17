@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h4>{{ isset($service) ? 'Edit' : 'Add' }} Service</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Please fix the following issues:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($service))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}"
                            class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description ?? '') }}</textarea>
                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                        @if (!empty($service->image))
                            <img src="{{ asset('storage/' . $service->image) }}" class="mt-2" width="100">
                        @endif
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="status" class="form-check-input" id="statusCheck"
                            {{ old('status', $service->status ?? true) ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="statusCheck">Active</label>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
