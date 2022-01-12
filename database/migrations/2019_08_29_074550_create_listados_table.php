<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('asistencia_id');
            $table->foreign('asistencia_id')->references('id')->on('asistencias');
            
            $table->unsignedBigInteger('ninio_id');
            $table->foreign('ninio_id')->references('id')->on('ninio');
            $table->enum('opcion',['MadrePadreAfiliado','Otros'])->nullable();
            
            $table->integer('edad')->default(0);
            $table->boolean('afiliado')->default(false);
            $table->string('lugar')->nullable();
            $table->string('firma')->nullable();
            $table->text('fotoQr')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listados');
    }
}
