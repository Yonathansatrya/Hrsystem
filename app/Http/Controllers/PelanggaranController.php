<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeRecord;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PelanggaranController extends Controller
{
    // Menampilkan daftar pelanggaran
    public function index()
    {
        $employee_records = EmployeeRecord::with('employee')->get();
        return view('employee_records.index', compact('employee_records'));
    }

    // Menampilkan form untuk menambahkan data pelanggaran baru
    public function create()
    {
        $employees = Employee::all();
        return view('employee_records.create', compact('employees'));
    }

    // Menyimpan data pelanggaran baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_number' => 'required|string|exists:employees,id_number',
            'offense_type' => 'required|string|max:255',
            'offense_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        EmployeeRecord::create([
            'id_number' => $validated['id_number'],
            'offense_type' => $validated['offense_type'],
            'offense_date' => $validated['offense_date'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('employee_records.index')->with('success', 'Data pelanggaran berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data pelanggaran
    public function edit(EmployeeRecord $employeeRecord)
    {
        $employees = Employee::all();
        return view('employee_records.edit', compact('employeeRecord', 'employees'));
    }

    // Memperbarui data pelanggaran
    public function update(Request $request, EmployeeRecord $employeeRecord)
    {
        $validated = $request->validate([
            'id_number' => 'required|string|exists:employees,id_number',
            'offense_type' => 'required|string|max:255',
            'offense_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $employeeRecord->update($validated);

        return redirect()->route('employee_records.index')->with('success', 'Data pelanggaran berhasil diperbarui.');
    }

    // Menghapus data pelanggaran
    public function destroy(EmployeeRecord $employeeRecord)
    {
        $employeeRecord->delete();
        return redirect()->route('employee_records.index')->with('success', 'Data pelanggaran berhasil dihapus.');
    }

    // Menangani follow-up untuk pelanggaran
    public function comment(Request $request, $id)
    {  
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);
    
        // Simpan komentar ke database (misalnya, menggunakan model Comment)
        // Contoh:
        $record = EmployeeRecord::find($id);
        if (!$record) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    
        // Simpan komentar, ganti dengan logika penyimpanan yang sesuai
        // Comment::create(['record_id' => $id, 'comment' => $request->comment]);
    
        return response()->json(['message' => 'Komentar berhasil dikirim']);
    }
    

    // Ekspor data pelanggaran ke spreadsheet
    public function exportToSpreadsheet()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan header kolom
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama Karyawan');
        $sheet->setCellValue('C1', 'Jenis Pelanggaran');
        $sheet->setCellValue('D1', 'Tanggal Pelanggaran');
        $sheet->setCellValue('E1', 'Deskripsi');

        // Ambil data dari model Anda
        $employeeRecords = EmployeeRecord::with('employee')->get();
        $row = 2; // Mulai dari baris kedua setelah header
        foreach ($employeeRecords as $record) {
            $sheet->setCellValue('A' . $row, $record->id);
            $sheet->setCellValue('B' . $row, $record->employee ? $record->employee->full_name : 'N/A');
            $sheet->setCellValue('C' . $row, $record->offense_type);
            $sheet->setCellValue('D' . $row, $record->offense_date->format('Y-m-d'));
            $sheet->setCellValue('E' . $row, $record->description);
            $row++;
        }

        // Mengatur nama file
        $writer = new Xlsx($spreadsheet); // Atau Ods jika Anda menggunakan ODS
        $filename = 'data_pelanggaran.xlsx';

        // Mengatur header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Menyimpan file ke output
        $writer->save('php://output');
        exit;
    }
}
