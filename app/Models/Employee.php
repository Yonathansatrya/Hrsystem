<?php

namespace App\Models;
    
use Illuminate\Foundation\Auth\User as Authenticatable; // Gunakan Authenticatable untuk otentikasi
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    // Daftar kolom yang bisa diisi secara massal
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
        'archived',
        'is_admin'
    ];

    // Relasi ke tabel family_data
    public function familyData()
    {
        return $this->hasMany(FamilyData::class, 'employee_id');
    }

    // Relasi ke tabel attendances, menggunakan 'pin' jika tidak ada 'employee_id'
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'pin', 'pin'); // Sesuaikan relasi menggunakan 'pin'
    }

    // Relasi ke tabel employee_records dengan kunci 'id_number'
    public function employeeRecords()
    {
        return $this->hasMany(EmployeeRecord::class, 'id_number', 'id_number');
    }

    // Cek apakah user adalah admin
    public function isAdmin()
    {
        return $this->is_admin;
    }

    // Cek apakah user adalah user biasa
    public function isUser()
    {
        return !$this->is_admin;
    }

    // Konversi kolom tanggal
    protected $casts = [
        'work_date' => 'datetime',
        'birth_date' => 'datetime',
        'contract_date' => 'datetime',
        'wedding_date' => 'datetime',
        'is_admin' => 'boolean',

    ];
}
