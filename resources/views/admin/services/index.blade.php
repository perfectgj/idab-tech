@extends('layouts.admin')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Services</h4>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add Service</a>
        </div>

        <div class="flex mb-6">
            <form action="{{ route('admin.services.index') }}" method="GET" class="flex w-full space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services..."
                    class="flex-grow border border-gray-300 rounded px-4 py-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded bg-primary">Search</button>
            </form>
        </div>

        <div class="card shadow">
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->title }}</td>
                                <td>
                                    @if ($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" width="50" alt="Image">
                                    @endif
                                </td>
                                <td>
                                    @if ($service->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.edit', $service->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete this service?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $services->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
