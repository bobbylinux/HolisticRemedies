<?php

namespace App\Models;

class ScontoTotaleOrdine extends BaseModel
{
    protected $table = "sconti_totaleordine";

    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('totale_min', 'totale_max','sconto');

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'totale_min' => 'required|numeric|min:0',
        'totale_max' => 'required|numeric|min:0',
        'sconto' => 'required|min:0'
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
        $this->totale_min = $data['totale_min'];
        $this->totale_max = $data['totale_max'];
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
        $this->totale_min = $data['totale_min'];
        $this->totale_max = $data['totale_max'];
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
}
