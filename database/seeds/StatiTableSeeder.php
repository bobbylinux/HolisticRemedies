<?php

use Illuminate\Database\Seeder;

class StatiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stati')->insert(
                array(
                    array('stato' => '0', 'descrizione' => 'ANNULLATO'),
                    array('stato' => '1', 'descrizione' => 'IN ATTESA PAGAMENTO'),
                    array('stato' => '2', 'descrizione' => 'LAVORAZIONE'),
                    array('stato' => '3', 'descrizione' => 'EVASO')
        ));
    }
}
