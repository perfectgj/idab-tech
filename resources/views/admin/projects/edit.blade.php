@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">✏️ Edit Project</h2>
        @include('admin.projects._form', [
            'route' => route('admin.projects.update', $project->id),
            'method' => 'PUT',
            'project' => $project,
        ])
    </div>
@endsection
