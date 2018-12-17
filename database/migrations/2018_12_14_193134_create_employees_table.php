<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('email')->unique();
            $table->unsignedInteger('supervisor_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birth_date');
            $table->date('join_date');
            $table->unsignedInteger('location_id');
            $table->string('position');
            $table->unsignedInteger('department_id');
            $table->integer('mobile');
            $table->string('position');
            $table->unsignedTinyint('user_type')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
