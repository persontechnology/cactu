<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',255)->nullable();
            $table->date('desde');
            $table->date('hasta');
            $table->enum('estado',['proceso','finalizado']);
            $table->timestamps();
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
        Schema::dropIfExists('planificacion');
    }
}
