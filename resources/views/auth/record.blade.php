<!-- resources/views/auth/records.blade.php -->
@extends('auth.dashboard')

@section('title', 'Catatan Pelanggaran Saya')

@section('content')
<div class="records-container">
    <h2>Catatan Pelanggaran Saya</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Jenis Pelanggaran</th>
                <th>Tanggal Pelanggaran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{ $record->offense_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->offense_date)->format('d-m-Y') }}</td>
                    <td>{{ $record->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada catatan pelanggaran yang ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<!-- Tambahkan CSS untuk tata letak tabel -->
<style>
    .records-container {
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
