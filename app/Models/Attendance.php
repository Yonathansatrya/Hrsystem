<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'attendances';

    // The attributes that are mass assignable.
    protected $fillable = [
        'pin',
        'nip',
        'nama',
        'jabatan',
        'departemen',
        'kantor',
        'izin_libur',
        'jumlah_kehadiran',
        'jam_kehadiran',
        'jumlah_datang_terlambat',
        'jam_datang_terlambat',
        'jumlah_pulang_awal',
        'jam_pulang_awal',
        'jumlah_istirahat_lebih',
        'jam_istirahat_lebih',
        'masuk',
        'keluar',
        'jam',
        'menit',
        'scan_1x',
        'tanpa_izin',
        'rutin_umum',
    ];
}
    