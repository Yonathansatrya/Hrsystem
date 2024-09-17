<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Home</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/Logo_S.png') }}" alt="Logo" class="logo">
                <h1 class="dashboard-title">Admin Dashboard</h1>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('admin.home') }}"><img src="{{ asset('icons/home.png') }}" alt="Home" class="icon">Home</a></li>
                <li><a href="{{ route('employees.index') }}"><img src="{{ asset('icons/employee.png') }}" alt="Data Karyawan" class="icon">Data Karyawan</a></li>
                <li><a href="{{ route('attendances.index') }}"><img src="{{ asset('icons/attendance.png') }}" alt="Absensi" class="icon">Absensi</a></li>
                <li><a href="{{ route('employee_records.index') }}"><img src="{{ asset('icons/violations.png') }}" alt="Data Pelanggaran" class="icon">Data Pelanggaran</a></li>
                <li><a href="#"><img src="{{ asset('icons/settings.png') }}" alt="Settings" class="icon">Log out</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h2>Home Page</h2>
            <!-- Content untuk Home Page -->
        </main>
    </div>
</body>
</html>
