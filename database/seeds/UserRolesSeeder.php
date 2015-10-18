<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserRolesSeeder extends Seeder {

    public function run()
    {
        DB::table('ruolo_utenti')->delete();

        Ruolo::create(['ruolo' => 'administrator']);
        Ruolo::create(['ruolo' => 'user']);
    }

}