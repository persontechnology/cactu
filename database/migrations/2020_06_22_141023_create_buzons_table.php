<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuzonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buzons', function (Blueprint $table) {
            $table->bigIncrements('id');
    
            // $table->string('archivo')->nullable();
            $table->enum('estado',['Creada','Enviada','Respondida']);
            // $table->longText('respuesta')->nullable();
            $table->unsignedBigInteger('ninio_id');
            $table->foreign('ninio_id')->references('id')->on('ninio');
            $table->date('fecha');
            // $table->unsignedBigInteger('tipo_cartas_id');
            // $table->foreign('tipo_cartas_id')->references('id')->on('tipo_cartas');
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
        Schema::dropIfExists('buzons');
    }
}
