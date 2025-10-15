<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
        }
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background-color: #343a40; /* Dark background */
            padding-top: 20px;
        }
        .sidebar .nav-link {
            color: #adb5bd; /* Light grey text */
            font-size: 1.1rem;
            margin: 5px 15px;
            border-radius: 0.3rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #ffffff; /* White text on hover/active */
            background-color: #495057; /* Darker grey background */
        }
        .sidebar .nav-link .bi {
            margin-right: 15px; /* Space between icon and text */
        }
        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #f8f9fa; /* Light background for content */
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <h3 class="text-white text-center mb-4">Admin Panel</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                {{-- Link ke halaman daftar Services --}}
                <a class="nav-link" href="{{ route('admin.services.index') }}">
                    <i class="bi bi-box-seam"></i>Services
                </a>
            </li>
            <li class="nav-item">
                {{-- Link ke halaman daftar Orders --}}
                <a class="nav-link d-flex justify-content-between align-items-center" href="{{ route('admin.orders.index') }}">
                    <span><i class="bi bi-receipt"></i>Orders</span>
                    <span class="badge bg-danger" title="Menunggu">{{ \App\Models\Order::where('status','menunggu')->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                {{-- Link ke halaman daftar Customers --}}
                <a class="nav-link" href="{{ route('admin.customers.index') }}">
                    <i class="bi bi-people"></i>Customers
                </a>
            </li>
            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-start w-100" style="border: none; background: none;">
                        <i class="bi bi-box-arrow-right"></i>Logout
                    </button>
                </form>
            </li>
            </ul>
    </aside>

    <main class="content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>