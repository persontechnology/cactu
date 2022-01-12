<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoaActividadMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poaActividadMes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            $table->integer('valor')->default(0);
            $table->unsignedBigInteger('poaActividad_id');
            $table->foreign('poaActividad_id')->references('id')->on('poaActividad');
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
        Schema::dropIfExists('poaActividadMes');
    }
}
