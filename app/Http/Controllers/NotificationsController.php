<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    // Menampilkan notifikasi yang belum dibaca
    public function index()
    {
        $notifications = auth()->user()->notifications()->whereNull('read_at')->get(); // Ambil notifikasi yang belum dibaca
        return view('auth.notifications', compact('notifications'));
    }

    // Menandai notifikasi sebagai sudah dibaca
    public function markAsRead(Request $request, $notificationId)
    {
        // Mengambil notifikasi berdasarkan ID
        $notification = Auth::user()->notifications()->find($notificationId);

        if (!$notification) {
            return redirect()->back()->with('error', 'Notifikasi tidak ditemukan.');
        }

        // Menandai notifikasi sebagai sudah dibaca
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notifikasi telah ditandai sebagai sudah dibaca.');
    }
}
