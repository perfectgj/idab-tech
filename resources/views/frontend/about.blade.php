<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            {{-- Info Boxes --}}
            @if (isset($about) &&
                    !empty($about) &&
                    (!empty($about->company_name) ||
                        !empty($about->location) ||
                        !empty($about->members_count) ||
                        !empty($about->opening_date)))
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-2">
                        @if (isset($about->company_name) && !empty($about->company_name))
                            <div class="text-lg">🏢 <span class="font-semibold">{{ $about->company_name ?? '' }}</span>
                            </div>
                        @endif
                        @if (isset($about->location) && !empty($about->location))
                            <div class="text-lg">📍 <span class="font-semibold">{{ $about->location ?? '' }}</span></div>
                        @endif
                        @if (isset($about->members_count) && !empty($about->members_count))
                            <div class="text-lg">👥 <span class="font-semibold">{{ $about->members_count ?? 0 }}</span>
                                Members
                            </div>
                        @endif
                        @if (isset($about->opening_date) && !empty($about->opening_date))
                            <div class="text-lg">📅 <span
                                    class="font-semibold">{{ \Carbon\Carbon::parse($about->opening_date ?? now())->format('d F, Y') }}</span>
                        @endif
                    </div>
                </div>
            @endif

            @if (isset($about) && !empty($about) && (!empty($about->urls) || !empty($about->phone) || !empty($about->email)))

                <div class="bg-white p-6 rounded-xl shadow border border-gray-100 space-y-2">
                    <div class="text-lg">
                        🌐
                        @foreach ($about->urls as $link)
                            <a href="{{ $link['url'] }}" target="_blank"
                                class="text-blue-600 hover:underline font-medium">
                                {{ $link['name'] }}
                            </a>{{ !$loop->last ? ' | ' : '' }}
                        @endforeach
                    </div>
                    <div class="text-lg">📞 <span class="font-semibold">{{ $about->phone ?? '' }}</span></div>
                    <div class="text-lg">📧 <span class="font-semibold">{{ $about->email ?? '' }}</span></div>
                </div>
            @endif
        </div>

        @if ((isset($about) && !empty($about) && !empty($about->title)) || !empty($about->description))
            {{-- About Description --}}
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $about->title ?? '' }}</h3>
                <p class="text-gray-700 leading-relaxed">
                    {{ $about->description ?? '' }}
                </p>
            </div>
        @endif

        @if (isset($about) && !empty($about) && !empty($about->vissions))
            {{-- Accordion for Visions --}}
            <div class="accordion mb-6" id="accordionExample">
                @foreach ($about->vissions as $index => $vision)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="collapse{{ $index }}">
                                @if (!empty($vision['icon']) && file_exists(public_path('storage/' . $vision['icon'])))
                                    <img src="{{ asset('storage/' . $vision['icon']) }}" alt="icon" class="me-2"
                                        width="24" height="24">
                                @else
                                    <span class="me-2">⭐</span>
                                @endif
                                {{ $vision['title'] }}
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}"
                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                            aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body text-sm text-gray-800">
                                {{ $vision['description'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</x-app-layout>
