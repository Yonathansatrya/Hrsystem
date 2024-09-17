<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggaran</title>
    <link rel="stylesheet" href="{{ asset('css/pelanggaran.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Data Pelanggaran</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employee_records.update', $employeeRecord->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="id_number">ID Karyawan:</label>
                <select id="id_number" name="id_number" required>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id_number }}" {{ $employeeRecord->id_number == $employee->id_number ? 'selected' : '' }}>
                            {{ $employee->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="offense_type">Jenis Pelanggaran:</label>
                <input type="text" id="offense_type" name="offense_type" value="{{ $employeeRecord->offense_type }}" required>
            </div>
            <div>
                <label for="offense_date">Tanggal Pelanggaran:</label>
                <input type="date" id="offense_date" name="offense_date" value="{{ $employeeRecord->offense_date }}" required>
            </div>
            <div>
                <label for="description">Deskripsi:</label>
                <textarea id="description" name="description">{{ $employeeRecord->description }}</textarea>
            </div>
            <button type="submit">Update</button>

            <a href="{{ route('employee_records.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
