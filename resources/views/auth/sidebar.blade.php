<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'HRSystem Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/school.png') }}" alt="School Logo" class="logo">
                <h1 class="dashboard-title">
                    @if(Auth::user()->position === 'HRD')
                        HRSystem Admin
                    @else
                        HRSystem User
                    @endif
                </h1>
            </div>

            <nav class="nav-links">
                @if(Auth::user()->position === 'HRD')
                    <ul>
                        <li><a href="#"><i class="fas fa-users"></i> Dashboard</a></li>
                        <li><a href="{{ route('employees.index') }}"><i class="fas fa-users"></i> Data Karyawan</a></li>
                        <li><a href="{{ route('attendances.index') }}"><i class="fas fa-calendar-check"></i> Absensi</a></li>
                        <li><a href="{{ route('employee_records.index') }}"><i class="fas fa-exclamation-triangle"></i> Data Pelanggaran</a></li>
                        <li><a href="{{ route('employees.archived') }}"><i class="fas fa-archive"></i> Data Arsip</a></li>
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('user.profile') }}"><i class="fas fa-home"></i> home</a></li>
                        <li><a href="{{ route('user.attendances') }}"><i class="fas fa-clock"></i> Kehadiran Saya</a></li>
                        <li><a href="{{ route('user.records') }}"><i class="fas fa-file-alt"></i> Catatan Pelanggaran Saya</a></li>
                    </ul>
                @endif
            </nav>
        </aside>

        <main class="main-content">
            <header class="navbar">
                <div class="profile-logout">
                    <ul>
                        <li class="notification">
                            <a href="{{ route('notifications.index') }}" class="notification-button">
                                <i class="fas fa-bell"></i>
                                <span class="notification-count">
                                    {{ auth()->user() && auth()->user()->unreadNotifications ? auth()->user()->unreadNotifications->count() : 0 }}
                                </span> <!-- Jumlah notifikasi yang belum dibaca -->
                            </a>
                        </li>
                        
                        
                        <li><a href="{{ route('user.profile') }}"><i class="fas fa-user"></i> Profil</a></li>
                        <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Log out</a></li>
                    </ul>
                </div>
            </header>
        
            @yield('content')
        </main>        
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
