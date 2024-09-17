<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchivedFieldsToEmployeesAndFamilyDataTables extends Migration
{
    public function up()
    {
        // Adding 'archived' column to the employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->boolean('archived')->default(false)->after('organizational_experience');
        });

        // Adding 'archived' column to the family_data table
        Schema::table('family_data', function (Blueprint $table) {
            $table->boolean('archived')->default(false)->after('wedding_certificate_number');
        });
    }

    public function down()
    {
        // Dropping the 'archived' column from the employees table
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('archived');
        });

        // Dropping the 'archived' column from the family_data table
        Schema::table('family_data', function (Blueprint $table) {
            $table->dropColumn('archived');
        });
    }
}
