@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="flex mb-6">
        <form action="{{ route('admin.contact_us.index') }}" method="GET" class="flex w-full space-x-2">
            <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search contact requests..."
                class="flex-grow border border-gray-300 rounded px-4 py-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded bg-primary">Search</button>
        </form>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h4>Contact Us Requests</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->country }}</td>
                            <td>
                                <a href="{{ route('admin.contact_us.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('admin.contact_us.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
