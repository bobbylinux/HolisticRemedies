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
            $table->string('sessione',50);
            $table->integer('prodotto')->unsigned();
            $table->foreign('prodotto')->references('id')->on('prodotti');
            $table->integer('quantita')->unsigned()->default(1);
            $table->primary(array('sessione', 'prodotto'));
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
