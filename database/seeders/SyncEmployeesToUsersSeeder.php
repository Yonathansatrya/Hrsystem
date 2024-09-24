<?php

namespace Database\Seeders; // Pastikan ini benar

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class SyncEmployeesToUsersSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            User::updateOrCreate(
                ['email' => $employee->email], // Kondisi update
                [
                    'name' => $employee->full_name, // Nama pengguna dari employee
                    'id_number' => $employee->id_number, // ID Karyawan
                    'password' => bcrypt($employee->password), // Set password dari employees
                ]
            );
        }
    }
}
