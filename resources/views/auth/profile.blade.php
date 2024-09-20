@extends('auth.dashboard')

@section('title', 'Profil Saya')

<link rel="stylesheet" href="{{asset('css/profile.css')}}">
@section('content')
<div class="profile-container">
    <div class="profile-header">
        <img src="{{ asset('images/' . $user->profile_picture) }}" alt="Foto Profil" class="profile-picture">
        <h2>{{ $user->full_name }}</h2>
        <p>{{ \Carbon\Carbon::parse($user->birth_date)->age }} Tahun</p>
    </div>

    <!-- Tombol Notifikasi dengan Icon -->
    <div class="notification-button">
        <button type="button" id="show-notifications">
            <img src="{{ asset('images/bell.png') }}" alt="Notifikasi" class="notification-icon">
            Lihat Notifikasi
        </button>
    </div>

    <div class="profile-info">
        <h3>Informasi Pribadi</h3>
        <table class="profile-table">
            <tr>
                <th>Nomor ID</th>
                <td>{{ $user->id_number }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $user->position }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $user->residence_address }}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <th>Status Pernikahan</th>
                <td>{{ $user->marital_status }}</td>
            </tr>
            <tr>
                <th>Hobi</th>
                <td>{{ $user->hobby }}</td>
            </tr>
            <tr>
                <th>Golongan Darah</th>
                <td>{{ $user->blood_type }}</td>
            </tr>
            <tr>
                <th>Pendidikan Terakhir</th>
                <td>{{ $user->last_education }}</td>
            </tr>
            <tr>
                <th>Lembaga Pendidikan</th>
                <td>{{ $user->agency }}</td>
            </tr>
            <tr>
                <th>Tahun Lulus</th>
                <td>{{ $user->graduation_year }}</td>
            </tr>
            <tr>
                <th>Pengalaman Organisasi</th>
                <td>{{ $user->organizational_experience }}</td>
            </tr>
        </table>

        <h3>Informasi Keluarga</h3>
        <table class="family-table">
            <thead>
                <tr>
                    <th>Pendamping</th>
                    <th>Anak</th>
                    <th>Tanggal Pernikahan</th>
                    <th>No. Akta Pernikahan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($familyData as $family)
                <tr>
                    <td>{{ $family->mate_name }}</td>
                    <td>{{ $family->child_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($family->wedding_date)->format('d-m-Y') }}</td>
                    <td>{{ $family->wedding_certificate_number }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Data keluarga tidak tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="edit-request">
            <button type="button" id="edit-button">Edit Profil</button>
            <div id="edit-request-form" class="edit-form">
                <h3>Permintaan Edit Profil</h3>
                <form action="{{ route('profile.requestEdit') }}" method="POST">
                    @csrf
                    <textarea name="reason" rows="4" placeholder="Jelaskan alasan mengapa Anda perlu mengedit profil ini..." required></textarea>
                    <button type="submit">Kirim Permintaan</button>
                    <button type="button" id="cancel-edit">Batal</button> <!-- Tombol Batal -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .profile-container {
        text-align: center;
        margin-top: 20px;
    }

    .profile-header {
        margin-bottom: 20px;
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }

    .notification-button {
        margin-bottom: 20px;
    }

    .notification-icon {
        width: 24px;
        height: 24px;
        margin-right: 5px;
    }

    .profile-info {
        text-align: left;
        margin: 0 auto;
        width: 60%;
    }

    .profile-table, .family-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .profile-table th, .profile-table td,
    .family-table th, .family-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .profile-table th, .family-table th {
        background-color: #f4f4f4;
        text-align: left;
    }

    .edit-request {
        margin-top: 20px;
        text-align: left;
    }

    .edit-form {
        display: none;
        margin-top: 20px;
        text-align: left;
    }

    .edit-form textarea {
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .edit-form button {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .edit-form button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    document.getElementById('edit-button').onclick = function() {
        document.getElementById('edit-request-form').style.display = 'block';
    }

    document.getElementById('cancel-edit').onclick = function() {
        document.getElementById('edit-request-form').style.display = 'none';
    }

    document.getElementById('show-notifications').onclick = function() {
        alert('Notifikasi akan ditampilkan di sini.'); // Ini contoh, bisa diganti dengan logika yang diinginkan
    }
</script>
