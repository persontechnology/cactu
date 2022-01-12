<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuzonCartaBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buzon_carta_boletas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('boleta')->nullable();
            $table->unsignedBigInteger('buzon_cartas_id');
            $table->foreign('buzon_cartas_id')->references('id')->on('buzon_cartas');   
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
        Schema::dropIfExists('buzon_carta_boletas');
    }
}
