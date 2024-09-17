<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
    public function model(array $row)
    {
        return new Employee([
            'id_number' => $row[0],
            'full_name' => $row[1],
            'nickname' => $row[2],
            'position' => $row[3],
            'status' => $row[4],
            'gender' => $row[5],
            'place_birth' => $row[6],
            'birth_date' => $row[7],
            'religion' => $row[8],
            'email' => $row[9],
            'hobby' => $row[10],
            'marital_status' => $row[11],
            'residence_address' => $row[12],
            'phone' => $row[13],
            'address_emergency' => $row[14],
            'phone_emergency' => $row[15],
            'blood_type' => $row[16],
            'last_education' => $row[17],
            'agency' => $row[18],
            'graduation_year' => $row[19],
            'competency_training_place' => $row[20],
            'organizational_experience' => $row[21],
            'contract_date' => $row[22],
            'mate_name' => $row[23],
            'child_name' => $row[24],
            'wedding_date' => $row[25],
            'wedding_certificate_number' => $row[26],
        ]);
    }
}
