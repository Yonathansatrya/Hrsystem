@extends('admin.dashboard')

@section('title', 'Import Attendance Data')

@section('content')
    <h1>Import Attendance Data</h1>
    <form action="{{ route('attendances.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Upload File Excel:</label>
        <input type="file" name="file" required>
        <button type="submit" class="import-button">Import Data</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
