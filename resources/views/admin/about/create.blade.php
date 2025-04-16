@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Create About Us</h2>
    <form action="{{ route('admin.about-us.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Info -->
        <div class="card mb-4">
            <div class="card-header">Basic Information</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                    <input type="text" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}" required>
                    @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="members_count" class="form-label">Members Count <span class="text-danger">*</span></label>
                    <input type="number" id="members_count" name="members_count" class="form-control @error('members_count') is-invalid @enderror" value="{{ old('members_count') }}" required>
                    @error('members_count') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label for="company_dob" class="form-label">Company DOB <span class="text-danger">*</span></label>
                    <input type="date" id="company_dob" name="company_dob" class="form-control @error('company_dob') is-invalid @enderror" value="{{ old('company_dob') }}" required>
                    @error('company_dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="card mb-4">
            <div class="card-header">Contact Information</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <!-- Redirect Links -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Redirect Links <span class="text-danger">*</span></span>
                <button type="button" class="btn btn-sm btn-primary" id="add-redirect-link">+</button>
            </div>
            <div class="card-body" id="redirect-links-container">
                <div class="row redirect-link g-3 mb-3">
                    <div class="col-md-5">
                        <input type="text" name="redirect_links[0][name]" class="form-control" placeholder="Link Name" required>
                    </div>
                    <div class="col-md-5">
                        <input type="url" name="redirect_links[0][url]" class="form-control" placeholder="Link URL" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-link w-100">-</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Us -->
        <div class="card mb-4">
            <div class="card-header">About Section</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <!-- Visions -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Vision Items <span class="text-danger">*</span></span>
                <button type="button" class="btn btn-sm btn-primary" id="add-vision">+</button>
            </div>
            <div class="card-body" id="visions-container">
                <div class="vision row g-3 mb-3">
                    <div class="col-md-4">
                        <input type="text" name="visions[0][title]" class="form-control" placeholder="Vision Title" required>
                    </div>
                    <div class="col-md-4">
                        <textarea name="visions[0][description]" class="form-control" placeholder="Vision Description" required></textarea>
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="visions[0][icon]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-vision w-100">-</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="text-end">
            <button type="submit" class="btn btn-success px-4">Save</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('add-redirect-link').addEventListener('click', function() {
        const container = document.getElementById('redirect-links-container');
        const index = container.children.length;
        const div = document.createElement('div');
        div.className = 'row redirect-link g-3 mb-3';
        div.innerHTML = `
            <div class="col-md-5">
                <input type="text" name="redirect_links[${index}][name]" class="form-control" placeholder="Link Name" required>
            </div>
            <div class="col-md-5">
                <input type="url" name="redirect_links[${index}][url]" class="form-control" placeholder="Link URL" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-link w-100">-</button>
            </div>
        `;
        container.appendChild(div);
    });

    document.getElementById('redirect-links-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-link') && document.querySelectorAll('.redirect-link').length > 1) {
            e.target.closest('.redirect-link').remove();
        }
    });

    // Visions JS
    document.getElementById('add-vision').addEventListener('click', function() {
        const container = document.getElementById('visions-container');
        const index = container.children.length;
        const div = document.createElement('div');
        div.className = 'vision row g-3 mb-3';
        div.innerHTML = `
            <div class="col-md-4">
                <input type="text" name="visions[${index}][title]" class="form-control" placeholder="Vision Title" required>
            </div>
            <div class="col-md-4">
                <textarea name="visions[${index}][description]" class="form-control" placeholder="Vision Description" required></textarea>
            </div>
            <div class="col-md-3">
                <input type="file" name="visions[${index}][icon]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-vision w-100">-</button>
            </div>
        `;
        container.appendChild(div);
    });

    document.getElementById('visions-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-vision') && document.querySelectorAll('.vision').length > 1) {
            e.target.closest('.vision').remove();
        }
    });
</script>
@endsection
