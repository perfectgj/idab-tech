@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Projects</h2>
        <a href="{{ route('admin.projects.create') }}" class="bg-primary bg-blue-600 text-white px-4 py-2 rounded">Add Project</a>
    </div>

    <!-- Search Form -->
    <div class="flex mb-6">
        <form action="{{ route('admin.projects.index') }}" method="GET" class="flex w-full space-x-2">
            <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search projects..."
                class="flex-grow border border-gray-300 rounded px-4 py-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded bg-primary">Search</button>
        </form>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr class="border-b">
                        <td class="p-2">{{ $loop->iteration }}</td>
                        <td class="p-2">{{ $project->title }}</td>
                        <td class="p-2">
                            @if($project->status)
                                <span class="text-green-600">Active</span>
                            @else
                                <span class="text-red-600">Inactive</span>
                            @endif
                        </td>
                        <td class="p-2 space-x-2">
                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600 transition bg-warning text-decoration-none">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                  class="inline-block" onsubmit="return confirm('Delete this project?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition">
                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($projects->isEmpty())
                    <tr><td colspan="4" class="text-center py-4 text-gray-500">No projects found.</td></tr>
                @endif
            </tbody>
        </table>

        <div class="mt-4">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
