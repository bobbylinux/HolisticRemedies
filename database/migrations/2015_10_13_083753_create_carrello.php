<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrello extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrello', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('utente')->unsigned();
            $table->foreign('utente')->references('id')->on('utenti');
            $table->integer('prodotto')->unsigned();
            $table->foreign('prodotto')->references('id')->on('prodotti');
            $table->integer('quantita')->unsigned()->default(1);
            $table->timestamp('data_creazione')->default(DB::raw('CURRENT_TIMESTAMP')); //data creazione default sysdate
            $table->timestamp('data_modifica')->default(DB::raw('CURRENT_TIMESTAMP')); //data modifica default sysdate
            $table->unique(array('utente', 'prodotto'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carrello');
    }
}
