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
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #212529;
            color: white;
        }

        .sidebar h4 {
            padding: 15px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #343a40;
        }

        /* Content */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        /* Footer */
        footer {
            background: #212529;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="wrapper">

    {{-- 🔻 SIDEBAR --}}
    <div class="sidebar">
        <h4>Admin Panel</h4>

        <a href="/admin">Dashboard</a>
        <a href="/admin/reports">Kelola Laporan</a>
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