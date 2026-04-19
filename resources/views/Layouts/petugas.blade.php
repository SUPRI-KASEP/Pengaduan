<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    body {
        margin: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* SIDEBAR */
    .sidebar {
        width: 260px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        color: #333;
        padding: 20px 0;
        box-shadow: 3px 0 25px rgba(0,0,0,0.1);
        border-right: 1px solid rgba(255,255,255,0.2);
    }

    .sidebar-header {
        padding: 20px 25px;
        text-align: center;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        margin-bottom: 20px;
    }

    .sidebar-header h4 {
        margin: 0;
        font-weight: 600;
        font-size: 1.3em;
    }

    .sidebar-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 0.9em;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        padding: 14px 25px;
        color: #495057;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        margin: 2px 0;
        font-weight: 500;
    }

    .sidebar-menu a:hover, .sidebar-menu a.active {
        background: linear-gradient(90deg, #28a745, #20c997);
        color: white;
        border-left-color: #fff;
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(40,167,69,0.3);
    }

    .sidebar-menu i {
        width: 22px;
        margin-right: 12px;
        font-size: 1.1em;
    }

    /* CONTENT */
    .content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .navbar-top {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        padding: 15px 30px;
        border-bottom: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 2px 20px rgba(0,0,0,0.05);
    }

    .navbar-top h5 {
        margin: 0;
        color: #28a745;
        font-weight: 600;
    }

    .user-info {
        color: #495057;
        font-weight: 500;
    }

    main {
        flex: 1;
        padding: 30px;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(10px);
    }

    .stats-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        border: none;
        transition: all 0.3s ease;
        height: 100%;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.12);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5em;
        margin-bottom: 15px;
    }

    .reports-table {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }

    footer {
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(10px);
        padding: 15px;
        text-align: center;
        color: #6c757d;
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    @media (max-width: 768px) {
        .sidebar { width: 100%; position: fixed; z-index: 1000; transform: translateX(-100%); }
        .content { margin-left: 0; }
    }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-user-shield"></i> Petugas</h4>
            <p>{{ auth()->user()->name ?? 'Petugas' }}</p>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('petugas.dashboard') }}" class="active">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('petugas.reports.index') }}">
                <i class="fas fa-clipboard-list"></i> Laporan Ditugaskan
            </a>
            <a href="#">
                <i class="fas fa-tasks"></i> Progress Kerja
            </a>
            <hr style="margin: 20px 25px;">
            <form action="{{ route('logout') }}" method="POST" style="margin: 0 20px;">
                @csrf
                <button type="submit" class="sidebar-menu w-100 text-start border-0 bg-transparent p-3 rounded" style="color: #dc3545 !important;">
                    <i class="fas fa-sign-out-alt me-3"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <!-- TOP NAVBAR -->
        <div class="navbar-top d-flex justify-content-between align-items-center">
            <h5>Dashboard Petugas</h5>
            <div class="user-info">
                <i class="fas fa-user-circle me-2"></i>
                {{ auth()->user()->name }}
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <main>
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer>
            © {{ date('Y') }} Sistem Pengaduan • Petugas Panel
        </footer>
    </div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
