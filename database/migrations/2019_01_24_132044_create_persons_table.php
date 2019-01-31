<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('employee_number')->nullable();
            $table->string('aka')->nullable();
            $table->string('initial')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('cell_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('id_number')->nullable();
            $table->string('res_address')->nullable();
            $table->bigInteger('date_of_birth')->nullable();
            $table->bigInteger('drivers_licence_exp_date')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('city')->nullable();
            $table->string('res_postal_code')->nullable();
            $table->smallInteger('status')->nullable();
            $table->smallInteger('isAdmin')->nullable(); // 0 for admin && 1 for normal user
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
        Schema::dropIfExists('persons');
    }
}
