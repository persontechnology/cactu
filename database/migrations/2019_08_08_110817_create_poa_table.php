<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            $table->unsignedBigInteger('planificacionModelo_id');
            $table->foreign('planificacionModelo_id')->references('id')->on('planificacionModelo');

            $table->unsignedBigInteger('actividad_id');
            $table->foreign('actividad_id')->references('id')->on('actividad');

            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulo');

            $table->integer('numeroSesiones')->default(0);
            $table->string('descripcion',255);
          
            //editado por fabian lopez
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
        Schema::dropIfExists('poa');
    }
}
