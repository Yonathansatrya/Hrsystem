<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Cell\Comment;

class EmployeeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'offense_type',
        'offense_date',
        'description',
    ];

    protected $casts = [
        'offense_date' => 'date', // Mengubah `offense_date` menjadi objek `Carbon`
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_number', 'id_number');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
    