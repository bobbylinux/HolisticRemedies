<?php namespace App\Models;

use Illuminate\Support\Facades\Validator as Validator;

class Immagine extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'immagini';

    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('nomefile', 'didascalia');

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
        'didascalia' => 'required|max:1000',
        'immagine' => 'mimes:jpeg,jpg,png'
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
        $validation = Validator::make($data, $this->rules, $this->messages);

        if ($validation->fails()) {
            // set errors and return false
            $this->errors = $validation->errors();
            return false;
        }

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
        $nomeImmagine = time() . '-'. $data['immagine']->getClientOriginalName();

        /*save file on filesystem*/
        $data['immagine']->move(
            base_path() . '/public/uploads/', $nomeImmagine
        );

        /*save file information on database*/
        $this->nomefile = $nomeImmagine;
        $this->didascalia = $data['prodotto'];
        self::save();
        return $this->id;
    }
    
    
}
