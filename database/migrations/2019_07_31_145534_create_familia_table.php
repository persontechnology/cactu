<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('papa',255)->nullable();
            $table->string('mama',255)->nullable();
            $table->string('hermano1',255)->nullable();
            $table->string('hermano2',255)->nullable();
            $table->string('hermano3',255)->nullable();
            $table->string('hermano4',255)->nullable();
            $table->string('hermano5',255)->nullable();
            $table->string('hermano6',255)->nullable();
            $table->string('hermano7',255)->nullable();
            $table->string('hermano8',255)->nullable();
            $table->string('abuelo',255)->nullable();
            $table->string('abuela',255)->nullable();
            $table->string('tio',255)->nullable();
            $table->string('cunado',255)->nullable();
            $table->string('sobrino',255)->nullable();
            /**este campo para el nombre del representante */
            $table->string('otro1',255)->nullable();
            /**este campo para el nombre del celular */
            $table->string('otro2',255)->nullable();
            /**este campo para el nombre del email */
            $table->string('otro3',255)->nullable();
            $table->string('maestro',255)->nullable();
            $table->unsignedBigInteger('ninio_id');
            $table->foreign('ninio_id')->references('id')->on('ninio');
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
        Schema::dropIfExists('familia');
    }
}
