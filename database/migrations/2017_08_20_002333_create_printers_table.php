<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printers', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('brand_id')->unsigned();
          $table->string('serial');
          $table->string('model');
          $table->string('state_number');
          $table->string('estafamos');
          $table->string('type');
          $table->timestamps();
          $table->softDeletes();

          $table->foreign('brand_id')
          ->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printers');
    }
}
