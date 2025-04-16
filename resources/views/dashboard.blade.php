<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center px-4">
        <div class="bg-white rounded-2xl shadow-xl p-10 max-w-lg w-full text-center space-y-6">

            {{-- Heading --}}
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">
                We are the <span class="text-indigo-600">Business Transformers!</span>
            </h1>

            {{-- Create i-Card Button --}}
            <a href="{{ route('icard.create') }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition duration-300 ease-in-out">
                Create i-Card
            </a>

            {{-- Share Options --}}
            <div class="pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500 mb-2">Share with your network</p>
                <div class="flex justify-center gap-4 text-xl">
                    {{-- {!! Share::page(url()->current(), 'Check out this i-Card!')
                        ->facebook()
                        ->twitter()
                        ->linkedin()
                        ->whatsapp()
                        ->telegram() !!} --}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
