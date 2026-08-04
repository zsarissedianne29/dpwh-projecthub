<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'DPWH ProjectHub')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- AdminLTE --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/css/adminlte.min.css">

    <style>
        :root {
            --dpwh-blue: #0056d2;
            --dpwh-blue-dark: #003f9e;
            --dpwh-blue-light: #eaf2ff;
            --dpwh-sidebar: #0b57d0;
            --dpwh-sidebar-hover: #1a73e8;
            --dpwh-bg: #f4f7fb;
            --dpwh-text: #1f2937;
            --dpwh-border: #dbe3ef;
            --dpwh-shadow: 0 4px 14px rgba(15, 23, 42, 0.08);
            --dpwh-shadow-lg: 0 10px 24px rgba(15, 23, 42, 0.12);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--dpwh-bg);
            color: var(--dpwh-text);
        }

        .app-main {
            background: var(--dpwh-bg);
        }

        .app-content {
            min-height: calc(100vh - 120px);
        }

        /* Navbar */
        .app-header {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95) !important;
            border-bottom: 1px solid var(--dpwh-border) !important;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
        }

        .navbar-user {
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .role-badge {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 0.4rem 0.65rem;
            border-radius: 999px;
        }

        .btn-logout {
            border-radius: 10px;
            padding: 0.45rem 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25);
        }

        /* Sidebar */
        .app-sidebar {
            background: linear-gradient(180deg, var(--dpwh-sidebar) 0%, var(--dpwh-blue-dark) 100%) !important;
            border-right: 0 !important;
        }

        .sidebar-brand {
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .sidebar-brand .brand-link {
            color: #fff !important;
            font-weight: 700;
            font-size: 1.15rem;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-menu .nav-link {
            border-radius: 12px;
            margin: 0.2rem 0.6rem;
            padding: 0.8rem 1rem;
            color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .sidebar-menu .nav-link:hover {
            background: rgba(255, 255, 255, 0.14);
            transform: translateX(2px);
        }

        .sidebar-menu .nav-link.active {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #fff !important;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08);
        }

        .sidebar-menu .nav-icon {
            margin-right: 0.6rem;
        }

        /* Page header */
        .app-content-header {
            background: #fff !important;
            border-bottom: 1px solid var(--dpwh-border) !important;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        }

        .app-content-header h1 {
            color: var(--dpwh-blue);
            letter-spacing: -0.02em;
        }

        /* Cards */
        .card {
            border: 0 !important;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--dpwh-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--dpwh-shadow-lg);
        }

        .card-header {
            border-bottom: 1px solid var(--dpwh-border) !important;
            background: #fff !important;
            font-weight: 700;
        }

        .card-header.bg-primary {
            background: linear-gradient(135deg, var(--dpwh-blue) 0%, #1a73e8 100%) !important;
            border-bottom: 0 !important;
        }

        /* Buttons */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--dpwh-blue) 0%, #1a73e8 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--dpwh-blue-dark) 0%, var(--dpwh-blue) 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(0, 86, 210, 0.25);
        }

        .btn-warning,
        .btn-success,
        .btn-danger,
        .btn-info,
        .btn-secondary {
            border: none;
        }

        /* Forms */
        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #ced8e5;
            padding: 0.7rem 0.95rem;
            box-shadow: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--dpwh-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 86, 210, 0.12);
        }

        .form-label {
            color: #374151;
        }

        /* Tables */
        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead th {
            background: var(--dpwh-blue-light) !important;
            color: var(--dpwh-blue-dark);
            border-color: #cfe0ff !important;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.82rem;
            letter-spacing: 0.03em;
        }

        .table tbody td {
            border-color: #e6edf5;
        }

        .table-hover tbody tr:hover {
            background: #f8fbff;
        }

        /* Badges */
        .badge {
            border-radius: 999px;
            padding: 0.55rem 0.85rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        /* Alerts */
        .alert {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 4px 10px rgba(15, 23, 42, 0.06);
        }

        /* Small boxes */
        .small-box {
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--dpwh-shadow);
        }

        .small-box .inner {
            padding: 1.25rem;
        }

        .small-box .icon {
            opacity: 0.18;
        }

        /* Footer */
        .app-footer {
            background: #fff;
            border-top: 1px solid var(--dpwh-border);
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .app-content-header .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .navbar-user {
                font-size: 0.85rem;
            }

            .role-badge {
                display: none;
            }

            .card {
                border-radius: 14px;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    {{-- NAVBAR --}}
    <nav class="app-header navbar navbar-expand bg-white border-bottom">

        <div class="container-fluid">

            {{-- Left side --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link"
                       data-lte-toggle="sidebar"
                       href="#"
                       role="button">
                        <i class="bi bi-list fs-5"></i>
                    </a>
                </li>
            </ul>

            {{-- Right side --}}
            <ul class="navbar-nav ms-auto align-items-center">

                @auth

                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle text-dark fw-semibold navbar-user"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">

                            <i class="bi bi-person-circle text-primary fs-5"></i>

                            <span>{{ auth()->user()->name }}</span>

                            <span class="badge bg-secondary role-badge">
                                {{ strtoupper(str_replace('_', ' ', auth()->user()->role)) }}
                            </span>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-lines-fill me-2 text-primary"></i>
                                    My Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>

                @endauth

            </ul>

        </div>

    </nav>

    {{-- SIDEBAR --}}
    @include('components.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="app-main">

        {{-- Page Header --}}
        <div class="app-content-header py-3 bg-white border-bottom">
            <div class="container-fluid">

                @hasSection('title')
                    <h1 class="h3 mb-0 fw-bold">
                        @yield('title')
                    </h1>
                @endif

            </div>
        </div>

        {{-- Page Content --}}
        <div class="app-content">

            <div class="container-fluid py-4">

                {{-- Validation Errors --}}
                @if($errors->any())

                    <div class="alert alert-danger alert-dismissible fade show">

                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-exclamation-triangle-fill fs-5 mt-1"></i>

                            <div>
                                <strong>Please fix the following errors:</strong>

                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert"></button>

                    </div>

                @endif

                {{-- Page Content Here --}}
                @yield('content')

            </div>

        </div>

    </main>

    {{-- FOOTER --}}
    @include('components.footer')

</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- AdminLTE JS --}}
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/js/adminlte.min.js"></script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>
</html>