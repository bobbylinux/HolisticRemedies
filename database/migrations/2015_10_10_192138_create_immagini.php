<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmagini extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immagini', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomefile',255);
            $table->string('didascalia',1000);
            $table->integer('prodotto')->unsigned();
            $table->foreign('prodotto')->references('id')->on('prodotti');
            $table->boolean('cancellato')->default(false); //flag di cancellazione: true = cancellato, false = non cancellato, default = false
            $table->timestamp('data_creazione')->default(DB::raw('CURRENT_TIMESTAMP')); //data creazione default sysdate
            $table->timestamp('data_modifica')->default(DB::raw('CURRENT_TIMESTAMP')); //data modifica default sysdate
            $table->timestamp('data_cancellazione')->nullable(); //data cancellazione
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('immagini');
    }
}
