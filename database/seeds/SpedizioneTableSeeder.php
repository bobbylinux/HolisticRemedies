<?php

use Illuminate\Database\Seeder;
use App\Models\Spedizione;
use Illuminate\Support\Facades\File;

class SpedizioneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/spedizione.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Spedizione::create(array(
                'id' => $obj->id,
                'spedizione' => $obj->spedizione,
                'costo' => $obj->costo,
                'massimale' => $obj->massimale
            ));
        }
        $this->command->info("tabella spedizione popolata");
    }
}
