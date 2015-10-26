<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class OrdiniDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/ordini_dettaglio.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            try {
                DB::table('ordini_dettaglio')->insert([
                    'id' => $obj->id,
                    'ordine' => $obj->ordine,
                    'prodotto' => $obj->prodotto,
                    'quantita' => $obj->quantita,
                    'costo' => $obj->costo,
                ]);

            } catch (QueryException  $e) {
                var_dump($e->errorInfo);
            }
        }
        $this->command->info("tabella ordini_dettaglio popolata");
    }
}
