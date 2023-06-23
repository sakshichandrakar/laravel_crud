<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_detail', function (Blueprint $table) {
            $table->id();
            $table->string('emp_name');
            $table->string('emp_email')->unique();
            $table->string('emp_mob');
            $table->enum('emp_gender', ['Male', 'Female']);
            $table->string('emp_profile');
            $table->string('emp_basic_pay');
            $table->integer('emp_role_type');
            $table->string('emp_role');
            $table->string('emp_role');
            $table->string('emp_address');
            $table->integer('is_deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
