<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunidadPoaParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunidadPoaParticipante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            $table->unsignedBigInteger('poaParticipante_id');
            $table->foreign('poaParticipante_id')->references('id')->on('poaParticipante');

            $table->unsignedBigInteger('comunidad_id');
            $table->foreign('comunidad_id')->references('id')->on('comunidad');
            
            $table->unsignedBigInteger('coordinador_id')->nullable();
            $table->foreign('coordinador_id')->references('id')->on('users');

            $table->unsignedBigInteger('gestor_id')->nullable();
            $table->foreign('gestor_id')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunidadPoaParticipante');
    }
}
