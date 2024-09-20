@extends('auth.dashboard')

@section('title', 'Daftar Karyawan BN')
<link rel="stylesheet" href="{{asset('css/read.css')}}">
@section('content')
    <div class="container">
        <h1>Daftar Karyawan</h1>

        <a href="{{ route('employees.create') }}" class="add-employee-btn">Tambah Data Karyawan</a>
        <a href="{{ route('employees.export') }}" class="export-btn">Ekspor Data Karyawan</a>

        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
            @csrf
            <input type="file" name="file" required>
            <button type="submit" class="import-btn">Impor Data Karyawan</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No Ktp</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Panggilan</th>
                        <th>Golongan</th>
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
                                <a href="{{ route('employees.edit', $employee->id) }}" class="edit-btn">Edit</a>
                                <form action="{{ route('employees.archive', $employee->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="archive-btn"
                                        onclick="return confirm('Apakah Anda yakin ingin mengarsipkan karyawan ini?')">Archive</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h1>Data Keluarga Karyawan</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Karyawan</th>
                        <th>Nama Pasangan</th>
                        <th>Nama Anak</th>
                        <th>Tanggal Menikah</th>
                        <th>Nomor Akta Nikah</th>
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
                                <td colspan="6">Tidak ada data keluarga</td>
                            </tr>
                        @endforelse
                    @endforeach
                </tbody>
            </table>
        </div>

        <h1>Golongan Karyawan</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Karyawan</th>
                        <th>Golongan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id_number }}</td>
                            <td>{{ $employee->full_name }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>{{ $employee->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
