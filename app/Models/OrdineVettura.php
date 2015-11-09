<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdineVettura extends BaseModel
{
    protected $table = "ordini_vettura";

    public function ordine() {
        return $this->belongsTo('App\Models\OrdineTesta', 'ordine');
    }
}
