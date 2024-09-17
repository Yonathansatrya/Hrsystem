<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyData extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'mate_name',
        'child_name',
        'wedding_date',
        'wedding_certificate_number'
    ];

    protected $casts = [
        'wedding_date' => 'date',
    ];

    // Model FamilyData
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
