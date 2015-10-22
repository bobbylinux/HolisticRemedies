<?php

use Illuminate\Database\Seeder;

class UtentiTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('utenti')->insert(
                array(
                    
                    array('username' => 'bobbylinux@hotmail.it', 'password' => '25d55ad283aa400af464c76d713c07ad', 'ruolo' => '2', 'confermato' => true),
        ));
    }

}
