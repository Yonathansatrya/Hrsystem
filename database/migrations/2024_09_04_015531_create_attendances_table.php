<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('pin');
            $table->string('nip')->nullable();  // Nullable
            $table->string('nama');
            $table->string('jabatan')->nullable();  // Nullable
            $table->string('departemen')->nullable();  // Nullable
            $table->string('kantor')->nullable();  // Nullable
            $table->string('izin_libur')->nullable();  // Nullable
            $table->integer('jumlah_kehadiran')->default(0);  // Default 0
            $table->string('jam_kehadiran')->nullable();  // Nullable
            $table->integer('jumlah_datang_terlambat')->default(0);  // Default 0
            $table->string('jam_datang_terlambat')->nullable();  // Nullable
            $table->integer('jumlah_pulang_awal')->default(0);  // Default 0
            $table->string('jam_pulang_awal')->nullable();  // Nullable
            $table->integer('jumlah_istirahat_lebih')->default(0);  // Default 0
            $table->string('jam_istirahat_lebih')->nullable();  // Nullable
            $table->time('masuk')->nullable();  // Nullable
            $table->time('keluar')->nullable();  // Nullable
            $table->integer('jam')->default(0);  // Default 0
            $table->integer('menit')->default(0);  // Default 0
            $table->boolean('scan_1x')->default(false);  // Default to false
            $table->boolean('tanpa_izin')->default(false);  // Default to false
            $table->boolean('rutin_umum')->default(false);  // Default to false
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
