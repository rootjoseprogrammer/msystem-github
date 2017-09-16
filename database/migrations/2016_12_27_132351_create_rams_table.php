<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE MOMORIA RAM
        Schema::create('rams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned();
            $table->string('type');
            $table->string('speed');
            $table->string('capacity');
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
        Schema::dropIfExists('rams');
    }
}
