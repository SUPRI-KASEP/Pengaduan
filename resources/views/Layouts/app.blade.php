<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Pengaduan App') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background: #f5f7fb;
    }

    main {
        flex: 1;
    }

    /* 🔝 NAVBAR */
    .navbar {
        background: rgba(255, 255, 255, 0.8) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .navbar-brand {
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #111 !important;
    }

    .nav-link {
        color: #333 !important;
        transition: all 0.25s ease;
        position: relative;
    }

    .nav-link:hover {
        color: #0d6efd !important;
        transform: translateY(-1px);
    }

    /* underline animasi */
    .nav-link::after {
        content: "";
        position: absolute;
        width: 0%;
        height: 2px;
        bottom: 0;
        left: 0;
        background: #0d6efd;
        transition: 0.3s;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* 📦 CONTENT */
    main.container {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    /* 🔻 FOOTER */
    footer {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(0,0,0,0.05);
        transition: 0.3s;
    }

    footer small {
        color: #555;
        letter-spacing: 0.3px;
    }

    /* tombol lebih smooth */
    .btn {
        border-radius: 8px;
        transition: 0.25s;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>
    </style>
</head>
<body>

{{-- 🔝 NAVBAR --}}
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Pengaduan</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="">Laporan</a>
                </li>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/user/dashboard">Dashboard</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('report.index') }}">Buat Laporan</a>
                    </li>

                    <li class="nav-item">
                        <form action="/logout" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" 
                                class="nav-link btn btn-link text-dark" 
                                style="text-decoration: none;">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

{{-- 📦 CONTENT --}}
<main class="container py-4">
    @yield('content')
</main>

{{-- 🔻 FOOTER --}}
<footer class="text-center py-3 mt-auto shadow-sm">
    <div class="container">
        <small class="text-dark">
            © {{ date('Y') }} Pengaduan App • Dibuat dengan Laravel
        </small>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>