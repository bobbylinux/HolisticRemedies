<?php

namespace App\Models;

class OrdineTesta extends BaseModel
{
    protected $table = "ordini_testa";

    public function prodotti()
    {
        return $this->belongsToMany('App\Models\Prodotto', 'ordini_dettaglio', 'ordine', 'prodotto');
    }

    public function utenti()
    {
        return $this->belongsTo('App\Models\Utente', 'utente');
    }

    public function stati()
    {
        return $this->belongsToMany('App\Models\Stato', 'ordini_stato', 'ordine', 'stato')->withPivot('data_creazione')->latest("data_creazione");
    }
}
