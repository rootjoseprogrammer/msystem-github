<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicroprecessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('microprocessors', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('brand', ['intel', 'amd']);
            $table->string('model');
            $table->string('speed');
            $table->string('socket');
            $table->boolean('registered');
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('equipment_id')->references('id')->on('equipments');
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
        Schema::dropIfExists('microprocessors');
    }
}
