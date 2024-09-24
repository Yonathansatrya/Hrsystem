<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationsController;

// Rute untuk login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk user yang sudah login
Route::middleware(['auth'])->group(function () {

    // Rute khusus untuk admin
    Route::middleware([IsAdmin::class])->group(function () {
        Route::get('admin/dashboard', function () {
            return view('auth.sidebar', ['role' => 'admin']);
        })->name('admin.dashboard');

        Route::get('/admin/profile', [AuthController::class, 'userProfile'])->name('admin.profile');
    });

    // Rute untuk user biasa
    Route::get('/user/dashboard', function () {
        return view('auth.sidebar', ['role' => 'user']);
    })->name('user.dashboard');

    Route::get('/user/profile', [AuthController::class, 'userProfile'])->name('user.profile');
    Route::get('/user/absensi', [AuthController::class, 'userAttendances'])->name('user.attendances');
    Route::get('/user/pelanggaran', [AuthController::class, 'userRecords'])->name('user.records');
    Route::post('/profile/request-edit', [AuthController::class, 'requestEdit'])->name('profile.requestEdit');
});

// Employee Routes
Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index'); // List all employees
    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create'); // Show create employee form
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store'); // Store new employee
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show'); // Show single employee
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit'); // Show edit form
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employees.update'); // Update employee
    Route::post('/{employee}/archive', [EmployeeController::class, 'archive'])->name('employees.archive'); // Archive employee
    Route::patch('/{employee}/restore', [EmployeeController::class, 'restore'])->name('employees.restore'); // Restore archived employee
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy'); // Delete employee
    Route::get('/employees/archived', [EmployeeController::class, 'archived'])->name('employees.archived'); // List archived employees

    // Import/Export Employee Data
    Route::get('/export', [EmployeeController::class, 'export'])->name('employees.export'); // Export employee data
    Route::post('/import', [EmployeeController::class, 'import'])->name('employees.import'); // Import employee data
});

// Attendance Routes
Route::prefix('attendances')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/import', [AttendanceController::class, 'showImportView'])->name('attendances.import.view');
    Route::post('/import', [AttendanceController::class, 'import'])->name('attendances.import');
});

// Employee Record Routes
Route::prefix('employee-records')->group(function () {
    Route::get('/', [PelanggaranController::class, 'index'])->name('employee_records.index');
    Route::get('/create', [PelanggaranController::class, 'create'])->name('employee_records.create');
    Route::post('/', [PelanggaranController::class, 'store'])->name('employee_records.store');
    Route::get('/{employeeRecord}/edit', [PelanggaranController::class, 'edit'])->name('employee_records.edit');
    Route::put('/{employeeRecord}', [PelanggaranController::class, 'update'])->name('employee_records.update');
    Route::delete('/{employeeRecord}', [PelanggaranController::class, 'destroy'])->name('employee_records.destroy');
    Route::post('/comment/{employeeRecord}', [PelanggaranController::class, 'comment'])->name('employee_records.comment');
});

// Notifications Routes
Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
Route::post('/notifications/read/{notificationId}', [NotificationsController::class, 'markAsRead'])->name('notifications.read');
