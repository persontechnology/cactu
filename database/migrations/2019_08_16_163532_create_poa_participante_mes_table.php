<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoaParticipanteMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poaParticipanteMes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->integer('valor')->default(0);
            $table->unsignedBigInteger('poaParticipante_id');
            $table->foreign('poaParticipante_id')->references('id')->on('poaParticipante');
            $table->unsignedBigInteger('mes_id');
            $table->foreign('mes_id')->references('id')->on('mes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poaParticipanteMes');
    }
}
