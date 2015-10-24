<?php

use Illuminate\Database\Seeder;
use App\Models\ScontoQuantita;
use Illuminate\Support\Facades\File;

class ScontiQuantitaTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $json = File::get(database_path() . '/data/sconto_quantita.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            ScontoQuantita::create(array(
                'id' => $obj->id,
                'quantita_min' => $obj->quantita_min,
                'quantita_max' => $obj->quantita_max,
                'sconto'       => $obj->sconto
            ));
        }
        $this->command->info("tabella sconti_quantita popolata");
    }

}
