@extends('auth.sidebar')
<link rel="stylesheet" href="{{ asset('css/notifcations.css') }}">
@section('content')
    <div class="notifications-container">
        <h1>Notifikasi</h1>

        @if($notifications->isEmpty())
            <p>Tidak ada notifikasi baru.</p>
        @else
            <ul class="notification-list">
                @foreach($notifications as $notification)
                    <li class="notification-item">
                        <div class="notification-message">
                            {{ $notification->data['message'] }} <!-- Gantilah dengan data yang sesuai -->
                            <small class="notification-time">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>
                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn mark-as-read">Tandai sebagai sudah dibaca</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
