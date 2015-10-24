<?php

use Illuminate\Database\Seeder;
use App\Models\TipoPagamento;
use Illuminate\Support\Facades\File;


class TipoPagamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/tipopagamento.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            TipoPagamento::create(array(
                'id' => $obj->id,
                'pagamento' => $obj->pagamento,
                'informazioni' => $obj->informazioni
            ));
        }
        $this->command->info("tabella tipopagamento popolata");
    }
}
