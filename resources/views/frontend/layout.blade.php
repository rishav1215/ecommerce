<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #375abb;
            --secondary-color: #f8f9fc;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            padding-top: 70px;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            background: white !important;
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
            font-size: 1.5rem;
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            color: var(--dark-color) !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .search-box {
            width: 400px;
            position: relative;
        }

        .search-box input {
            border-radius: 50px;
            padding-left: 40px;
        }

        .search-box .search-icon {
            position: absolute;
            left: 15px;
            top: 10px;
            color: #6c757d;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            position: fixed;
            top: 70px;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 20px 0;
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            overflow-y: auto;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 0 20px 10px;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 1.1rem;
            border-bottom: 1px solid #eee;
        }

        .sidebar-menu {
            padding: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.2s;
            font-weight: 500;
        }

        .sidebar-menu a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            color: #6c757d;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(78, 115, 223, 0.1);
            color: var(--primary-color);
        }

        .sidebar-menu a:hover i,
        .sidebar-menu a.active i {
            color: var(--primary-color);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 25px;
            min-height: calc(100vh - 70px);
            transition: all 0.3s;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
            background: #f9f9f9;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark-color);
            font-size: 1.1rem;
        }

        .card-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .card-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        /* Badges */
        .badge {
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Buttons */
        .btn {
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                left: -280px;
            }

            .main-content {
                margin-left: 0;
            }

            .search-box {
                width: 100%;
                margin: 10px 0;
            }

            .navbar-collapse {
                padding: 10px 0;
            }
        }

        /* Mobile Sidebar Toggle */
        .sidebar-mobile-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            z-index: 1050;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 992px) {
            .sidebar-mobile-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar.active {
                left: 0;
            }
        }

        /* Utility Classes */
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
            position: relative;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-shopping-bag"></i> E-Shop
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>

                <form action="{{ route('product.search') }}" method="GET"
                    class="d-flex search-box mx-lg-3 my-2 my-lg-0">
                    <i class="fas fa-search search-icon"></i>
                    <input name="query" class="form-control me-2" type="search" placeholder="Search products..."
                        aria-label="Search" required>
                </form>

                <ul class="navbar-nav mb-2 mb-lg-0">
                   <li class="nav-item">
    @php
        $cartCount = count(session('cart', []));
    @endphp

    <a class="nav-link" href="{{ route('cart.view') }}">
        <i class="fas fa-heart"></i>
        <span class="badge bg-danger rounded-pill">{{ $cartCount }}</span>
    </a>
</li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger rounded-pill">5</span>
                        </a>
                    </li>

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-box me-2"></i> Orders</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar d-none d-lg-block">
        <div class="sidebar-header">
            <h5>Categories</h5>
        </div>
        <div class="sidebar-menu">
            <a href="#" class="active">
                <i class="fas fa-list"></i> All Categories
            </a>
            <a href="#">
                <i class="fas fa-laptop"></i> Electronics
            </a>
            <a href="#">
                <i class="fas fa-tshirt"></i> Fashion
            </a>
            <a href="#">
                <i class="fas fa-home"></i> Home & Kitchen
            </a>
            <a href="#">
                <i class="fas fa-spa"></i> Beauty
            </a>
            <a href="#">
                <i class="fas fa-gamepad"></i> Toys & Games
            </a>
            <a href="#">
                <i class="fas fa-running"></i> Sports
            </a>
            <a href="#">
                <i class="fas fa-book"></i> Books
            </a>
            <a href="#">
                <i class="fas fa-shopping-basket"></i> Groceries
            </a>
        </div>

        <div class="sidebar-header mt-4">
            <h5>Filters</h5>
        </div>
        <div class="px-3">
            <h6 class="fw-bold mb-3">Price Range</h6>
            <div class="d-flex justify-content-between mb-2">
                <span>₹100</span>
                <span>₹10,000</span>
            </div>
            <input type="range" class="form-range" min="100" max="10000">

            <h6 class="fw-bold mt-4 mb-3">Brands</h6>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="brand1">
                <label class="form-check-label" for="brand1">Brand A</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="brand2">
                <label class="form-check-label" for="brand2">Brand B</label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="brand3">
                <label class="form-check-label" for="brand3">Brand C</label>
            </div>

            <h6 class="fw-bold mt-4 mb-3">Ratings</h6>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="rating4">
                <label class="form-check-label" for="rating4">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                </label>
            </div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="rating3">
                <label class="form-check-label" for="rating3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="far fa-star text-warning"></i> & Up
                </label>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Toggle -->
    <button class="sidebar-mobile-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            if (window.innerWidth <= 992 &&
                !sidebar.contains(event.target) &&
                event.target !== sidebarToggle &&
                !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>

</html>