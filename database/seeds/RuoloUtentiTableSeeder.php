<?php

use Illuminate\Database\Seeder;
use App\Models\Ruolo;
use Illuminate\Support\Facades\File;

class RuoloUtentiTableSeeder extends Seeder
{

    public function run()
    {
        $json = File::get(database_path().'/data/ruoloutenti.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Ruolo::create(array(
                'id' => $obj->id,
                'ruolo' => $obj->ruolo
            ));
        }

        $this->command->info("tabella ruolo_utenti popolata");
    }

}
