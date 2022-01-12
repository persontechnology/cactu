<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoaParticipanteTipoParticipanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poaParticipanteTipoParticipante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('poaParticipante_id');
            $table->foreign('poaParticipante_id')->references('id')->on('poaParticipante');

            $table->unsignedBigInteger('tipoParticipante_id');
            $table->foreign('tipoParticipante_id')->references('id')->on('tipoParticipante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poaParticipanteTipoParticipante');
    }
}
