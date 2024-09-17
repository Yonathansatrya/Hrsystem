<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
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
    ];

    public function familyData()
    {
        return $this->hasMany(FamilyData::class, 'employee_id');
    }


    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function employeeRecords()
    {
        return $this->hasMany(EmployeeRecord::class, 'id_number', 'id_number');
    }

    // Di dalam model Employee
    protected $casts = [
        'work_date' => 'datetime',
        'birth_date' => 'datetime',
        'contract_date' => 'datetime',
        'wedding_date' => 'datetime',
    ];
}
