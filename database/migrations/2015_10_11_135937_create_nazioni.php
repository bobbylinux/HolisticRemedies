<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNazioni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nazioni', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomefile',255);
            $table->date('inizio_validita');
            $table->date('fine_validita');
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
        Schema::drop('nazioni');
    }
}
