<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DE SOLICITUDES DE MANTENIMIENTO
         Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('technical_user_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned();
            $table->string('subject');
            $table->longText('message');
            $table->string('IP');
            $table->string('department_user');
            $table->enum('message_read', ['no', 'si']);
            $table->enum('status', ['Pendiente', 'En Ejecucion', 'Finalizado']);
            $table->longText('answer')->nullable();
            $table->date('completed_work')->nullable();
            $table->longText('according')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('user_id')->references('id')->on('users');

            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('department_id')
            ->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('technical_user_id')
            ->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('applications');
    }
}
