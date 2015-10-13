<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdiniDettaglio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordini_dettaglio', function (Blueprint $table) {
            $table->increments('id');                
            $table->integer('ordine')->unsigned();
            $table->foreign('ordine')->references('id')->on('ordini_testa');
            $table->integer('prodotto')->unsigned();
            $table->foreign('prodotto')->references('id')->on('prodotti');
            $table->integer('quantita')->unsigned()->default(0);
            $table->decimal('costo',10,2)->default(0);            
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
        Schema::drop('ordini_dettaglio');
    }
}
