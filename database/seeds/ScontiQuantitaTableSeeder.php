<?php

use Illuminate\Database\Seeder;

class ScontiQuantitaTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('sconti_quantita')->insert(
                array(
                    array('quantita_min' => 2, 'quantita_max' => 3, 'sconto' => 5),
                    array('quantita_min' => 4, 'quantita_max' => 5, 'sconto' => 8),
                    array('quantita_min' => 6, 'quantita_max' => 0, 'sconto' => 10),
        ));
    }

}
