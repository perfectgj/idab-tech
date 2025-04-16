<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <!-- Main container: centered white card on a light-gray background -->
    <div class="min-h-screen">
        <div class="bg-white rounded-xl shadow-xl p-8 max-w-md w-full">
            <!-- Main Heading -->
            <h1 class="text-2xl font-bold text-center mb-6">We are the Business Transformers!</h1>

            <!-- Re: Share Container -->
            <div class="bg-gray-50 rounded-xl p-6 shadow-sm">
                <!-- Title -->
                <h2 class="text-lg font-semibold mb-4 text-center">Re: Share</h2>

                <!-- Share Options: four icons with labels -->
                <div class="flex justify-between items-center mb-6">
                    <!-- WhatsApp -->
                    <button onclick="shareWhatsApp()" class="flex flex-col items-center">
                        <i class="fab fa-whatsapp text-green-500 text-3xl"></i>
                        <span class="text-sm mt-1">WhatsApp</span>
                    </button>

                    <!-- Messages -->
                    <button onclick="shareSMS()" class="flex flex-col items-center">
                        <i class="fas fa-comment-alt text-blue-500 text-3xl"></i>
                        <span class="text-sm mt-1">Messages</span>
                    </button>

                    <!-- Email -->
                    <button onclick="shareEmail()" class="flex flex-col items-center">
                        <i class="fas fa-envelope text-indigo-500 text-3xl"></i>
                        <span class="text-sm mt-1">Mail</span>
                    </button>

                    <!-- User ID (Copy Referral Code) -->
                    <button onclick="copyUserId()" class="flex flex-col items-center">
                        <i class="fas fa-user text-gray-700 text-3xl"></i>
                        <span class="text-sm mt-1">User ID</span>
                    </button>
                </div>

                <!-- Referral Code Display (Read-only) -->
                <input type="text" id="referralCode" value="{{ Auth::user()->referral_code }}" readonly
                    class="border w-full rounded-md px-4 py-2 mb-4 text-sm text-center font-bold bg-gray-100">
                <p class="text-center text-xs mb-4">Copy and share your referral code!</p>

                <!-- Phone Number Input & Send Button -->
                <div class="flex items-center border rounded-md px-2 py-2">
                    <input id="phone" type="text" placeholder="Enter phone number"
                        class="flex-grow bg-transparent px-2 focus:outline-none text-sm" />

                    <button onclick="sendWhatsAppMessage()"
                        class="bg-black text-black w-8 h-8 rounded-full flex items-center justify-center ml-2">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- intl-tel-input CSS & JS for phone input (optional enhancement) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>

    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- JavaScript for Referral Sharing Logic -->
    <script>
        // Using Laravel's URL helper to generate the register URL
        const registerUrl = "{{ url('/register') }}";
        const referralCode = document.getElementById('referralCode').value;
        const referralLink = `${registerUrl}?ref=${referralCode}`;

        function shareWhatsApp() {
            const message = `Join the Business Transformers using my referral link: ${referralLink}`;
            const url = `https://wa.me/?text=${encodeURIComponent(message)}`;
            window.open(url, '_blank');
        }

        function shareSMS() {
            const message = `Join the Business Transformers using my referral link: ${referralLink}`;
            const smsUrl = `sms:?body=${encodeURIComponent(message)}`;
            window.open(smsUrl, '_self');
        }

        function shareEmail() {
            const subject = "Join Business Transformers with my referral!";
            const body =
                `Hi,\n\nI invite you to join Business Transformers. Use my referral link to register: ${referralLink}\n\nCheers!`;
            const mailtoUrl = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
            window.open(mailtoUrl, '_self');
        }

        function copyUserId() {
            const referralInput = document.getElementById("referralCode");
            referralInput.select();
            referralInput.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(referralInput.value).then(() => {
                alert("Referral code copied to clipboard!");
            }).catch(err => {
                alert("Failed to copy: " + err);
            });
        }

        // Optional: enhance phone number sharing using intl-tel-input
        const phoneInput = document.querySelector("#phone");
        const iti = window.intlTelInput(phoneInput, {
            separateDialCode: true,
            preferredCountries: ["in", "us"],
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
        });

        function sendWhatsAppMessage() {
            // Validate phone number input using intl-tel-input
            if (!iti.isValidNumber()) {
                alert("Please enter a valid phone number.");
                return;
            }

            const number = iti.getNumber();
            const message = `Hey! Join Business Transformers using my referral link: ${referralLink}`;
            // Construct WhatsApp URL for sending a message to the specified number
            const waUrl = `https://wa.me/${number.replace(/\D/g, '')}?text=${encodeURIComponent(message)}`;
            window.open(waUrl, "_blank");
        }
    </script>
</x-app-layout>
