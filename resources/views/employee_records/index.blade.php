@extends('auth.sidebar')

@section('title', 'Data Pelanggaran')
<link rel="stylesheet" href="{{ asset('css/pelanggaran.css') }}">
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
                                <button class="view-docs-btn" onclick="openDocumentModal({{ $record->id }})">Lihat Dokumen</button>
                                <button class="follow-up-btn" data-id="{{ $record->id }}" onclick="openCommentModal({{ $record->id }})">Komentar</button>
                                <a href="{{ route('employee_records.edit', $record->id) }}" class="edit-btn">Edit</a>
                                <form action="{{ route('employee_records.destroy', $record->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggaran ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk melihat dokumen -->
    <div id="documentModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeDocumentModal()">&times;</span>
            <h2>Dokumen Pelanggaran</h2>
            <img id="documentImage" src="" alt="Dokumen" style="max-width: 100%;">
        </div>
    </div>

    <!-- Modal untuk komentar -->
    <div id="commentModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeCommentModal()">&times;</span>
            <h2>Komentar</h2>
            <textarea id="commentText" placeholder="Tulis komentar..." rows="3" required></textarea>
            <button id="submitCommentBtn">Kirim</button>
        </div>
    </div>

    <script>
        function openCommentModal(recordId) {
            document.getElementById('commentModal').style.display = 'block';
            document.getElementById('submitCommentBtn').onclick = function() {
                submitComment(recordId);
            };
        }

        function submitComment(recordId) {
            var comment = document.getElementById('commentText').value;

            // Kirim komentar ke server menggunakan AJAX
            fetch(`{{ url('employee_records.comment') }}/${recordId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ comment: comment })
            })
            .then(response => response.json())
            .then(data => {
                alert('Komentar Anda telah dikirim.');
                closeCommentModal();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim komentar.');
            });
        }

        function openDocumentModal(recordId) {
            // Ganti URL di bawah ini dengan path dokumen yang sesuai
            document.getElementById('documentImage').src = '/path/to/document/' + recordId + '.jpg'; // Ganti dengan logika yang sesuai untuk mendapatkan dokumen
            document.getElementById('documentModal').style.display = 'block';
        }

        function closeDocumentModal() {
            document.getElementById('documentModal').style.display = 'none';
        }

        function closeCommentModal() {
            document.getElementById('commentModal').style.display = 'none';
            document.getElementById('commentText').value = ''; // Reset textarea
        }
    </script>

    <style>
        .modal {
            display: none; /* Sembunyikan modal secara default */
            position: fixed; /* Tetap di tempat */
            z-index: 1; /* Di atas konten lainnya */
            left: 0;
            top: 0;
            width: 100%; /* Lebar penuh */
            height: 100%; /* Tinggi penuh */
            overflow: auto; /* Tambahkan scroll jika diperlukan */
            background-color: rgb(0,0,0); /* Warna latar belakang */
            background-color: rgba(0,0,0,0.4); /* Latar belakang transparan */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% dari atas dan auto untuk samping */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Lebar modal */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;    
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
@endsection
