<?php

use Illuminate\Database\Seeder;
use App\Models\Utente;
use Illuminate\Support\Facades\File;

class UtentiTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $json = File::get(database_path().'/data/utenti.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Utente::create(array(
                    'id' => $obj->id,
                    'username' => $obj->username,
                    'password' => $obj->password,
                    'ruolo' => $obj->ruolo,
                    'confermato' => $obj->confermato,
                    'cancellato' => $obj->cancellato
            ));  
        }    
        $this->command->info("tabella utenti popolata");
    }

}
