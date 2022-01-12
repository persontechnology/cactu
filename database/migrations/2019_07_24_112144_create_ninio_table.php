<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNinioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ninio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comumidad')->nullable()->default(0);
            $table->string('casoParticipante')->nullable();
            $table->bigInteger('numeroChild')->nullable()->unique();
            $table->string('nombres',255)->nullable();
            $table->enum('genero', ['Male', 'Female']);
            $table->date('fechaNacimiento')->nullable();
            $table->string('estadoPatrocinio',255)->nullable();
            $table->date('fechaRegistro')->nullable();
            $table->string('latitud',255)->nullable();
            $table->string('longitud',255)->nullable();
            $table->unsignedBigInteger('comunidad_id');
            $table->foreign('comunidad_id')->references('id')->on('comunidad');            
            $table->unsignedBigInteger('tipoParticipante_id');
            $table->foreign('tipoParticipante_id')->references('id')->on('tipoParticipante');
            $table->timestamps();
            $table->bigInteger('creadoPor')->nullable();
            $table->bigInteger('actualizadoPor')->nullable();
            $table->string('qr')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('estado')->default(true);
            
            // A:Deivid
            // D: añaniedo usuario para participantes
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ninio');
    }
}
