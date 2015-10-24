<?php

use Illuminate\Database\Seeder;
use App\Models\OrdineTesta ;
use Illuminate\Support\Facades\File;

class OrdiniTestaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ordini_testa')->insert(
                array(
                    array('id' => '1', 'ruolo' => 'amministatore'),
                    array('id' => '2', 'ruolo' => 'utente standard'),
        ));
    }
}
