<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <div class="bg-dark text-white p-3 sticky-lg-top" style="width: 200px; height: 100vh;">
        <h4>Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a></li>
            <li class="nav-item"><a href="{{ route('admin.vcf.settings') }}" class="nav-link text-white">VCF Settings</a></li>
            <li class="nav-item"><a href="{{ route('admin.about-us.index') }}" class="nav-link text-white">About us</a></li>
            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link text-white">Logout</a></li>
        </ul>
    </div>
    <div class="p-4 w-100">
        @yield('content')
    </div>
</div>
@yield('scripts')
</body>
</html>