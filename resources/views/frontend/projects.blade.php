<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse ($projects as $project)
                    <div class="col">
                        <a href="{{ $project->link ?? '#' }}" target="_blank" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm border-0 hover-shadow" style="transition: transform 0.3s;">
                                @if ($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top"
                                        alt="{{ $project->title }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title"><b>{{ $project->title }}</b></h5>
                                    <p class="card-text">{{ $project->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No active projects found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $projects->links() }}
            </div>
        </div>
    </div>

    <style>
        .card:hover {
            transform: scale(1.02);
        }
    </style>
</x-app-layout>
