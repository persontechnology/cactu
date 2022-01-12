<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajeNiniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensaje_ninios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mensaje');
            $table->unsignedBigInteger('ninio_id');
            $table->foreign('ninio_id')->references('id')->on('ninio');
            $table->date('fecha');
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
        Schema::dropIfExists('mensaje_ninios');
    }
}
