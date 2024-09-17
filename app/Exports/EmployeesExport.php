<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Get all employees with their family data
        return Employee::with('familyData')->get();
    }

    public function map($employee): array
    {
        // Extract family data, handle multiple familyData entries
        $familyData = $employee->familyData;

        // Prepare a default values array
        $familyDataValues = [
            'mate_name' => '',
            'child_name' => '',
            'wedding_date' => '',
            'wedding_certificate_number' => '',
        ];

        // If there are family data records, update the values
        if ($familyData->count() > 0) {
            $firstFamilyData = $familyData->first(); // Get the first familyData record, or modify as needed
            $familyDataValues = [
                'mate_name' => $firstFamilyData->mate_name,
                'child_name' => $firstFamilyData->child_name,
                'wedding_date' => $firstFamilyData->wedding_date,
                'wedding_certificate_number' => $firstFamilyData->wedding_certificate_number,
            ];
        }

        return [
            $employee->id_number,
            $employee->email,
            $employee->full_name,
            $employee->nickname,
            $employee->contract_date,
            $employee->work_date,
            $employee->status,
            $employee->position,
            $employee->gender,
            $employee->place_birth,
            $employee->birth_date,
            $employee->religion,
            $employee->hobby,
            $employee->marital_status,
            $employee->residence_address,
            $employee->phone,
            $employee->address_emergency,
            $employee->phone_emergency,
            $employee->blood_type,
            $employee->last_education,
            $employee->agency,
            $employee->graduation_year,
            $employee->competency_training_place,
            $employee->organizational_experience,
            $employee->archived,
            $familyDataValues['mate_name'],
            $familyDataValues['child_name'],
            $familyDataValues['wedding_date'],
            $familyDataValues['wedding_certificate_number'],
        ];
    }

    public function headings(): array
    {
        return [
            'ID Number',
            'Email',
            'Full Name',
            'Nickname',
            'Contract Date',
            'Work Date',
            'Status',
            'Position',
            'Gender',
            'Place of Birth',
            'Birth Date',
            'Religion',
            'Hobby',
            'Marital Status',
            'Residence Address',
            'Phone',
            'Emergency Address',
            'Emergency Phone',
            'Blood Type',
            'Last Education',
            'Agency',
            'Graduation Year',
            'Competency Training Place',
            'Organizational Experience',
            'Archived',
            'Mate Name',
            'Child Name',
            'Wedding Date',
            'Wedding Certificate Number',
        ];
    }
}
