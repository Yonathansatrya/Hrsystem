<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('employee_records', function (Blueprint $table) {
            $table->id();
            $table->string('id_number');
            $table->string('offense_type');
            $table->date('offense_date');
            $table->text('description')->nullable();
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('id_number')
                  ->references('id_number')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('employee_records', function (Blueprint $table) {
            $table->dropForeign(['id_number']);
        });

        Schema::dropIfExists('employee_records');
    }
}
