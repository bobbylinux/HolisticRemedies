<?php

use Illuminate\Database\Seeder;
use App\Models\ScontoTipoPagamento;
use Illuminate\Support\Facades\File;

class ScontiPagamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get(database_path() . '/data/sconto_tipopagamento.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            ScontoTipoPagamento::create(array(
                'id' => $obj->id,
                'pagamento' => $obj->idPagamento,
                'sconto' => $obj->sconto
            ));
        }
        $this->command->info("tabella sconti_tipopagamento popolata");
    }
}