<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator as Validator;

class OrdineTesta extends BaseModel
{
    protected $table = "ordini_testa";

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'utente' => 'required|numeric|exists:utenti,id',
        'costo' => 'required|numeric|min:0',
        'costospedizione' => 'required|numeric|min:0',
        'sconto' => 'required|numeric|min:0',
        'tipopagamento' => 'required|numeric|exists:tipopagamento,id'
    );

    /**
     * The variable for validation rules
     *
     */
    protected $errors = "";


    /**
     * The function that incapsulate the error variable
     *
     * @errors array
     */
    public function getErrors()
    {
        return $this->errors;
    }
     /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->utente = $data['utente'];
        $this->costo = $data['costo'];
        $this->costospedizione = $data['costospedizione'];
        $this->sconto = $data['sconto'];
        $this->tipo_pagamento = $data['tipopagamento'];

        self::save();
    }

    /**
     * Set the relationtships
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     *
     */
    
    public function prodotti()
    {
        return $this->belongsToMany('App\Models\Prodotto', 'ordini_dettaglio', 'ordine', 'prodotto')->withPivot('quantita', 'costo','cancellato');
    }

    public function utenti()
    {
        return $this->belongsTo('App\Models\Utente', 'utente');
    }

    public function stati()
    {
        return $this->belongsToMany('App\Models\Stato', 'ordini_stato', 'ordine', 'stato')->withPivot('data_creazione');
    }

    public function lastStato()
    {
        return $this->hasOne('Price')->latest();
    }

    public function tracking() {
        return $this->hasOne('App\Models\OrdineVettura', 'ordine');
    }

    public function pagamenti() {
        return $this->BelongsTo('App\Models\TipoPagamento','tipo_pagamento');
    }
    
    
}
