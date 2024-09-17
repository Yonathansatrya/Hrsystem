<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatefamilydataTable extends Migration
{
    public function up()
    {
        Schema::create('family_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('mate_name')->nullable();
            $table->string('child_name')->nullable();
            $table->date('wedding_date')->nullable();
            $table->string('wedding_certificate_number')->nullable();
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_data');
    }
}
