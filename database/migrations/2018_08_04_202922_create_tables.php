<?php

//van en plural, en minúscula y con guion bajo!!!

/*

------------------------
Los tinyInt como por ejemplo:
            $table->tinyInteger('neighborhood_id')->unsigned();
los toma como tinyint(3) en MySQL pero está ok según StackOverflow: https://stackoverflow.com/questions/13120904/mysql-tinyint1-vs-tinyint2-vs-tinyint3-vs-tinyint4
------------------------
Los FK no estoy segura de si pueden ir como NULLABLES...


*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 200);
            $table->tinyInteger('capacity')->unsigned()->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('mail', 100);
            $table->decimal('price', 10,2);
            //nullable?
            $table->smallInteger('address_id')->unsigned()->nullable();
            //nullable?
            $table->smallInteger('product_type_id')->unsigned()->nullable();
            $table->tinyInteger('company_id')->unsigned();
            $table->string('type', 10);
            $table->string('cover', 250);
            $table->string('active', 45)->default(1);
            $table->string('price_type', 20)->nullable()->default('por hora');
            $table->decimal('minimum_reservation', 10,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('neighborhoods', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            //name no es nullable porque no le veo el sentido....
            $table->string('name', 100);
            //localidad_id no es nullable porque es un FK!
            $table->tinyInteger('town_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('purchases', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name', 100);
            $table->decimal('total_amount', 10,2);
            $table->decimal('remainder', 10,2);
            //puse 'booking' por la traducción de 'reserva' pero no estoy segura de que sea eso
            $table->decimal('booking', 10,2);
            //nullable?
            $table->smallInteger('payment_method_id')->unsigned()->nullable();
            $table->string('state', 45);
            $table->string('purchase_date', 45)->nullable();
            $table->date('event_date');
            $table->smallInteger('address_id')->unsigned();
            //nullable?
            $table->smallInteger('user_id')->unsigned()->nullable();
            $table->string('active', 45);
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('addresses', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('street', 100);
            $table->string('number', 10)->nullable();
            $table->string('apartment', 5)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->tinyInteger('town_id')->unsigned();
            $table->tinyInteger('neighborhood_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name', 45);
            //'cbu' y 'cuit' no lo traduje al ingles porque no estaba segura!
            $table->string('cbu', 45)->nullable();
            $table->string('cuit', 45)->nullable();
            $table->string('cbu_alias', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('unavailable_dates', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->smallInteger('product_id')->unsigned();
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('towns', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name', 45);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payment_methods', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name', 45);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_purchases', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('description', 100);
            $table->smallInteger('product_id')->unsigned();
            $table->decimal('price', 10,2)->nullable();
            //purchase_id le deje NOT NULL porque es FK
            $table->smallInteger('purchase_id')->unsigned();
            $table->tinyInteger('active')->unsigned()->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('address_product', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            //product_id le deje NOT NULL porque es FK
            $table->smallInteger('product_id')->unsigned();
            //purchase_id le deje NOT NULL porque es FK
            $table->smallInteger('purchase_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_photos', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            //product_id le deje NOT NULL porque es FK
            $table->smallInteger('product_id')->unsigned();
            //'path' le saqué el nullable porque no tiene sentido cargar en esta tabla un producto sin foto
            $table->string('path', 250);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_type_product', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            //product_id le deje NOT NULL porque es FK
            $table->smallInteger('product_id')->unsigned();
            //event_type_id le deje NOT NULL porque es FK
            $table->smallInteger('event_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('event_types', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name', 45);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_user', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            //product_id le deje NOT NULL porque es FK
            $table->smallInteger('product_id')->unsigned();
            //user_id le deje NOT NULL porque es FK
            $table->smallInteger('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_types', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('name', 45);
            $table->string('product_type', 45);
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('neighborhoods');
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('unavailable_dates');
        Schema::dropIfExists('towns');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('product_purchase');
        Schema::dropIfExists('address_product');
        Schema::dropIfExists('product_photos');
        Schema::dropIfExists('event_type_product');
        Schema::dropIfExists('event_types');
        Schema::dropIfExists('product_user');
        Schema::dropIfExists('product_types');

    }
}
