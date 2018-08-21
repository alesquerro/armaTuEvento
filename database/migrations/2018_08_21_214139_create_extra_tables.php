<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('date_products', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->smallInteger('product_id')->unsigned();
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
         Schema::create('product_product_type', function (Blueprint $table){
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->smallInteger('product_id')->unsigned();
            $table->smallInteger('product_type_id')->unsigned();
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
        Schema::dropIfExists('date_products');
        Schema::dropIfExists('product_product_type');
    }
}
