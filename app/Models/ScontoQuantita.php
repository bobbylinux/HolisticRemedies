<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator as Validator;

class ScontoQuantita extends BaseModel
{
    protected $table = 'sconti_quantita';
    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('quantita_min', 'quantita_max','sconto');

    /**
     * The variable for system date time
     *
     */
    protected $now = null;

    /**
     * The variable for validation rules
     *
     */
    private $rules = array(
        'quantita_min' => 'required|min:0',
        'quantita_max' => 'required|min:0',
        'sconto' => 'required|min:0'
    );

    /**
     * The variable for validation rules
     *
     */
    private $errors = "";

    /**
     * The function for validate
     *
     * @data array
     */
    public function validate($data)
    {
        /*$validation = Validator::make($data, $this->rules, $this->messages);

        if ($validation->fails()) {
            // set errors and return false
            $this->errors = $validation->errors();
            return false;
        }
        */
        return true;
    }

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
        $this->quantita_min = $data['quantita_min'];
        $this->quantita_max = $data['quantita_max'];
        $this->sconto       = $data['sconto'];
        self::save();
    }
}
