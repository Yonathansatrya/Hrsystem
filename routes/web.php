<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\AuthController;

// Route untuk halaman admin dengan middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Route login dan logout
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Employee Routes
Route::get('employees/export', [EmployeeController::class, 'export'])->name('employees.export');
Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
Route::post('employees/{employee}/archive', [EmployeeController::class, 'archive'])->name('employees.archive');
Route::get('employees/archived', [EmployeeController::class, 'archived'])->name('employees.archived');
Route::patch('employees/{employee}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');
Route::delete('employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::resource('employees', EmployeeController::class);

// Attendance Routes
Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances.index');
Route::get('attendances/import', [AttendanceController::class, 'showImportView'])->name('attendances.import.view');
Route::post('attendances/import', [AttendanceController::class, 'import'])->name('attendances.import');

// Employee Record Routes
Route::get('employee-records', [PelanggaranController::class, 'index'])->name('employee_records.index');
Route::get('employee-records/create', [PelanggaranController::class, 'create'])->name('employee_records.create');
Route::post('employee-records', [PelanggaranController::class, 'store'])->name('employee_records.store');
Route::post('employee-records/comment/{employeeRecord}', [PelanggaranController::class, 'followUp'])->name('employee_records.comment');
Route::get('employee-records/{employeeRecord}/edit', [PelanggaranController::class, 'edit'])->name('employee_records.edit');
Route::put('employee-records/{employeeRecord}', [PelanggaranController::class, 'update'])->name('employee_records.update');
Route::delete('employee-records/{employeeRecord}', [PelanggaranController::class, 'destroy'])->name('employee_records.destroy');
