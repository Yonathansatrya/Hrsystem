<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendancesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validasi jika kolom yang penting kosong, skip row ini
        if (empty($row['pin']) || empty($row['nama'])) {
            return null;
        }

        return new Attendance([
            'pin' => $row['pin'],
            'nip' => $row['nip'],  // Nullable
            'nama' => $row['nama'],
            'jabatan' => $row['jabatan'],  // Nullable
            'departemen' => $row['departemen'],  // Nullable
            'kantor' => $row['kantor'],  // Nullable
            'izin_libur' => $row['izin_libur'] ?? 0,  // Default to 0 if empty
            'jumlah_kehadiran' => $row['jml'] ?? 0,  // Default to 0 if empty
            'jam_kehadiran' => $row['jam_menit'] ?? '00:00',  // Default time if empty
            'jumlah_datang_terlambat' => $row['jml'] ?? 0,
            'jam_datang_terlambat' => $row['jam_menit'] ?? '00:00',
            'jumlah_pulang_awal' => $row['jml'] ?? 0,
            'jam_pulang_awal' => $row['jam_menit'] ?? '00:00',
            'jumlah_istirahat_lebih' => $row['jml'] ?? 0,
            'jam_istirahat_lebih' => $row['jam_menit'] ?? '00:00',
            'masuk' => $row['masuk'] ?? null,  // Nullable
            'keluar' => $row['keluar'] ?? null,  // Nullable
            'jam' => $row['jam'] ?? 0,  // Default to 0 if empty
            'menit' => $row['menit'] ?? 0,  // Default to 0 if empty
            'scan_1x' => $row['scan_1_x'] ?? false,  // Boolean default to false
            'tanpa_izin' => $row['tanpa_izin'] ?? false,  // Boolean default to false
            'rutin_umum' => $row['rutin_umum'] ?? false,  // Boolean default to false
        ]);
    }
}
