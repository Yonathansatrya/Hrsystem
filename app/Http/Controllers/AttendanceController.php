<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Imports\AttendancesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendance.index', compact('attendances'));
    }

    public function showImportView()
    {
        return view('attendance.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new AttendancesImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data berhasil diimpor');
        } catch (\Exception $e) {
            Log::error('Gagal mengimpor data kehadiran: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengimpor data kehadiran. Silakan periksa format file atau data.');
        }
    }
}
