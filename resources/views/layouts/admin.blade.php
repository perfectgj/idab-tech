<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Add Font Awesome CDN -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- intl-tel-input JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="d-flex">
        <div class="bg-dark text-white p-3 sticky-lg-top" style="width: 200px; height: 100vh;">
            <h4>Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                <li class="nav-item"><a href="{{ route('admin.vcf.settings') }}" class="nav-link text-white">VCF
                        Settings</a></li>
                <li class="nav-item"><a href="{{ route('admin.about-us.index') }}" class="nav-link text-white">About
                        us</a></li>
                <li class="nav-item"><a href="{{ route('admin.projects.index') }}"
                        class="nav-link text-white">Projects</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link text-white">Services</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.teams.index') }}" class="nav-link text-white">Team</a>
                </li>
                <li class="nav-item"><a href="{{ route('admin.contact_us.index') }}" class="nav-link text-white">Contact
                        Us Queries</a></li>

                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link text-white">Categories</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link text-white">Products</a>
                </li>
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-white">Logout</a></li>
            </ul>
        </div>
        <div class="p-4 w-100">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>

</html>
