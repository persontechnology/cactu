<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuzonCartasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buzon_cartas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('archivo')->nullable();
            $table->enum('estado',['Creada','Enviada','Respondida']);           
            $table->string('imagen')->nullable();
            $table->string('imagen2')->nullable();
            $table->longText('respuesta')->nullable();
            $table->unsignedBigInteger('buzon_id');
            $table->foreign('buzon_id')->references('id')->on('buzons');           
            $table->unsignedBigInteger('tipo_cartas_id');
            $table->foreign('tipo_cartas_id')->references('id')->on('tipo_cartas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buzon_cartas');
    }
}
