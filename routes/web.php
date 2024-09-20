<?php

use Illuminate\Support\Facades\Route;
use App\http\Middleware\IsAdmin;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\AuthController;

// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk user yang sudah login
Route::middleware(['auth'])->group(function () {

    // Rute khusus untuk admin
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('admin/dashboard', function () {
            return view('auth.dashboard', ['role' => 'admin']);
        })->name('admin.dashboard');

        Route::get('/admin/profile', [AuthController::class, 'userProfile'])->name('admin.profile');
    });

    // Rute untuk user biasa
    Route::get('/user/dashboard', function () {
        return view('auth.dashboard', ['role' => 'user']);
    })->name('user.dashboard');

    Route::get('/user/profile', [AuthController::class, 'userProfile'])->name('user.profile');
});


    Route::get('/user/absensi', [AuthController::class, 'userAttendances'])->name('user.attendances');
    Route::get('/user/pelanggaran', [AuthController::class, 'userRecords'])->name('user.records');
    Route::get('/user/profile', [AuthController::class, 'userProfile'])->name('user.profile');
    Route::post('/profile/request-edit', [AuthController::class, 'requestEdit'])->name('profile.requestEdit');

// Employee Routes
Route::get('employees/export', [EmployeeController::class, 'export'])->name('employees.export');
Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
Route::post('employees/{employee}/archive', [EmployeeController::class, 'archive'])->name('employees.archive');
Route::get('employees/archived', [EmployeeController::class, 'archived'])->name('employees.archived');
Route::patch('employees/{employee}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');
Route::delete('employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
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
