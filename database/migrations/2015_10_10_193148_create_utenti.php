<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtenti extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('utenti', function(Blueprint $table) {
            $table->increments('id'); //chiave primaria
            $table->string('username', 128)->unique(); //nome utente con standard email es: email@email.com
            $table->string('password', 64); //password che verrà crittografata secondo gestione di laravel
            $table->integer('ruolo')->unsigned();
            $table->foreign('ruolo')->references('id')->on('ruolo_utenti'); //ruolo in relazione con la tabella dei ruoli
            $table->boolean('confermato')->default(false);
            $table->string('codice_conferma')->nullable();
            $table->rememberToken();//set del token che permette di ricordare la sessione utente
            $table->boolean('cancellato')->default(false); //flag di cancellazione: true = cancellato, false = non cancellato, default = false
            $table->timestamp('data_creazione')->default(DB::raw('CURRENT_TIMESTAMP')); //data creazione default sysdate
            $table->timestamp('data_modifica')->default(DB::raw('CURRENT_TIMESTAMP')); //data modifica default sysdate
            $table->timestamp('data_cancellazione')->nullable(); //data cancellazione 
        });

        DB::table('utenti')->insert(
            array(
                array('username' => 'roberto.bani@gmail.com','password' => '25d55ad283aa400af464c76d713c07ad','ruolo'=>'1','confermato' => true),
                array('username' => 'bobbylinux@hotmail.it','password' => '25d55ad283aa400af464c76d713c07ad','ruolo'=>'2','confermato' => true),
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('utenti');
    }

}
