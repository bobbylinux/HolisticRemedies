<?php

use Illuminate\Database\Seeder;

class ImmaginiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('immagini')->insert(
                array(
                    array('id' => 1, 'nomefile' => '1445444019-39.jpg', 'didascalia' => 'Capsule 100 - Caps 100 pcs'),
                    array('id' => 2, 'nomefile' => '1445444019-39.jpg', 'didascalia' => 'Capsule 200 - Caps 200 pcs'),
                    array('id' => 3, 'nomefile' => '1445444019-35.jpg', 'didascalia' => 'Polvere 60 gr - Powder 60 gr'),
                    array('id' => 4, 'nomefile' => '1445444019-35.jpg', 'didascalia' => 'Polvere 120 gr - Powder 120 gr'),
        ));
    }
}