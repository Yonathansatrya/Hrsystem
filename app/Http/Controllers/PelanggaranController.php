<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeRecord;

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
    public function followUp(Request $request)
    {
        $request->validate([
            'employee_record_id' => 'required|exists:employee_records,id',
            'comment' => 'required|string',
        ]);

        $employeeRecord = EmployeeRecord::findOrFail($request->employee_record_id);
        // Logika untuk menyimpan follow-up atau komentar, bisa ditambahkan ke dalam database
        $employeeRecord->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('employee_records.index')->with('success', 'Komentar berhasil ditambahkan.');
    }
}
