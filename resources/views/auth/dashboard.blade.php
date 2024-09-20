<!-- resources/views/auth/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'HRSystem Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
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
                        <li><a href="{{ route('employees.index') }}">Data Karyawan</a></li>
                        <li><a href="{{ route('attendances.index') }}">Absensi</a></li>
                        <li><a href="{{ route('employee_records.index') }}">Data Pelanggaran</a></li>
                        <li><a href="{{ route('employees.archived') }}">Data Arsip</a></li>
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('user.profile') }}">home</a></li>
                        <li><a href="{{ route('user.attendances') }}">Kehadiran Saya</a></li>
                        <li><a href="{{ route('user.records') }}">Catatan Pelanggaran Saya</a></li>
                    </ul>
                @endif
            </nav>

            <div class="profile-logout">
                <ul class="nav-links">
                    <li><a href="{{ route('user.profile') }}">Profil</a></li>
                    <li><a href="{{ route('logout') }}">Log out</a></li>
                </ul>
            </div>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
