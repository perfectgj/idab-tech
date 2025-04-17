<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Our Team') }}
        </h2>
    </x-slot>

    <div class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center mb-5">Our Team</h1>

            <div class="row g-4">
                @forelse($teams as $member)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="card text-center shadow-sm h-100 border-0">
                            @if ($member->profile_image)
                                <img src="{{ asset('storage/' . $member->profile_image) }}"
                                    class="card-img-top rounded-circle mx-auto mt-3" alt="{{ $member->name }}"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="mx-auto mt-3 rounded-circle bg-secondary"
                                    style="width: 80px; height: 80px;"></div>
                            @endif

                            <div class="card-body p-2">
                                <h6 class="card-title mb-1">{{ $member->name }} {{ $member->surname }}</h6>
                                <p class="text-muted mb-0" style="font-size: 0.85rem;">{{ $member->designation }}</p>
                                @if ($member->experience)
                                    <small class="text-muted d-block">Exp: {{ $member->experience }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No team members available.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $teams->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
