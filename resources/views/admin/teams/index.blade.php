@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Team Members</h4>
        <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">Add Team Member</a>
    </div>

    <div class="flex mb-6">
        <form action="{{ route('admin.teams.index') }}" method="GET" class="flex w-full space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search team members..."
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
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Experience</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teams as $team)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $team->name }} {{ $team->surname }}</td>
                            <td>{{ $team->designation }}</td>
                            <td>{{ $team->experience }}</td>
                            <td>
                                @if ($team->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No team members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $teams->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
