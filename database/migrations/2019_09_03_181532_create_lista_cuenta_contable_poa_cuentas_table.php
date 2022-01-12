<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListaCuentaContablePoaCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listaCuentaContable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('listado_id');
            $table->foreign('listado_id')->references('id')->on('listados')->onDelete('cascade');

            $table->unsignedBigInteger('cuentaContablePoaCuenta_id');
            $table->foreign('cuentaContablePoaCuenta_id')->references('id')->on('cuentaContablePoaCuenta')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_cuenta_contable_poa_cuentas');
    }
}
