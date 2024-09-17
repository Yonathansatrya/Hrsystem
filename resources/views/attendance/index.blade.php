@extends('admin.dashboard')

@section('title', 'Attendance List')

@section('content')
    <h1>Attendance List</h1>
    <link rel="stylesheet" href="{{ asset('css/absensi.css') }}">
    <div class="import-container">
        <a href="{{ route('attendances.import.view') }}" class="import-button">Import Data</a>
    </div>
    <div class="table-container">
        <table class="attendance-table">
            <thead>
                <tr>
                    <th>Pin</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>Kantor</th>
                    <th>Kehadiran (Jml)</th>
                    <th>Kehadiran (Jam:Menit)</th>
                    <th>Datang Terlambat (Jml)</th>
                    <th>Datang Terlambat (Jam:Menit)</th>
                    <th>Pulang Awal (Jml)</th>
                    <th>Pulang Awal (Jam:Menit)</th>
                    <th>Istirahat Lebih (Jml)</th>
                    <th>Istirahat Lebih (Jam:Menit)</th>
                    <th>Scan Kerja 1 X</th>
                    <th>Lembur (Jam)</th>
                    <th>Lembur (Menit)</th>
                    <th>Tidak Hadir (Jml)</th>
                    <th>Libur Rutin</th>
                    <th>Libur Umum</th>
                    <th>Izin Tidak Masuk (Pribadi)</th>
                    <th>Izin Pulang Awal (Pribadi)</th>
                    <th>Izin Datang Terlambat (Pribadi)</th>
                    <th>Sakit Dengan Surat Dokter</th>
                    <th>Sakit Tanpa Surat Dokter</th>
                    <th>Izin Meninggalkan Tempat Kerja</th>
                    <th>Izin Dinas (Kantor)</th>
                    <th>Izin Datang Terlambat (Kantor)</th>
                    <th>Izin Pulang Awal (Kantor)</th>
                    <th>Cuti Normatif</th>
                    <th>Cuti Pribadi</th>
                    <th>Tidak Scan Masuk</th>
                    <th>Tidak Scan Pulang</th>
                    <th>Tidak Scan Mulai Istirahat</th>
                    <th>Tidak Scan Selesai Istirahat</th>
                    <th>Tidak Scan Mulai Lembur</th>
                    <th>Tidak Scan Selesai Lembur</th>
                    <th>Izin Lain-lain (Jml)</th>
                    <th>Izin Lain-lain (Jam:Menit)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->pin }}</td>
                        <td>{{ $attendance->nip }}</td>
                        <td>{{ $attendance->nama }}</td>
                        <td>{{ $attendance->jabatan }}</td>
                        <td>{{ $attendance->departemen }}</td>
                        <td>{{ $attendance->kantor }}</td>
                        <td>{{ $attendance->jumlah_kehadiran }}</td>
                        <td>{{ $attendance->jam_kehadiran }}</td>
                        <td>{{ $attendance->jumlah_datang_terlambat }}</td>
                        <td>{{ $attendance->jam_datang_terlambat }}</td>
                        <td>{{ $attendance->jumlah_pulang_awal }}</td>
                        <td>{{ $attendance->jam_pulang_awal }}</td>
                        <td>{{ $attendance->jumlah_istirahat_lebih }}</td>
                        <td>{{ $attendance->jam_istirahat_lebih }}</td>
                        <td>{{ $attendance->scan_1x }}</td>
                        <td>{{ $attendance->jam }}</td>
                        <td>{{ $attendance->menit }}</td>
                        <td>{{ $attendance->tanpa_izin }}</td>
                        <td>{{ $attendance->rutin_umum }}</td>
                        <td>{{ $attendance->rutin_umum }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                        <td>{{ $attendance->izin_libur }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
