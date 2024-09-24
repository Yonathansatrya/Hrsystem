<!-- resources/views/auth/attendances.blade.php -->
@extends('auth.sidebar')

@section('title', 'Kehadiran Saya')

@section('content')
<link rel="stylesheet" href="{{asset('css/attendances.css')}}">
<div class="attendances-container">
    <h2>Kehadiran Saya</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal Masuk</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Terlambat</th>
                <th>Pulang Awal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendances as $attendance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($attendance->masuk)->format('d-m-Y') }}</td>
                    <td>{{ $attendance->jam_kehadiran }}</td>
                    <td>{{ $attendance->keluar }}</td>
                    <td>{{ $attendance->jam_datang_terlambat }} menit</td>
                    <td>{{ $attendance->jam_pulang_awal }} menit</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data kehadiran yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<!-- Tambahkan CSS untuk tata letak tabel -->
<style>
    .attendances-container {
        margin-top: 20px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    table th {
        background-color: #f2f2f2;
    }
</style>
