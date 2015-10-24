<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Illuminate\Support\Facades\File;


class ClientiTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/clienti.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            Cliente::create(array(
                'id' => $obj->id,
                'nome'  => $obj->nome,
                'cognome' => $obj->cognome,
                'societa' => $obj->societa,
                'indirizzo' => $obj->indirizzo,
                'cap' => $obj->cap,
                'comune' => $obj->comune,
                'provincia' => $obj->provincia,
                'nazione' => $obj->nazione,
                'telefono' => $obj->telefono,
                'fax' => $obj->fax,
                'utente' => $obj->utente,
                'cancellato' => $obj->cancellato
            ));
        }
        $this->command->info("tabella clienti popolata");
    }

}
