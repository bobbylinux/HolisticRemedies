<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RuoloUtentiTableSeeder extends Seeder {

    public function run() {
        DB::table('ruolo_utenti')->insert(
                array(
                    array('id' => '1', 'ruolo' => 'amministatore'),
                    array('id' => '2', 'ruolo' => 'utente standard'),
        ));
    }

}
