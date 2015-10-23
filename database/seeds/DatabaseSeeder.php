<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
            
        $this->call(NazioniTableSeeder::class);
        $this->call(RuoloUtentiTableSeeder::class);
        $this->call(UtentiTableSeeder::class);
        $this->call(ClientiTableSeeder::class);
        $this->call(ImmaginiTableSeeder::class);
        $this->call(ProdottiTableSeeder::class);
        $this->call(SpedizioneTableSeeder::class);
        $this->call(TipoPagamentoTableSeeder::class);
        $this->call(ScontiPagamentoTableSeeder::class);
        $this->call(ScontiQuantitaTableSeeder::class);
        $this->call(StatiTableSeeder::class);

        Model::reguard();
    }
}
