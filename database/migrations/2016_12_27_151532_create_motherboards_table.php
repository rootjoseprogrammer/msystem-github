<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotherboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE TARJETAS MADRES
        Schema::create('motherboards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->string('slot');
            $table->string('usb');
            $table->string('type_source');
            $table->string('serial');
            $table->boolean('registered');
            $table->timestamps();
            $table->softDeletes();

           /* $table->foreign('equipment_id')->references('id')->on('equipments');
            $table->foreign('brand_id')->references('id')->on('brands');
            */

            $table->foreign('brand_id')
                    ->references('id')->on('brands')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motherboards');
    }
}
