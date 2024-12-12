<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/library/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/style/main.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .navbar-brand img {
            max-height: 60px;
        }
        .navbar-nav .nav-link {
            padding: 0 15px;
        }
        .icon-for-user img {
            width: 24px;
            height: 24px;
        }
        .search-container {
            display: flex;
            align-items: center;
        }
        .search-container .search {
            width: 200px;
            border-radius: 5px;
            margin-left: 10px;
        }
        .navbar-collapse {
            justify-content: space-between;
        }
        .ms-auto {
            margin-left: auto !important;
        }
        .dropdown-menu-end {
            right: 0 !important;
            left: auto !important;
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
        }
        .main-nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
        }
        body {
            padding-top: 70px; /* Adjust this value based on header height */
        }
    </style>
</head>
<body>
    <header>
    <nav class="main-nav navbar navbar-expand-lg navbar-light" style="background-color: rgb(217, 231, 240); box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo2.PNG') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/allproduk') }}">All Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tentang">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                        <ul class="dropdown-menu" aria-labelledby="productDropdown">
                            @foreach (App\Models\Kategori::get() as $item)
                                <li><a class="dropdown-item" href="/kategori/{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link" href="/new-arrival">New Arrival</a></li> --}}
                    <li class="nav-item"><a class="nav-link" href="/seller">Best Seller</a></li>
                </ul>
                <div class="d-flex align-items-center ms-auto">
                    <div class="search-container me-3">
                        <form method="GET" action="{{ url('/allproduk') }}" class="d-flex align-items-center">
                            <input type="search" name="q" class="form-control" placeholder="Search products..." value="{{ request('q') }}" style="height: 30px; font-size: 14px; padding: 0 8px;">
                            <button type="submit" class="btn d-flex align-items-center justify-content-center" style="height: 30px; padding: 0 10px; font-size: 14px;">
                                <i class="bi bi-search" style="font-size: 16px;"></i>
                            </button>
                        </form>
                    </div>
                    <div class="icon-for-user d-flex align-items-center ms-3">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        @if(Auth::check())
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            </ul>
                        @else
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            </ul>
                        @endif
                    </div>
                    <a href="{{ url('keranjangku') }}" class="ms-3 text-dark">
                        <i class="bi bi-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

    <main>
        @yield('content')
    </main>
    <footer class="text-center text-white" style="background-color: rgb(34, 49, 63); padding: 20px 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">About Hijabeef</h5>
                    <p>
                        Hijabeef is your one-stop destination for modest fashion with a modern twist. Explore our collection today!
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="/allproduk" class="text-white text-decoration-none">All Products</a></li>
                        <li><a href="/tentang" class="text-white text-decoration-none">About</a></li>
                        <li><a href="/new-arrival" class="text-white text-decoration-none">New Arrival</a></li>
                        <li><a href="/seller" class="text-white text-decoration-none">Best Seller</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">Follow Us</h5>
                    <div>
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 text-white">
            <p class="mb-0">© 2024 Hijabeef. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>
