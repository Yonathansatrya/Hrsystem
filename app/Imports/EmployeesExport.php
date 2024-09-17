<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection
{
    public function collection()
    {
        return Employee::all();
    }
}
