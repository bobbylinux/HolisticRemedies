<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class OrdiniVetturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/ordini_vettura.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            try {
                DB::table('ordini_vettura')->insert([
                    'ordine' => $obj->ordine,
                    'vettura' => $obj->vettura,
                ]);

            } catch (QueryException  $e) {
                var_dump($e->errorInfo);
            }
        }
        $this->command->info("tabella ordini_vettura popolata");
    }
}
