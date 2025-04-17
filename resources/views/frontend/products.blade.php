<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        @forelse ($category as $cat)
            <div class="mb-10">
                <!-- Category Title -->
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2 mb-6">
                    {{ $cat->title }}
                </h3>

                @if ($cat->products->count())
                    <div class="space-y-8">
                        @foreach ($cat->products as $product)
                            <div
                                class="flex flex-col md:flex-row items-center bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow p-4 md:p-6 mb-6">
                                <!-- Product Image -->
                                @if (isset($product->image))
                                    <div class="w-full md:w-1/3 flex-shrink-0 mb-4 md:mb-0">
                                        <img src="{{ asset('storage/' . $product->image) }}" height="80" width="80"
                                            class="object-cover rounded-lg" alt="{{ $product->title }}">
                                    </div>
                                @endif

                                <!-- Product Details -->
                                <div class="w-full md:w-2/3 md:pl-6">
                                    <!-- Title and Tooltip -->
                                    <div class="flex items-center mb-3">
                                        <h4 class="text-xl font-semibold text-gray-800">{{ $product->title }}</h4>
                                        @if ($product->info)
                                            <div class="relative group ml-2" title="{{ $product->info }}">
                                                <svg class="w-5 h-5 text-gray-500 cursor-pointer" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9h2v5H9V9zm0-4h2v2H9V5z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Description -->
                                    <p class="text-gray-600 text-sm mb-4">
                                        {{ Str::limit($product->description, 150) }}
                                    </p>

                                    <!-- Price -->
                                    <p class="text-blue-600 font-bold mb-4">${{ number_format($product->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">No products available in this category.</p>
                @endif
            </div>
        @empty
            <p class="text-gray-500 italic">No categories found.</p>
        @endforelse

        <!-- Pagination -->
        <div class="mt-6">
            {{ $category->links() }}
        </div>
    </div>
</x-app-layout>
