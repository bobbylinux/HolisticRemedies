<?php

use Illuminate\Database\Seeder;
use App\Models\Stato;
use Illuminate\Support\Facades\File;

class StatiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/stati.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Stato::create(array(
                'id' => $obj->id,
                'descrizione' => $obj->descrizione,
            ));
        }
        $this->command->info("tabella stati popolata");
    }
}
