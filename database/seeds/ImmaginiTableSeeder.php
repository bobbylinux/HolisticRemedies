<?php

use Illuminate\Database\Seeder;
use App\Models\Immagine;
use Illuminate\Support\Facades\File;

class ImmaginiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/immagini.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Immagine::create(array(
                'id' => $obj->id,
                'nomefile' => $obj->nomefile,
                'didascalia' => $obj->didascalia
            ));
        }
        $this->command->info("tabella immagini popolata");
    }
}