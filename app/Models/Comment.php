<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeeRecord;
use App\Models\User;

class Comment extends Model
{
    protected $fillable = [
        'employee_record_id',
        'user_id',
        'comment',
    ];

    // Relationship to EmployeeRecord
    public function employeeRecord()
    {
        return $this->belongsTo(EmployeeRecord::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
