<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel | Monitoring Sertifikasi Digital')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 220px;
            background: #1e293b;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            transition: 0.3s;
        }
        .sidebar h4 {
            text-align: center;
            font-weight: 600;
            color: #ffffff;
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
        }
        .sidebar a {
            color: #cbd5e1;
            padding: 10px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.2s;
            font-size: 14.5px;
            border-radius: 6px;
            margin: 3px 8px;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #3b82f6;
            color: #fff;
        }
        .sidebar hr {
            border-color: rgba(255,255,255,0.2);
            margin: 10px 0;
        }

        /* Main */
        .main-content {
            margin-left: 220px;
            min-height: 100vh;
            background: #f5f7fb;
            transition: 0.3s;
        }

        /* Topbar */
        .topbar {
            background: #ffffff;
            padding: 14px 22px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar h5 {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.05rem;
        }

        .topbar span {
            font-size: 14.5px;
            color: #475569;
        }

        .container-fluid {
            padding: 25px;
        }

        /* Card style untuk halaman isi */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4><i class="bi bi-shield-lock-fill me-1"></i>Admin</h4>
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a href="{{ route('pengguna.index') }}" class="{{ request()->is('pengguna*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Pengguna
        </a>
        <a href="{{ route('sertifikat.index') }}" class="{{ request()->is('sertifikat*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Sertifikat
        </a>
        <a href="{{ route('notifikasi.index') }}" class="{{ request()->is('notifikasi*') ? 'active' : '' }}">
            <i class="bi bi-bell"></i> Notifikasi
        </a>
        <hr>
        <a href="{{ route('logout') }}">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="topbar">
            <h5>@yield('header', 'Dashboard Admin')</h5>
            <span>Halo, <strong>{{ Session::get('admin_nama') ?? 'Admin' }}</strong> 👋</span>
        </div>

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>
</html>
