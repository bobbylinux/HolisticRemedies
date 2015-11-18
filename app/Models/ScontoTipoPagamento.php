<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator as Validator;

class ScontoTipoPagamento extends BaseModel
{
    protected $table = "sconti_tipopagamento";

    protected $fillable = array('pagamento','sconto');

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'pagamento' => 'required|min:1',
        'sconto' => 'required|min:0'
    );

    /**
     * The variable for validation rules
     *
     */
    protected $errors = "";

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->pagamento    = $data['pagamento'];
        $this->sconto       = $data['sconto'];
        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->pagamento    = $data['pagamento'];
        $this->sconto       = $data['sconto'];
        $this->save();
    }

    /**
     * The function for delete in database from view
     *
     * @data array
     */
    public function trash() {
        $now = date('Y-m-d H:i:s');
        $this->cancellato = true;
        $this->data_cancellazione = $now;
        $this->save();
    }

    /**
     * The relationships
     *
     */
    public function tipiPagamento() {

        return  $this->belongsTo('App\Models\TipoPagamento','pagamento'); // default
    }
}
