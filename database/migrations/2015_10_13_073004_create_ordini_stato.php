<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdiniStato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordini_stato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ordine')->unsigned();
            $table->foreign('ordine')->references('id')->on('ordini_testa');
            $table->integer('stato')->unsigned();
            $table->foreign('stato')->references('id')->on('stati');
            $table->timestamp('data_creazione')->default(DB::raw('CURRENT_TIMESTAMP')); //data creazione default sysdate
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ordini_stato');
    }
}
