<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\EmployeeRecord;
use App\Models\FamilyData;
use App\Models\Comment; // Import model Comment
use App\Models\Notification; // Import model Notification
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'id_number' => 'required'
        ]);

        Log::info('Login attempt with email: ' . $request->email);

        // Cek apakah login menggunakan id_number atau email
        $loginType = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'id_number';

        // Ambil employee berdasarkan email atau id_number
        $employee = Employee::where($loginType, $request->email)
                            ->where('id_number', $request->id_number)
                            ->first();

        if ($employee) {
            Log::info('Employee found: ', $employee->toArray());
            Auth::login($employee);

            // Arahkan ke dashboard sesuai dengan peran user
            if ($employee->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        } else {
            Log::warning('Login failed for email: ' . $request->email);
            return back()->withErrors([
                'email' => 'Email atau ID Number salah.'
            ]);
        }
    }

    // Fungsi logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Fungsi untuk menampilkan kehadiran user
    public function userAttendances()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        $attendances = Attendance::where('pin', $user->id_number)->get(); // Ambil data kehadiran berdasarkan ID number
        return view('auth.attendaces', compact('attendances')); // Menampilkan data kehadiran di view
    }

    // Fungsi untuk menampilkan catatan pelanggaran user
    public function userRecords()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        $records = EmployeeRecord::where('id_number', $user->id_number)->get(); // Ambil data pelanggaran berdasarkan ID number
        return view('auth.record', compact('records')); // Menampilkan catatan pelanggaran di view
    }

    // Fungsi untuk menampilkan profil user
    public function userProfile()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        $familyData = FamilyData::where('employee_id', $user->id)->get(); // Ambil data keluarga berdasarkan employee_id
        return view('auth.profile', compact('user', 'familyData')); // Menampilkan profil dan data keluarga di view
    }

    // Fungsi untuk memproses permintaan edit profil
    public function requestEdit(Request $request)
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        // Validasi alasan edit
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        // Logika tambahan bisa ditambahkan di sini untuk menyimpan atau mengirimkan notifikasi ke admin
        $message = "User $user->full_name meminta izin untuk mengedit profilnya dengan alasan: " . $request->input('reason');

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('user.profile')->with('status', 'Permintaan edit profil telah dikirim ke admin.');
    }

    // Fungsi untuk menambahkan komentar
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'employee_record_id' => 'required|exists:employee_records,id', // Sesuaikan dengan nama tabel dan kolom Anda
        ]);

        $comment = Comment::create([
            'employee_record_id' => $request->employee_record_id,
            'comment' => $request->comment,
            'user_id' => Auth::id(), // ID pengguna yang memberikan komentar
        ]);

        // Membuat notifikasi untuk pengguna terkait
        Notification::create([
            'notifiable_id' => $comment->employee_record_id, // ID record yang dikomentari
            'notifiable_type' => 'App\Models\EmployeeRecord', // Tipe notifikasi, sesuaikan dengan model yang digunakan
            'type' => 'comment', // Tipe notifikasi, bisa disesuaikan
            'data' => json_encode(['comment' => $comment->comment, 'user_id' => Auth::id()]),
        ]);

        return redirect()->back()->with('status', 'Komentar berhasil ditambahkan dan notifikasi telah dikirim.');
    }
}
