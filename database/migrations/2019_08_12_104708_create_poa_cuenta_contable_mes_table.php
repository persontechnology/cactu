<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoaCuentaContableMesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poaCuentaContableMes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->decimal('valor', 8, 2)->default(0);
            $table->unsignedBigInteger('cuentaContablePoaCuenta_id');
            $table->foreign('cuentaContablePoaCuenta_id')->references('id')->on('cuentaContablePoaCuenta');
            $table->unsignedBigInteger('mes_id');
            $table->foreign('mes_id')->references('id')->on('mes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poaCuentaContableMes');
    }
}
