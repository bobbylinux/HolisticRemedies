<?php

use Illuminate\Database\Seeder;
use App\Models\OrdineTesta;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class OrdiniTestaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path().'/data/ordini_testa.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            try {
                OrdineTesta::create(array(
                    'id' => $obj->id,
                    'utente' => $obj->utente,
                    'costo' => $obj->costo,
                    'costospedizione' => $obj->costospedizione,
                    'sconto' => $obj->sconto,
                    'tipo_pagamento' => $obj->tipo_pagamento,
                    'data_creazione' => $obj->data_creazione
                ));
            } catch (QueryException  $e) {
                var_dump($e->errorInfo );
            }
        }
        $this->command->info("tabella ordini_testa popolata");
    }
}
