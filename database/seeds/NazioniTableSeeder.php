<?php

use Illuminate\Database\Seeder;
use App\Models\Nazione;
use Illuminate\Support\Facades\File;

class NazioniTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path().'/data/nazioni.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Nazione::create(array(
                'id' => $obj->id,
                'nazione' => $obj->nazione,
                'inizio_validita' => $obj->inizio_validita,
                'fine_validita' => $obj->fine_validita
            ));
        }
        $this->command->info("tabella nazioni popolata");
    }
}
