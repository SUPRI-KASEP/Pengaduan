<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        margin: 0;
        background: #f5f7fb;
        font-family: 'Segoe UI', sans-serif;
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* 🔻 SIDEBAR PUTIH SMOOTH */
.sidebar {
    width: 250px;
    background: #ffffff;
    color: #333;
    padding-top: 10px;
    border-right: 1px solid rgba(0,0,0,0.05);
    box-shadow: 2px 0 15px rgba(0,0,0,0.03);
    transition: 0.3s;
}

.sidebar h4 {
    padding: 15px;
    font-weight: 600;
    color: #111;
    letter-spacing: 0.5px;
}

/* LINK */
.sidebar a {
    display: block;
    padding: 12px 18px;
    color: #555;
    text-decoration: none;
    transition: all 0.25s ease;
    border-left: 3px solid transparent;
    border-radius: 6px;
    margin: 4px 10px;
}

/* HOVER HALUS */
.sidebar a:hover {
    background: #f1f5ff;
    color: #0d6efd;
    border-left: 3px solid #0d6efd;
    transform: translateX(3px);
}

/* ACTIVE MENU */
.sidebar a.active {
    background: #e7f0ff;
    color: #0d6efd;
    border-left: 3px solid #0d6efd;
    font-weight: 500;
}

/* GARIS */
.sidebar hr {
    border-color: rgba(0,0,0,0.05);
}

/* LOGOUT BUTTON */
.sidebar .btn-danger {
    border-radius: 8px;
}

    /* 🔻 CONTENT */
    .content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* 🔝 NAVBAR */
    .navbar {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 12px 20px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .navbar span {
        font-weight: 500;
        color: #333;
    }

    /* 📦 MAIN */
    main {
        flex: 1;
        padding: 25px;
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
        text-align: center;
        padding: 10px;
        font-size: 14px;
        color: #555;
    }

    /* 🔥 BUTTON */
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

<div class="wrapper">

    {{-- 🔻 SIDEBAR --}}
    <div class="sidebar">
        <h4>Admin Panel</h4>

        <a href="/admin/dashboard">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}">Kelola Kategori</a>
        <a href="{{ route('admin.agencies.index') }}">Kelola Instansi</a>
<a href="{{ route('admin.reports.index') }}">Kelola Laporan</a>
        <a href="/admin/users">Kelola User</a>

        <hr>

        <form action="/logout" method="POST" class="px-3">
            @csrf
            <button class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    {{-- 🔻 CONTENT --}}
    <div class="content">

        {{-- 🔝 NAVBAR --}}
        <div class="navbar d-flex justify-content-between">
            <span>Dashboard Admin</span>
            <span>{{ auth()->user()->name ?? 'Admin' }}</span>
        </div>

        {{-- 📦 MAIN --}}
        <main>
            @yield('content')
        </main>

        {{-- 🔻 FOOTER --}}
        <footer>
            © {{ date('Y') }} Admin Panel
        </footer>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>