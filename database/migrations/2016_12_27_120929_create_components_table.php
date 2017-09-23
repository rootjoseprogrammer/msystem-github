<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->string('serial')->nullable();
            $table->string('model')->nullable();
            $table->string('state_number')->nullable();
            $table->string('estafamos')->nullable();
            $table->string('type')->nullable();
            $table->string('component_type')->nullable();
            $table->boolean('registered')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brand_id')
            ->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
