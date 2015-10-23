<?php

use Illuminate\Database\Seeder;

class ProdottiTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('prodotti')->insert(
                array(
                    array('id' => 21, 'prodotto' => 'Capsule 100 - Caps 100 pcs', 'descrizione' => 'Confezione da 100<br>Capsule Caps 100 pcs.', 'prezzo' => 35),
                    array('id' => 22, 'prodotto' => 'Capsule 200 - Caps 200 pcs', 'descrizione' => 'Confezione da 200<br>Capsule Caps 200 pcs.', 'prezzo' => 55),
                    array('id' => 23, 'prodotto' => 'Polvere 60 gr - Powder 60 gr', 'descrizione' => 'Confezione Polvere 60 grammi<br>Powder 60 grams', 'prezzo' => 32),
                    array('id' => 24, 'prodotto' => 'Polvere 120 gr - Powder 120 gr', 'descrizione' => 'Confezione Polvere 120 grammi<br>Powder 120 grams', 'prezzo' => 36),
        ));
    }

}
