@extends('auth.dashboard')

@section('title', 'Data Pelanggaran')
 <link rel="stylesheet" href="{{asset('css/pelanggaran.css')}}">
@section('content')
    <div class="container">
        <h1>Data Pelanggaran</h1>
        <a href="{{ route('employee_records.create') }}" class="add-employee-btn">Tambah Data Pelanggaran</a>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Karyawan</th>
                        <th>Jenis Pelanggaran</th>
                        <th>Tanggal Pelanggaran</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employee_records as $record)
                        <tr id="record-{{ $record->id }}">
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->employee ? $record->employee->full_name : 'N/A' }}</td>
                            <td>{{ $record->offense_type }}</td>
                            <td>{{ $record->offense_date->format('Y-m-d') }}</td>
                            <td>{{ $record->description }}</td>
                            <td class="action-cell">
                                <form action="{{ route('employee_records.comment', $record->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="follow-up-btn" data-id="{{ $record->id }}" type="button" onclick="toggleCommentForm({{ $record->id }})">Komentar</button>
                                    <div id="comment-form-{{ $record->id }}" style="display: none;">
                                        <textarea name="comment" rows="3" placeholder="Tulis komentar..." required></textarea>
                                        <button type="submit">Kirim</button>
                                    </div>
                                </form>
                                <a href="{{ route('employee_records.edit', $record->id) }}" class="edit-btn">Edit</a>
                                <form action="{{ route('employee_records.destroy', $record->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggaran ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleCommentForm(recordId) {
            var formContainer = document.getElementById('comment-form-' + recordId);
            if (formContainer.style.display === 'none') {
                formContainer.style.display = 'block';
            } else {
                formContainer.style.display = 'none';
            }
        }
    </script>
@endsection
