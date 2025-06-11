<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        html, body {
            height: 100%;
            overflow: hidden; /* Prevent scrolling on the entire page */
        }

        /* Dark mode styles */
        [data-bs-theme="dark"] {
            color-scheme: dark;
        }

        [data-bs-theme="dark"] body {
            background-color: #1a1a1a;
            color: #fff;
        }

        /* Sidebar Dark Mode */
        [data-bs-theme="dark"] .main-sidebar {
            background-color: #2c3e50;
        }       

        [data-bs-theme="dark"] .nav-sidebar .nav-item .nav-link {
            color: #ecf0f1;
        }

        [data-bs-theme="dark"] .nav-sidebar .nav-item .nav-link:hover {
            background-color: #34495e;
        }

        /* Brand Logo Dark Mode */
        [data-bs-theme="dark"] .brand-link {
            color: #fff !important;
            border-bottom: 1px solid #34495e;
        }

        [data-bs-theme="dark"] .brand-link:hover {
            color: #3498db !important;
        }

        [data-bs-theme="dark"] .brand-text {
            color: #fff !important;
            font-weight: 600;
        }

        /* Card Dark Mode */
        [data-bs-theme="dark"] .card {
            background-color: #2c3e50;
            border-color: #34495e;
        }

        [data-bs-theme="dark"] .card-header {
            background-color: #34495e;
            border-bottom-color: #2c3e50;
        }

        [data-bs-theme="dark"] .card-title {
            color: #fff !important;
        }

        [data-bs-theme="dark"] .card-body {
            color: #fff;
        }

        /* Content Area Dark Mode */
        [data-bs-theme="dark"] .content-wrapper {
            background-color: #1a1a1a;
        }

        [data-bs-theme="dark"] .content-header {
            background-color: #1a1a1a;
        }

        [data-bs-theme="dark"] .content-header h1 {
            color: #fff;
        }

        [data-bs-theme="dark"] .breadcrumb {
            background-color: transparent;
        }

        [data-bs-theme="dark"] .breadcrumb-item,
        [data-bs-theme="dark"] .breadcrumb-item a {
            color: #ecf0f1;
        }

        [data-bs-theme="dark"] .breadcrumb-item.active {
            color: #95a5a6;
        }

        /* Form Elements Dark Mode */
        [data-bs-theme="dark"] .form-control {
            background-color: #34495e;
            border-color: #2c3e50;
            color: #ecf0f1;
        }

        [data-bs-theme="dark"] .form-control:focus {
            background-color: #34495e;
            border-color: #3498db;
            color: #ecf0f1;
        }

        [data-bs-theme="dark"] .input-group-text {
            background-color: #2c3e50;
            border-color: #34495e;
            color: #ecf0f1;
        }

        /* Button Dark Mode */
        [data-bs-theme="dark"] .btn-secondary {
            background-color: #34495e;
            border-color: #2c3e50;
            color: #ecf0f1;
        }

        [data-bs-theme="dark"] .btn-secondary:hover {
            background-color: #2c3e50;
            border-color: #34495e;
            color: #fff;
        }

        /* Modal Dark Mode */
        [data-bs-theme="dark"] .modal-content {
            background-color: #2c3e50;
            border-color: #34495e;
        }

        [data-bs-theme="dark"] .modal-header {
            border-bottom-color: #34495e;
        }

        [data-bs-theme="dark"] .modal-footer {
            border-top-color: #34495e;
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #ddd;
            color: #333;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        /* Card Hover Effects */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Button Animations */
        .btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn:hover::after {
            width: 300px;
            height: 300px;
        }

        /* Page Transitions */
        .content-wrapper {
            animation: fadeIn 0.5s ease;
            height: calc(100vh - 56px); /* Reverted to previous height calculation */
            overflow-y: auto; /* Enable scrolling for content within wrapper */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Remove navbar and footer */
        .main-header, .main-footer {
            display: none !important;
        }

        /* Adjust content wrapper margin */
        .content-wrapper {
            margin-left: 250px;
        }

        @media (max-width: 991.98px) {
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page-title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Theme Toggle Button -->
        <button class="theme-toggle" onclick="toggleTheme()">
            <i class="fas fa-moon"></i>
        </button>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        // Theme Toggle Function
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', newTheme);
            
            // Update icon
            const icon = document.querySelector('.theme-toggle i');
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            // Save preference
            localStorage.setItem('theme', newTheme);
        }

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', savedTheme);
        document.querySelector('.theme-toggle i').className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

        // Add page transition effect
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.content-wrapper').style.opacity = '0';
            setTimeout(() => {
                document.querySelector('.content-wrapper').style.opacity = '1';
            }, 100);
        });
    </script>
    @stack('scripts')
</body>
</html>
