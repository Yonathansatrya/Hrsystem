<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\FamilyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;

class EmployeeController extends Controller
{
    // Display Active Employees (not archived)
    public function index()
    {
        $employees = Employee::with('familyData')->where('archived', false)->get();
        return view('employe.read', compact('employees'));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new EmployeesImport, $file);

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diimpor.');
    }


    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    // Display Archived Employees
    public function archived()
    {
        $employees = Employee::with('familyData')->where('archived', true)->get();
        return view('Viewadmin.employe.archived', compact('employees'));
    }

    // Show Create Employee Form
    public function create()
    {
        return view('employe.create');
    }

    // Store New Employee
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            // Create the employee record
            $employee = Employee::create($request->only([
                'id_number',
                'email',
                'full_name',
                'nickname',
                'contract_date',
                'work_date',
                'status',
                'position',
                'gender',
                'place_birth',
                'birth_date',
                'religion',
                'hobby',
                'marital_status',
                'residence_address',
                'phone',
                'address_emergency',
                'phone_emergency',
                'blood_type',
                'last_education',
                'agency',
                'graduation_year',
                'competency_training_place',
                'organizational_experience',
                'archived'
            ]));

            // If family data is provided, create family data
            if ($request->filled('mate_name') || $request->filled('child_name')) {
                FamilyData::create([
                    'employee_id' => $employee->id,
                    'mate_name' => $request->input('mate_name'),
                    'child_name' => $request->input('child_name'),
                    'wedding_date' => $request->input('wedding_date'),
                    'wedding_certificate_number' => $request->input('wedding_certificate_number'),
                ]);
            }
        });

        return redirect()->route('employees.index')->with('success', 'Data karyawan dan keluarga berhasil disimpan.');
    }

    // Show Edit Employee Form
    public function edit($id)
    {
        $employee = Employee::with('familyData')->findOrFail($id);
        return view('Viewadmin.employe.edit', compact('employee'));
    }

    // Update Employee and Family Data
    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $employee = Employee::findOrFail($id);

            // Update employee data
            $employee->update($request->only([
                'id_number',
                'email',
                'full_name',
                'nickname',
                'contract_date',
                'work_date',
                'status',
                'position',
                'gender',
                'place_birth',
                'birth_date',
                'religion',
                'hobby',
                'marital_status',
                'residence_address',
                'phone',
                'address_emergency',
                'phone_emergency',
                'blood_type',
                'last_education',
                'agency',
                'graduation_year',
                'competency_training_place',
                'organizational_experience',
                'archived'
            ]));

            // Update or create family data
            if ($request->filled('mate_name') || $request->filled('child_name')) {
                FamilyData::updateOrCreate(
                    ['employee_id' => $employee->id],
                    [
                        'mate_name' => $request->input('mate_name'),
                        'child_name' => $request->input('child_name'),
                        'wedding_date' => $request->input('wedding_date'),
                        'wedding_certificate_number' => $request->input('wedding_certificate_number'),
                    ]
                );
            }
        });

        return redirect()->route('employees.index')->with('success', 'Data karyawan dan keluarga berhasil diperbarui.');
    }

    // Archive an Employee
    public function archive($id)
    {
        DB::transaction(function () use ($id) {
            $employee = Employee::findOrFail($id);
            $employee->update(['archived' => true]);

            // Archive associated family data
            $employee->familyData()->update(['archived' => true]);
        });

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diarsipkan.');
    }

    // Restore Archived Employee
    public function restore($id)
    {
        DB::transaction(function () use ($id) {
            $employee = Employee::findOrFail($id);
            $employee->update(['archived' => false]);

            // Restore associated family data
            $employee->familyData()->update(['archived' => false]);
        });

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil dipulihkan.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            // Delete associated family data
            FamilyData::where('employee_id', $id)->delete();

            // Delete the employee record
            Employee::findOrFail($id)->delete();
        });

        return redirect()->route('employees.archived')->with('success', 'Data karyawan dan keluarga berhasil dihapus.');
    }
}
