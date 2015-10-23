<?php

use Illuminate\Database\Seeder;

class SpedizioneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spedizione')->insert(
                array(
                    array('id' => '1', 'spedizione' => 'spedizione da Italia','costo'=>9.60,'massimale'=>79.99)
        ));
    }
}
