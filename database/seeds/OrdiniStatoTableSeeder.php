<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class OrdiniStatoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/ordini_stato.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            try {
                DB::table('ordini_stato')->insert([
                    'ordine' => $obj->ordine,
                    'stato' => $obj->stato,
                    'data_creazione' => $obj->data_creazione
                ]);

            } catch (QueryException  $e) {
                var_dump($e->errorInfo);
            }
        }
        $this->command->info("tabella ordini_stato popolata");
    }
}
