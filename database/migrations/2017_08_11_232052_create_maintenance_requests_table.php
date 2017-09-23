<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('service');
            $table->string('environment');
            $table->string('floor');
            $table->longText('description');
            $table->string('type_request');
            $table->string('masonry')->nullable();
            $table->string('carpentry')->nullable();
            $table->string('electricity')->nullable();
            $table->string('mechanics')->nullable();
            $table->string('painting')->nullable();
            $table->string('plumbing')->nullable();
            $table->string('refrigeration')->nullable();
            $table->string('deposit')->nullable();
            $table->string('supervisor')->nullable();
            $table->date('date')->nullable();
            $table->longText('materials_description')->nullable();
            $table->integer('quantity')->nullable();
            $table->longText('observations')->nullable();
            $table->string('according')->nullable();
            $table->boolean('complete');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('department_id')
            ->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_requests');
    }
}
