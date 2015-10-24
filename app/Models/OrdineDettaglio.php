<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdineDettaglio extends BaseModel
{
    protected $table = "ordini_dettaglio";

    public function testa() {
        return $this->belongsTo("OrdineTesta","ordine");
    }

    public function prodotti() {
        return $this->belongsToMany('App\Model', 'relations', 'first_id', 'second_id')
            ->withPivot(['relation_type'])
            ->where('relations.relation_type', '=', 'type_unit');
    }
}
