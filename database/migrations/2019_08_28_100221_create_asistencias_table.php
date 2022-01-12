<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->enum('estado',['Creado','Finalizado']);
            $table->date('fecha');
            $table->string('detalle',255)->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('comunidadPoaParticipante_id');
            $table->foreign('comunidadPoaParticipante_id')->references('id')->on('comunidadPoaParticipante')->onDelete('cascade');

            $table->bigInteger('creadoPor')->nullable();
            $table->bigInteger('actualizadoPor')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
