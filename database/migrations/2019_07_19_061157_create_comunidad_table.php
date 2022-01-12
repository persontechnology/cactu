<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComunidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunidad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('nombre');
            $table->string('codigo');
            
            $table->unsignedBigInteger('canton_id');
            $table->foreign('canton_id')->references('id')->on('canton');


            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('comunidad');
    }
}
