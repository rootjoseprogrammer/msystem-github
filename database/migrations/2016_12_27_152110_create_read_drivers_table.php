<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE UNIDADES DE LECTURA
        Schema::create('read_drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->enum('type', ['cd-r','cd-rw','dvd-r','dvd-rw']);
            $table->string('speed');
            $table->boolean('registered');
            $table->timestamps();
            $table->softDeletes();

            /*$table->foreign('equipment_id')->references('id')->on('equipments');
            $table->foreign('brand_id')->references('id')->on('brands');*/

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
        Schema::dropIfExists('read_drivers');
    }
}
