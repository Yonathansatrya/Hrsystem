@extends('auth.sidebar')

@section('title', 'Daftar Karyawan BN')
<link rel="stylesheet" href="{{ asset('css/read.css') }}">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

@section('content')
    <div class="container">
        <h1>Daftar Karyawan</h1>

        <div class="actions">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Tambah Data Karyawan</a>
            <a href="{{ route('employees.export') }}" class="btn btn-success">Ekspor Data Karyawan</a>
        </div>
        
        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data" class="import-form">
            @csrf
            <input type="file" name="file" required>
            <button type="submit" class="btn btn-info">Impor Data Karyawan</button>
        </form>
        
        <div class="employee-cards mt-4">
            @foreach ($employees as $employee)
                <div class="employee-card">
                    <img src="{{ asset('storage/employees/' . $employee->photo) }}" alt="Foto Karyawan" class="employee-photo">
                    <div class="employee-info">
                        <h3>{{ $employee->full_name }}</h3>
                        <p>Status: {{ $employee->status }}</p>
                        <p>Jabatan: {{ $employee->position }}</p>
                        <p>Durasi Kerja: {{ $employee->work_duration }} tahun</p>
                        <button class="btn btn-outline-primary view-btn" data-id="{{ $employee->id }}" data-bs-toggle="modal"
                            data-bs-target="#employeeModal">Show Details</button>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="employeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="employeeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="employeeModalLabel">Detail Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-body-content">
                            <!-- Konten data karyawan akan diisi oleh JavaScript -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <script>
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function() {
                const employeeId = this.getAttribute('data-id');

                fetch(`/employees/${employeeId}`)
                    .then(response => response.json())
                    .then(employee => {
                        const modalBodyContent = document.getElementById('modal-body-content');

                        modalBodyContent.innerHTML = `
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/employees/') }}/${employee.photo}" alt="Foto Karyawan" class="employee-photo img-fluid">
                        </div>
                        <div class="col-md-8">
                            <p><strong>No KTP:</strong> ${employee.id_number}</p>
                            <p><strong>Nama Lengkap:</strong> ${employee.full_name}</p>
                            <p><strong>Email:</strong> ${employee.email}</p>
                            <p><strong>Jenis Kelamin:</strong> ${employee.gender}</p>
                            <p><strong>Tempat Lahir:</strong> ${employee.place_birth}</p>
                            <p><strong>Tanggal Lahir:</strong> ${employee.birth_date}</p>
                            <p><strong>Status:</strong> ${employee.status}</p>
                            <p><strong>Alamat:</strong> ${employee.residence_address}</p>
                            <p><strong>Telepon:</strong> ${employee.phone}</p>
                            <p><strong>Golongan Darah:</strong> ${employee.blood_type}</p>
                            <p><strong>Agama:</strong> ${employee.religion}</p>
                        </div>
                    </div>
                    <h3>Data Keluarga</h3>
                    <ul>
                        ${employee.family_data.map(family => `<li>${family.relationship}: ${family.name}</li>`).join('')}
                    </ul>
                    <div class="modal-footer">
                        <a href="/employees/${employee.id}/edit" class="btn btn-primary">Edit</a>
                        <a href="/employees/${employee.id}/archive" class="btn btn-danger">Archive</a>
                    </div>`;
                    });
            });
        });
    </script>
@endsection
