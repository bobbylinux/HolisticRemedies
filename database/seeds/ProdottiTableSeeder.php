<?php

use Illuminate\Database\Seeder;
use App\Models\Prodotto;
use Illuminate\Support\Facades\File;

class ProdottiTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/prodotti.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Prodotto::create(array(
                'id' => $obj->id,
                'prodotto' => $obj->prodotto,
                'descrizione' => $obj->descrizione,
                'prezzo' => $obj->prezzo,
                'immagine' => $obj->immagine
            ));
        }
        $this->command->info("tabella prodotti popolata");
    }
}
