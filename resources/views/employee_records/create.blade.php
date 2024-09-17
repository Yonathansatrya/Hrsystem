<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pelanggaran</title>
    <link rel="stylesheet" href="{{ asset('css/pelanggaran.css') }}">
</head>
<body>
    <div class="container">
        <h1>Tambah Data Pelanggaran</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employee_records.store') }}" method="POST">
            @csrf
            <div>
                <label for="id_number">ID Karyawan:</label>
                <select id="id_number" name="id_number" required>
                    <option value="">Pilih Karyawan</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id_number }}">{{ $employee->full_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="offense_type">Jenis Pelanggaran:</label>
                <input type="text" id="offense_type" name="offense_type" required>
            </div>
            <div>
                <label for="offense_date">Tanggal Pelanggaran:</label>
                <input type="date" id="offense_date" name="offense_date" required>
            </div>
            <div>
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <button type="submit">Simpan</button>

            <a href="{{ route('employee_records.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
