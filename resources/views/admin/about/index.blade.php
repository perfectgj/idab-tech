@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">About Us</h2>

        @if (!$about)
            <a href="{{ route('admin.about-us.create') }}" class="btn btn-primary mb-3">Create New</a>
        @else
            <a href="{{ route('admin.about-us.edit') }}" class="btn btn-secondary mb-3">Edit</a>

            <div class="card shadow-sm p-4">
                <h5 class="mb-3">Basic Information</h5>
                <p><strong>Location:</strong> {{ $about->location ?? '-' }}</p>
                <p><strong>Members Count:</strong> {{ $about->members_count ?? '-' }}</p>
                <p><strong>Company DOB:</strong> {{ $about->opening_date ?? '-' }}</p>
                <p><strong>Phone:</strong> {{ $about->phone ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $about->email ?? '-' }}</p>

                @php
                    $urls = json_decode($about->urls, true) ?? [];
                @endphp
                @if (!empty($urls))
                    <hr>
                    <h5 class="mt-3">Redirect Links</h5>
                    <ul>
                        @foreach ($urls as $link)
                            <li>
                                <strong>{{ $link['name'] ?? 'N/A' }}:</strong>
                                @if (!empty($link['url']))
                                    <a href="{{ $link['url'] }}" target="_blank">{{ $link['url'] }}</a>
                                @else
                                    <span>N/A</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if (!empty($about->title) || !empty($about->description))
                    <hr>
                    <h5 class="mt-3">{{ $about->title ?? 'About Us' }}</h5>
                    <p>{{ $about->description ?? '-' }}</p>
                @endif

                @php
                    $visions = json_decode($about->vissions, true) ?? [];
                @endphp
                @if (!empty($visions))
                    <hr>
                    <h5 class="mt-3">Our Visions</h5>
                    @foreach ($visions as $vision)
                        <div class="mb-3 border rounded p-3 bg-light">
                            <h6 class="mb-1">{{ $vision['title'] ?? 'Untitled' }}</h6>
                            @if (!empty($vision['icon']))
                                <div class="mt-1">
                                    @if (isset($vision['icon']) && !empty($vision['icon']))
                                        <img src="{{ asset('storage/' . $vision['icon']) }}" alt="Vision Icon"
                                            class="img-thumbnail" style="max-width: 100px;">
                                    @else
                                        <small>No icon uploaded</small>
                                    @endif
                                </div>
                            @endif
                            <p class="mb-0">{{ $vision['description'] ?? 'No description available.' }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
@endsection
