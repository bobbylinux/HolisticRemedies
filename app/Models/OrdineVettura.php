<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdineVettura extends BaseModel
{
    protected $table = "ordini_vettura";
    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('ordine', 'vettura');

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'vettura' => 'required|min:2|max:50',
        'ordine' => 'required|exists:ordini_testa,id'
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
        $this->ordine = $data['ordine'];
        $this->vettura = $data['vettura'];

        self::save();
    }

    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->ordine = $data['ordine'];
        $this->vettura = $data['vettura'];
        $this->cancellato = false;
        $this->data_cancellazione = null;
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
     * The function for store in database from view
     *
     * @data array
     */
    public function ordine() {
        return $this->belongsTo('App\Models\OrdineTesta', 'ordine');
    }
}
