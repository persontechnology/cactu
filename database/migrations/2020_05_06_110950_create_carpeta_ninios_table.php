<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpetaNiniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpeta_ninios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricion',250)->nullable();
            $table->string('archivo')->nullable();
            $table->unsignedBigInteger('ninio_id');
            $table->foreign('ninio_id')->references('id')->on('ninio');
            $table->unsignedBigInteger('tipoarchivo_id');
            $table->foreign('tipoarchivo_id')->references('id')->on('tipo_archivos');
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
        Schema::dropIfExists('carpeta_ninios');
    }
}
