<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->unique();
            $table->string('email')->unique();
            $table->string('full_name');
            $table->string('nickname');
            $table->date('contract_date')->nullable();
            $table->date('work_date');
            $table->string('status');
            $table->string('position');
            $table->string('gender');
            $table->string('place_birth');
            $table->date('birth_date');
            $table->string('religion');
            $table->string('hobby')->nullable();
            $table->string('marital_status');
            $table->text('residence_address');
            $table->string('phone');
            $table->text('address_emergency');
            $table->string('phone_emergency');
            $table->string('blood_type')->nullable();
            $table->string('last_education')->nullable();
            $table->string('agency')->nullable();
            $table->year('graduation_year')->nullable();
            $table->string('competency_training_place')->nullable();
            $table->text('organizational_experience')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
