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
        Eloquent::unguard();
        DB::connection()->disableQueryLog();
        Model::unguard();
        DB::table('ordini_vettura')->delete();
        DB::table('ordini_stato')->delete();
        DB::table('ordini_dettaglio')->delete();
        DB::table('ordini_testa')->delete();
        DB::table('clienti')->delete();
        DB::table('utenti')->delete();
        DB::table('sconti_tipopagamento')->delete();
        DB::table('tipopagamento')->delete();
        DB::table('ruolo_utenti')->delete();
        DB::table('nazioni')->delete();
        DB::table('spedizione')->delete();
        DB::table('stati')->delete();
        DB::table('prodotti')->delete();
        DB::table('immagini')->delete();
        DB::table('sconti_quantita')->delete();
        $this->call('NazioniTableSeeder');
        $this->call('RuoloUtentiTableSeeder');
        $this->call('TipoPagamentoTableSeeder');
        $this->call('ScontiQuantitaTableSeeder');
        $this->call('ScontiPagamentoTableSeeder');
        $this->call('ImmaginiTableSeeder');
        $this->call('ProdottiTableSeeder');
        $this->call('StatiTableSeeder');
        $this->call('SpedizioneTableSeeder');
        $this->call('UtentiTableSeeder');
        $this->call('ClientiTableSeeder');
        $this->call('OrdiniTestaTableSeeder');
        $this->call('OrdiniDetailTableSeeder');
        $this->call('OrdiniStatoTableSeeder');
        $this->call('OrdiniVetturaTableSeeder');
        Model::reguard();
    }
}
