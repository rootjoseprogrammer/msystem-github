<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE MEMORIA DE VIDEO
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['externa', 'integrada']);
            $table->string('memory');
            $table->string('groove');
            $table->boolean('registered');
            $table->timestamps();
            $table->softDeletes();

            /*$table->foreign('equipment_id')->references('id')->on('equipments');*/
            // 
            // $table->foreign('equipment_id')
            //         ->references('id')->on('equipments')
            //         ->onDelete('cascade')
            //         ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
