@extends('auth.dashboard')

@section('title', 'Tambah Karyawan')

@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <script>
        function toggleContractDate() {
            var status = document.getElementById('status').value;
            var contractDateField = document.getElementById('contract_date');
            var contractDateLabel = document.getElementById('contract_date_label');
            var workDateField = document.getElementById('work_date');
            var workDateLabel = document.getElementById('work_date_label');
            if (status === 'Kontrak') {
                contractDateField.style.display = 'block';
                contractDateLabel.style.display = 'block';
                workDateField.style.display = 'none';
                workDateLabel.style.display = 'none';
            } else {
                contractDateField.style.display = 'none';
                contractDateLabel.style.display = 'none';
                workDateField.style.display = 'block';
                workDateLabel.style.display = 'block';
            }
        }

        function toggleFamilyData() {
            var maritalStatus = document.querySelector('input[name="marital_status"]:checked');
            var familyDataFieldset = document.getElementById('family-data');
            if (maritalStatus && maritalStatus.value === 'menikah') {
                familyDataFieldset.style.display = 'block';
            } else {
                familyDataFieldset.style.display = 'none';
            }
        }

        window.onload = function() {
            toggleContractDate();
            toggleFamilyData();
            document.getElementById('status').addEventListener('change', toggleContractDate);
            document.querySelectorAll('input[name="marital_status"]').forEach(function(elem) {
                elem.addEventListener('change', toggleFamilyData);
            });
        };
    </script>
</head>

<body>
    <h1>Tambah Karyawan</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <fieldset>
            <legend>Data Karyawan</legend>
            <label for="id_number">No KTP:</label>
            <input type="number" id="id_number" name="id_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="full_name">Nama Lengkap:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="nickname">Nama Panggilan:</label>
            <input type="text" id="nickname" name="nickname" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
            </select>

            <label for="contract_date" id="contract_date_label" style="display: none;">Tanggal Kontrak:</label>
            <input type="date" id="contract_date" name="contract_date" style="display: none;">

            <label for="work_date" id="work_date_label">Tanggal Di angkat Tetap:</label>
            <input type="date" id="work_date" name="work_date" required>

            <label for="position">Jabatan:</label>
            <select id="position" name="position" required>
                <option value="GURU">Guru</option>
                <option value="Kepala Sekolah">Kepala Sekolah</option>
                <option value="Pamong Aspa">Pamong Aspa</option>
                <option value="Pamong Aspi">Pamong Aspi</option>
                <option value="Supir">Supir</option>
                <option value="Staf Kebersihan">Staf Kebersihan</option>
                <option value="HRD">HRD</option>
            </select>

            <label for="gender">Jenis Kelamin:</label>
            <select id="gender" name="gender" required>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
            </select>

            <label for="place_birth">Tempat Lahir:</label>
            <input type="text" id="place_birth" name="place_birth" required>

            <label for="birth_date">Tanggal Lahir:</label>
            <input type="date" id="birth_date" name="birth_date" required>

            <label for="religion">Agama:</label>
            <select id="religion" name="religion" required>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
            </select>

            <label for="hobby">Hobi:</label>
            <input type="text" id="hobby" name="hobby">

            <label>Status Perkawinan:</label>
            <div class="marital-status-container">
                <div>
                    <input type="radio" id="married" name="marital_status" value="menikah" required>
                    <label for="married">Menikah</label>
                </div>
                <div>
                    <input type="radio" id="single" name="marital_status" value="belum" required>
                    <label for="single">Belum Menikah</label>
                </div>
            </div>

            <label for="residence_address">Alamat Domisili:</label>
            <textarea id="residence_address" name="residence_address" required></textarea>

            <label for="phone">No. HP:</label>
            <input type="number" id="phone" name="phone" required>

            <label for="address_emergency">Alamat Darurat:</label>
            <textarea id="address_emergency" name="address_emergency" required></textarea>

            <label for="phone_emergency">No. HP Darurat:</label>
            <input type="number" id="phone_emergency" name="phone_emergency" required>

            <label for="blood_type">Golongan Darah:</label>
            <select id="blood_type" name="blood_type">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
                <option value="Tidak Diketahui">Tidak Diketahui</option>
            </select>

            <label for="last_education">Pendidikan Terakhir:</label>
            <input type="text" id="last_education" name="last_education">

            <label for="agency">Instansi:</label>
            <input type="text" id="agency" name="agency">

            <label for="graduation_year">Tahun Lulus:</label>
            <input type="number" id="graduation_year" name="graduation_year" min="1900" max="2100">

            <label for="competency_training_place">Tempat Pelatihan Kompetensi:</label>
            <input type="text" id="competency_training_place" name="competency_training_place">

            <label for="organizational_experience">Pengalaman Organisasi:</label>
            <textarea id="organizational_experience" name="organizational_experience"></textarea>
        </fieldset>

        <fieldset id="family-data" style="display: none;">
            <legend>Data Keluarga</legend>

            <label for="mate_name">Nama Pasangan:</label>
            <input type="text" id="mate_name" name="mate_name">

            <label for="child_name">Nama Anak:</label>
            <input type="text" id="child_name" name="child_name">

            <label for="wedding_date">Tanggal Menikah:</label>
            <input type="date" id="wedding_date" name="wedding_date">

            <label for="wedding_certificate_number">Nomor Akta Nikah:</label>
            <input type="number" id="wedding_certificate_number" name="wedding_certificate_number">
        </fieldset>

        <button type="submit">Simpan</button>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>

<style>
label[for="married"], label[for="single"] {
    display: inline-block;
    margin-right: 20px;
}

input[type="radio"] {
    margin-right: 5px;
    vertical-align: middle;
}

.marital-status-container {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}
</style>
</html>
@endsection
