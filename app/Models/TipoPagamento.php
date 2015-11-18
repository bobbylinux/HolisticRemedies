<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPagamento extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipopagamento';

    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('nomefile', 'didascalia');

    /**
     * The relationships
     *
     */
    public function scontiTipoPagamento() {

        return  $this->hasOne('App\Models\ScontoTipoPagamento','pagamento');
    }


    public function ordini() {
        return $this->HasMany('App\Models\OrdineTesta','tipo_pagamento');
    }
}
