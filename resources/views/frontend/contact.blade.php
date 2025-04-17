<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="p-5 rounded-4 shadow border glass-bg">
                    <h3 class="text-center mb-4">Contact Us</h3>

                    <form action="{{ route('contact.submit') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                required>
                            <label for="name">Full Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea name="query" class="form-control" placeholder="Query" id="query" style="height: 120px" required></textarea>
                            <label for="query">Your Query</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                required>
                            <label for="email">Email address</label>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" id="phone" class="form-control" required>
                            <input type="hidden" name="country_code" id="country_code">
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Send Message</button>
                    </form>

                    <div class="mt-4 text-center">
                        <h6 class="mb-2">Follow Us</h6>
                        <div class="d-flex justify-content-center gap-3 fs-4">
                            <a href="#"><i class="bi bi-linkedin"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .glass-bg {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</x-app-layout>
