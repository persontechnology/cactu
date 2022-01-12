<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('estado',['Planificando','Entregada','Aceptada'])->default('Planificando');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('poaCuentaContableMes_id');
            $table->foreign('poaCuentaContableMes_id')->references('id')->on('poaCuentaContableMes')->onDelete('cascade');


            $table->unsignedBigInteger('comunidadPoaParticipante_id');
            $table->foreign('comunidadPoaParticipante_id')->references('id')->on('comunidadPoaParticipante')->onDelete('cascade');

            $table->bigInteger('creadoPor')->nullable();
            $table->bigInteger('actualizadoPor')->nullable();
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
        Schema::dropIfExists('actas');
    }
}
