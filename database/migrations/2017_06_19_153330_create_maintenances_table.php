<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE MANTENIMIENTO
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipment_id')->unsigned();
            $table->longText('problem');
            $table->longText('solution');
            $table->timestamps();
            $table->softDeletes();

            /*$table->foreign('equipment_id')->references('id')->on('equipments');
            */

            $table->foreign('equipment_id')
                    ->references('id')->on('equipments')
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
        Schema::dropIfExists('maintenances');
    }
}
