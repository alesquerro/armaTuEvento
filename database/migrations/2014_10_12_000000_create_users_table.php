<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            // $table->increments('id');
            $table->string('first_name', 45);
            $table->string('last_name', 45)->nullable();
            $table->string('email', 45)->unique();
            //'password' le quité nullable
            $table->string('password', 100);
            //nullable?
            $table->smallInteger('address_id')->unsigned()->nullable();
            //string?? no es mejor date?
            $table->string('terms_conditions_date', 45)->nullable();
            //nullable?
            $table->tinyInteger('company_id')->unsigned()->nullable();
            $table->tinyInteger('active', 45)->unsigned()->nullable();
            $table->string('avatar', 250)->nullable();
            $table->smallInteger('respuesta1')->unsigned()->nullable();
            $table->smallInteger('respuesta2')->unsigned()->nullable();
            $table->tinyInteger('admin')->unsigned()->nullable();
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
        Schema::dropIfExists('users');
    }
}
