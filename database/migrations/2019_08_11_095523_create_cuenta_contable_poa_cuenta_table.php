<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentaContablePoaCuentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentaContablePoaCuenta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('cuentaContable_id');
            $table->foreign('cuentaContable_id')->references('id')->on('cuentaContable');

            $table->unsignedBigInteger('poaContable_id');
            $table->foreign('poaContable_id')->references('id')->on('poaContable');

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
        Schema::dropIfExists('cuentaContablePoaCuenta');
    }
}
