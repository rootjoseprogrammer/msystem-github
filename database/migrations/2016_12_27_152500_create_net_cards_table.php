<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE TARJETAS DE RED
        Schema::create('net_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->enum('type', ['interna', 'externa']);
            $table->string('speed');
            $table->string('type_slot');
            $table->boolean('registered');
            $table->timestamps();
            $table->softDeletes();

            /*$table->foreign('equipment_id')->references('id')->on('equipments');*/

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
        Schema::dropIfExists('net_cards');
    }
}
