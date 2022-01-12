<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoaContableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poaContable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
             $table->string('descripcion',255)->nullable();
             $table->unsignedBigInteger('poa_id');
            $table->foreign('poa_id')->references('id')->on('poa');

            /*$table->unsignedBigInteger('cuentaContable_id');
            $table->foreign('cuentaContable_id')->references('id')->on('cuentaContable');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poaContable');
    }
}
