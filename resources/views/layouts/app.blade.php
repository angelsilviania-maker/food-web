<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Resto - App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Definisi warna biru konsisten (Deep Blue Mewah) */
        :root {
            --custom-blue: #1e3c72;
            --custom-blue-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        .bg-custom-primary {
            background: var(--custom-blue-gradient) !important;
        }
        .text-custom-primary {
            color: var(--custom-blue) !important;
        }
        .btn-custom-primary {
            background-color: var(--custom-blue) !important;
            border-color: var(--custom-blue) !important;
            color: #fff !important;
        }
        .btn-custom-primary:hover {
            background-color: #162d54 !important;
            border-color: #162d54 !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Header / Navbar Biru Mewah -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4 bg-custom-primary" style="padding-top: 0.8rem; padding-bottom: 0.8rem;">
        <div class="container" style="max-width: 1100px;">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-white" href="#">
                <div class="bg-white text-custom-primary p-1 rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;">
                    <i class="bi bi-shop fs-5"></i>
                </div>
                <span style="letter-spacing: 0.3px;">Resto App</span>
            </a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <!-- Tombol Menu Pembeli -->
                <a href="{{ url('/') }}" class="btn btn-light btn-sm fw-bold px-3 py-1.5 text-custom-primary rounded-pill shadow-sm">Menu Pembeli</a>
                
                <!-- Tombol Panel Admin -->
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm fw-bold px-3 py-1.5 rounded-pill">Panel Admin</a>
                
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm px-3 py-1.5 rounded-pill">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>