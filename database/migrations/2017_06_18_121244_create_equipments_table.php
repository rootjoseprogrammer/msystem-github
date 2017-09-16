<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE EQUIPOS
        Schema::create('equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('displays_id')->unsigned()->nullable();
            $table->integer('hard_driver_id')->unsigned()->nullable();
            $table->integer('ram_id')->unsigned()->nullable();
            $table->integer('video_id')->unsigned()->nullable();
            $table->integer('motherboard_id')->unsigned()->nullable();
            $table->integer('read_driver_id')->unsigned()->nullable();
            $table->integer('net_card_id')->unsigned()->nullable();
            $table->integer('microprocessor_id')->unsigned()->nullable();
            $table->string('type');
            $table->string('serial')->unique();
            $table->string('IP')->unique();
            $table->boolean('inventory');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('brand_id')->references('id')->on('brands');

            $table->foreign('department_id')->references('id')->on('departments');

            //PIEZAS QUE LE PERTENECEN AL COMPUTADOR
            $table->foreign('microprocessor_id')->references('id')->on('microprocessors');
            $table->foreign('displays_id')->references('id')->on('displays');
            $table->foreign('ram_id')->references('id')->on('rams');
            $table->foreign('video_id')->references('id')->on('videos');
            $table->foreign('motherboard_id')->references('id')->on('motherboards');
            $table->foreign('read_driver_id')->references('id')->on('read_drivers');
            $table->foreign('net_card_id')->references('id')->on('net_cards');

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
        Schema::dropIfExists('equipments');
    }
}
