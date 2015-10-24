<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdineTesta extends BaseModel
{
    protected $table = "ordini_testa";

    public function prodotti() {
        return $this->belongsToMany('App\User\Prodotto', 'ordini_dettaglio','ordine','prodotto');
    }
}
