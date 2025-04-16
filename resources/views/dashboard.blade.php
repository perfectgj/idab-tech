<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">Dashboard</h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-r from-indigo-500 to-purple-600 flex justify-center items-center p-2">
        <div class="bg-white p-6 rounded-xl shadow-lg max-w-md w-full">
            <h1 class="text-2xl font-bold text-center mb-4 text-indigo-600">🎉 Invite Your Friends!</h1>
            <p class="text-center text-sm text-gray-600 mb-6">Get rewards by sharing your referral link.</p>

            <div class="grid grid-cols-2 gap-4 mb-6 text-center">
                <button onclick="shareWhatsApp()" class="hover:bg-green-50 p-3 rounded-lg">
                    <i class="fab fa-whatsapp text-green-500 text-3xl"></i>
                    <p class="text-xs mt-1">WhatsApp</p>
                </button>
                <button onclick="shareSMS()" class="hover:bg-blue-50 p-3 rounded-lg">
                    <i class="fas fa-sms text-blue-500 text-3xl"></i>
                    <p class="text-xs mt-1">SMS</p>
                </button>
                <button onclick="shareEmail()" class="hover:bg-indigo-50 p-3 rounded-lg">
                    <i class="fas fa-envelope text-indigo-500 text-3xl"></i>
                    <p class="text-xs mt-1">Email</p>
                </button>
                <button onclick="copyUserId()" class="hover:bg-gray-50 p-3 rounded-lg">
                    <i class="fas fa-copy text-gray-600 text-3xl"></i>
                    <p class="text-xs mt-1">Copy</p>
                </button>
            </div>

            <div class="mb-4">
                <input id="referralCode" value="{{ Auth::user()->referral_code }}" readonly
                    class="text-center w-full border rounded-md py-2 px-3 font-semibold text-sm bg-gray-100">
                <p class="text-xs text-center mt-1">Your Referral Code</p>
            </div>

            <div class="input-group mb-3">
                <input type="text" id="phone" class="form-control" placeholder="Phone number"
                    aria-label="Phone number">
                <button class="btn btn-primary" type="button" onclick="sendWhatsAppMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    @include('components.referral-scripts')
</x-app-layout>
