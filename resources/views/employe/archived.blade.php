@extends('auth.sidebar')

@section('title', 'Karyawan Terarsip')
<link rel="stylesheet" href="{{asset('css/read.css')}}">
@section('content')
    <div class="container">
        <h1>Karyawan Terarsip</h1>

        <a href="{{ route('employees.index') }}" class="back-btn">Kembali ke Daftar Karyawan</a>

        <!-- Tabel Data Karyawan -->
        <div class="table-wrapper">
            <h2>Data Karyawan</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Panggilan</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Email</th>
                        <th>Hobi</th>
                        <th>Status Pernikahan</th>
                        <th>Alamat Tinggal</th>
                        <th>No. Telepon</th>
                        <th>Alamat Darurat</th>
                        <th>No. Telepon Darurat</th>
                        <th>Golongan Darah</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Lembaga Pendidikan</th>
                        <th>Tahun Lulus</th>
                        <th>Tempat Pelatihan Kompetensi</th>
                        <th>Pengalaman Organisasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id_number }}</td>
                            <td>{{ $employee->full_name }}</td>
                            <td>{{ $employee->nickname }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->status }}</td>
                            <td>{{ $employee->gender }}</td>
                            <td>{{ $employee->place_birth }}</td>
                            <td>{{ $employee->birth_date->format('Y-m-d') }}</td>
                            <td>{{ $employee->religion }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->hobby }}</td>
                            <td>{{ $employee->marital_status }}</td>
                            <td>{{ $employee->residence_address }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->address_emergency }}</td>
                            <td>{{ $employee->phone_emergency }}</td>
                            <td>{{ $employee->blood_type }}</td>
                            <td>{{ $employee->last_education }}</td>
                            <td>{{ $employee->agency }}</td>
                            <td>{{ $employee->graduation_year }}</td>
                            <td>{{ $employee->competency_training_place }}</td>
                            <td>{{ $employee->organizational_experience }}</td>
                            <td class="action-cell">
                                {{-- Unarchive Button --}}
                                <form action="{{ route('employees.restore', $employee->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="unarchive-btn" onclick="return confirm('Apakah Anda yakin ingin mengembalikan karyawan ini dari arsip?')">Unarchive</button>
                                </form>

                                {{-- Delete Button --}}
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini? Semua data akan dihapus.')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Data Keluarga -->
        <div class="table-wrapper">
            <h2>Data Keluarga</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Nama Pasangan</th>
                        <th>Nama Anak</th>
                        <th>Tanggal Pernikahan</th>
                        <th>No. Sertifikat Pernikahan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        @forelse ($employee->familyData as $family)
                            <tr>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->full_name }}</td>
                                <td>{{ $family->mate_name ?? 'N/A' }}</td>
                                <td>{{ $family->child_name ?? 'N/A' }}</td>
                                <td>{{ $family->wedding_date ? $family->wedding_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ $family->wedding_certificate_number ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Data keluarga tidak tersedia</td>
                            </tr>
                        @endforelse
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
