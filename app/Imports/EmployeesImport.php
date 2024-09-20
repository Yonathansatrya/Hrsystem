<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\FamilyData;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
    public function model(array $row)
    {
        // Debug: Periksa data yang diterima


        // Pastikan kolom yang dibutuhkan tidak kosong (full_name, id_number, email)
        if (empty($row[1]) || empty($row[2]) || empty($row[18])) {
            Log::info('Baris dilewati karena data kosong: ', ['data' => $row]); // Log jika baris dilewati
            dd('Baris dilewati karena data kosong');
            return null;
        }

        // Cek dan konversi format tanggal lahir jika ada
        $birthDate = null;
        if (!empty($row[15])) {
            $birthDate = \DateTime::createFromFormat('d/m/Y', $row[15]);
            if ($birthDate) {
                $birthDate = $birthDate->format('Y-m-d');
            } else {
                Log::error('Format tanggal lahir salah pada baris: ', ['data' => $row]);
                dd('Format tanggal lahir salah');
                return null; // Jangan lanjutkan jika format tanggal salah
            }
        }

        // Simpan data employee
        try {
            $employee = Employee::create([
                'full_name' => $row[1], // Nama Lengkap
                'id_number' => $row[2], // NIK Karyawan
                'nickname' => $row[3],  // Nama Panggilan
                'gender' => $row[4],    // L/P (Gender)
                'position' => $row[13], // Jabatan
                'birth_date' => $birthDate, // Tanggal Lahir
                'religion' => $row[17], // Agama
                'email' => $row[18],    // Email
                'hobby' => $row[19],    // Hobby
                'marital_status' => $row[20], // Status Perkawinan
                'residence_address' => $row[23], // Alamat Lengkap KTP
                'phone' => $row[24], // No. Telephone/ Hp
                'address_emergency' => $row[25], // Alamat yang Mudah Dihubungi bila Terjadi Kecelakaan
                'phone_emergency' => $row[26] ?? null, // Nomor darurat
                'blood_type' => $row[27] ?? null, // Golongan Darah
                'last_education' => $row[28], // Pendidikan Terakhir
                'agency' => $row[29], // Instansi / Lembaga
                'graduation_year' => $row[30], // Tahun Lulus
                'competency_training_place' => $row[31], // Pelatihan Kompetensi
                'organizational_experience' => $row[32], // Pengalaman Berorganisasi
                'status' => 'aktif', // Status default
                'archived' => false,  // Default tidak diarsipkan
                'is_admin' => false,  // Default user biasa
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan employee: ' . $e->getMessage());
            dd('Gagal menyimpan employee: ' . $e->getMessage());
            return null;
        }

        // Jika data keluarga tersedia, simpan ke tabel FamilyData
        if (!empty($row[33]) || !empty($row[34])) {
            // Cek dan konversi format tanggal pernikahan jika ada
            $weddingDate = null;
            if (!empty($row[21])) {
                $weddingDate = \DateTime::createFromFormat('d/m/Y', $row[21]);
                if ($weddingDate) {
                    $weddingDate = $weddingDate->format('Y-m-d');
                } else {
                    Log::error('Format tanggal pernikahan salah pada baris: ', ['data' => $row]);
                    dd('Format tanggal pernikahan salah');
                    return null; // Jangan lanjutkan jika format tanggal salah
                }
            }

            // Simpan data family
            try {
                $familyData = FamilyData::create([
                    'employee_id' => $employee->id,
                    'mate_name' => $row[33], // Nama Istri/Suami
                    'child_name' => $row[34], // Nama Anak
                    'wedding_date' => $weddingDate, // Tanggal Pernikahan
                    'wedding_certificate_number' => $row[22], // Nomor Surat Nikah
                ]);
            } catch (\Exception $e) {
                Log::error('Gagal menyimpan data keluarga: ' . $e->getMessage());
                dd('Gagal menyimpan data keluarga: ' . $e->getMessage());
                return null;
            }

            // Debug: Lihat data family yang telah dibuat
            dd($familyData);
        }

        Log::info('Data karyawan berhasil disimpan: ', ['employee_id' => $employee->id]);

        return $employee;
    }
}
