<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Our Services') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @forelse ($services as $service)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 hover-shadow" style="transition: transform 0.3s;">
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                    alt="{{ $service->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title"><b>{{ $service->title }}</b></h5>
                                <p class="card-text">{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No active services found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $services->links() }}
            </div>
        </div>
    </div>

    <style>
        .card:hover {
            transform: scale(1.02);
        }
    </style>
</x-app-layout>
