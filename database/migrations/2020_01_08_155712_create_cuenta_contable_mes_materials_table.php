<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentaContableMesMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_contable_mes_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('precio', 8, 4)->default(0);
            $table->decimal('iva', 8, 2)->default(0);
            $table->integer('cantidad')->default(0);
            $table->unsignedBigInteger('acta_id');
            $table->foreign('acta_id')->references('id')->on('actas');
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials');

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
        Schema::dropIfExists('cuenta_contable_mes_materials');
    }
}
