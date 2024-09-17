<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = \App\Models\Attendance::class;

    public function definition()
    {
        return [
            'pin' => $this->faker->numerify('####'),
            'nip' => $this->faker->numerify('####'),
            'nama' => $this->faker->name(),
            'jabatan' => $this->faker->word(),
            'departemen' => $this->faker->word(),
            'kantor' => $this->faker->word(),
            'izin_libur' => $this->faker->word(),
            'jumlah_kehadiran' => $this->faker->numberBetween(1, 10),
            'jam_kehadiran' => $this->faker->time('H:i'),
            'jumlah_datang_terlambat' => $this->faker->numberBetween(0, 5),
            'jam_datang_terlambat' => $this->faker->time('H:i'),
            'jumlah_pulang_awal' => $this->faker->numberBetween(0, 5),
            'jam_pulang_awal' => $this->faker->time('H:i'),
            'jumlah_istirahat_lebih' => $this->faker->numberBetween(0, 5),
            'jam_istirahat_lebih' => $this->faker->time('H:i'),
            'masuk' => $this->faker->time('H:i'),
            'keluar' => $this->faker->time('H:i'),
            'jam' => $this->faker->numberBetween(0, 10),
            'menit' => $this->faker->numberBetween(0, 59),
            'scan_1x' => $this->faker->boolean(),
            'tanpa_izin' => $this->faker->boolean(),
            'rutin_umum' => $this->faker->boolean(),
        ];
    }
}
