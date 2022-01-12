<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactoToNinioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ninio', function (Blueprint $table) {
            $table->boolean('estado_token')->default('0');
            $table->string('celular')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('token',100)->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ninio', function (Blueprint $table) {
            $table->dropColumn(['estado_token', 'celular','email','token']);
        });
    }
}
