<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScontoTipoPagamento extends Model
{
    protected $table = "sconti_tipopagamento";

    protected $fillable = array('pagamento','sconto');

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
        'pagamento' => 'required|min:0',
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
        $this->pagamento    = $data['pagamento'];
        $this->sconto       = $data['sconto'];
        self::save();
    }
}
