<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <script>
        function toggleContractDate() {
            var status = document.getElementById('status').value;
            var contractDateField = document.getElementById('contract_date');
            var contractDateLabel = document.getElementById('contract_date_label');
            if (status === 'Kontrak') {
                contractDateField.style.display = 'block';
                contractDateLabel.style.display = 'block';
            } else {
                contractDateField.style.display = 'none';
                contractDateLabel.style.display = 'none';
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
    <h1>Edit Karyawan</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        <fieldset>
            <legend>Data Karyawan</legend>
            <label for="id_number">No KTP:</label>
            <input type="number" id="id_number" name="id_number" value="{{ old('id_number', $employee->id_number) }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $employee->email) }}" required>

            <label for="full_name">Nama Lengkap:</label>
            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $employee->full_name) }}" required>

            <label for="nickname">Nama Panggilan:</label>
            <input type="text" id="nickname" name="nickname" value="{{ old('nickname', $employee->nickname) }}" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required onchange="toggleContractDate()">
                <option value="Tetap" {{ old('status', $employee->status) === 'Tetap' ? 'selected' : '' }}>Tetap</option>
                <option value="Kontrak" {{ old('status', $employee->status) === 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
            </select>

            <label for="contract_date" id="contract_date_label" style="{{ old('status', $employee->status) === 'Kontrak' ? 'display: block;' : 'display: none;' }}">Tanggal Kontrak:</label>
            <input type="date" id="contract_date" name="contract_date" value="{{ old('contract_date', $employee->contract_date ? $employee->contract_date->format('Y-m-d') : '') }}" style="{{ old('status', $employee->status) === 'Kontrak' ? 'display: block;' : 'display: none;' }}">

            <label for="work_date">Tanggal Mulai Kerja:</label>
            <input type="date" id="work_date" name="work_date" value="{{ old('work_date', $employee->work_date ? $employee->work_date->format('Y-m-d') : '') }}" required>

            <label for="position">Jabatan:</label>
            <input type="text" id="position" name="position" value="{{old('position', $employee->position)}}" required>

            <label for="gender">Jenis Kelamin:</label>
            <select id="gender" name="gender" required>
                <option value="pria" {{ old('gender', $employee->gender) === 'pria' ? 'selected' : '' }}>Pria</option>
                <option value="wanita" {{ old('gender', $employee->gender) === 'wanita' ? 'selected' : '' }}>Wanita</option>
            </select>

            <label for="place_birth">Tempat Lahir:</label>
            <input type="text" id="place_birth" name="place_birth" value="{{ old('place_birth', $employee->place_birth) }}" required>

            <label for="birth_date">Tanggal Lahir:</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $employee->birth_date ? $employee->birth_date->format('Y-m-d') : '') }}" required>

            <label for="religion">Agama:</label>
            <select id="religion" name="religion" required>
                <option value="Islam" {{ old('religion', $employee->religion) === 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('religion', $employee->religion) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('religion', $employee->religion) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('religion', $employee->religion) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Budha" {{ old('religion', $employee->religion) === 'Budha' ? 'selected' : '' }}>Budha</option>
            </select>

            <label for="hobby">Hobi:</label>
            <input type="text" id="hobby" name="hobby" value="{{ old('hobby', $employee->hobby) }}">

            <label>Status Perkawinan:</label>
            <div>
                <input type="radio" id="married" name="marital_status" value="menikah" {{ old('marital_status', $employee->marital_status) === 'menikah' ? 'checked' : '' }} required>
                <label for="married">Menikah</label>
            </div>
            <div>
                <input type="radio" id="single" name="marital_status" value="belum" {{ old('marital_status', $employee->marital_status) === 'belum' ? 'checked' : '' }} required>
                <label for="single">Belum Menikah</label>
            </div>

            <label for="residence_address">Alamat Domisili:</label>
            <textarea id="residence_address" name="residence_address" required>{{ old('residence_address', $employee->residence_address) }}</textarea>

            <label for="phone">No. HP:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" required>

            <label for="address_emergency">Alamat Darurat:</label>
            <textarea id="address_emergency" name="address_emergency" required>{{ old('address_emergency', $employee->address_emergency) }}</textarea>

            <label for="phone_emergency">No. HP Darurat:</label>
            <input type="text" id="phone_emergency" name="phone_emergency" value="{{ old('phone_emergency', $employee->phone_emergency) }}" required>

            <label for="blood_type">Golongan Darah:</label>
            <select id="blood_type" name="blood_type">
                <option value="A" {{ old('blood_type', $employee->blood_type) === 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('blood_type', $employee->blood_type) === 'B' ? 'selected' : '' }}>B</option>
                <option value="AB" {{ old('blood_type', $employee->blood_type) === 'AB' ? 'selected' : '' }}>AB</option>
                <option value="O" {{ old('blood_type', $employee->blood_type) === 'O' ? 'selected' : '' }}>O</option>
            </select>

            <label for="last_education">Pendidikan Terakhir:</label>
            <input type="text" id="last_education" name="last_education" value="{{ old('last_education', $employee->last_education) }}">

            <label for="agency">Instansi:</label>
            <input type="text" id="agency" name="agency" value="{{ old('agency', $employee->agency) }}">

            <label for="graduation_year">Tahun Lulus:</label>
            <input type="number" id="graduation_year" name="graduation_year" value="{{ old('graduation_year', $employee->graduation_year) }}">

            <label for="competency_training_place">Tempat Pelatihan Kompetensi:</label>
            <input type="text" id="competency_training_place" name="competency_training_place" value="{{ old('competency_training_place', $employee->competency_training_place) }}">

            <label for="organizational_experience">Pengalaman Organisasi:</label>
            <textarea id="organizational_experience" name="organizational_experience">{{ old('organizational_experience', $employee->organizational_experience) }}</textarea>
        </fieldset>

        <fieldset id="family-data" style="{{ old('marital_status', $employee->marital_status) === 'menikah' ? 'display: block;' : 'display: none;' }}">
            <legend>Data Keluarga</legend>

            <label for="mate_name">Nama Pasangan:</label>
            <input type="text" id="mate_name" name="mate_name" value="{{ old('mate_name', $employee->mate_name) }}">

            <label for="child_name">Nama Anak:</label>
            <input type="text" id="child_name" name="child_name" value="{{ old('child_name', $employee->child_name) }}">

            <label for="wedding_date">Tanggal Menikah:</label>
            <input type="date" id="wedding_date" name="wedding_date" value="{{ old('wedding_date', $employee->wedding_date ? $employee->wedding_date->format('Y-m-d') : '') }}">

            <label for="wedding_certificate_number">Nomor Akta Nikah:</label>
            <input type="text" id="wedding_certificate_number" name="wedding_certificate_number" value="{{ old('wedding_certificate_number', $employee->wedding_certificate_number) }}">
        </fieldset>

        <button type="submit">Simpan</button>

        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</body>

</html>
