<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clienti', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',100);
            $table->string('cognome',100);
            $table->string('societa',100)->nullable();
            $table->string('indirizzo',200)->nullable();
            $table->string('cap',5)->nullable();
            $table->string('comune',255)->nullable();
            $table->string('provincia',10)->nullable();
            $table->integer('nazione')->references('id')->on('nazioni');
            $table->string('telefono',20)->nullable();
            $table->string('fax',20)->nullable();
            $table->integer('utente')->references('id')->on('utenti');
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
        Schema::drop('clienti');
    }
}
