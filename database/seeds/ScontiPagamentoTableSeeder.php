<?php

use Illuminate\Database\Seeder;

class ScontiPagamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sconti_tipopagamento')->insert(
                array(
                    array('pagamento' => 1, 'sconto' => 0),
                    array('pagamento' => 2, 'sconto' => 7),
                    array('pagamento' => 3, 'sconto' => 7),
                    array('pagamento' => 4, 'sconto' => 7),
        ));
        
    }
}