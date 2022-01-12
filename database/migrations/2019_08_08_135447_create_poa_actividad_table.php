<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoaActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poaActividad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('poa_id');
            $table->foreign('poa_id')->references('id')->on('poa');

            $table->unsignedBigInteger('tipoActividad_id');
            $table->foreign('tipoActividad_id')->references('id')->on('tipoActividad');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poaActividad');
    }
}
