<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Pengaduan App') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

    {{-- 🔝 NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                        <a class="nav-link" href="/reports">Laporan</a>
                    </li>

                    @auth
                        @if(auth()->user()->role ?? '' === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/user/dashboard">Dashboard</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="/reports/create">Buat Laporan</a>
                        </li>

                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout ({{ auth()->user()->name ?? '' }})</button>
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
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>
                © {{ date('Y') }} Pengaduan App • Dibuat dengan Laravel
            </small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>