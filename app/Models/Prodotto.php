<?php namespace App\Models;

use Illuminate\Support\Facades\Validator as Validator;

class Prodotto extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'prodotti';

    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('prodotto', 'descrizione', 'foto', 'prezzo');

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
        'prodotto' => 'required|min:2|max:200',
        'descrizione' => 'required|max:1000',
        'immagine' => 'required',
        'prezzo' => 'required|numeric|min:0'
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
        $this->prodotto = $data['prodotto'];
        $this->descrizione = $data['descrizione'];
        $this->prezzo = $data['prezzo'];

        $nomeImmagine = time() . $data['immagine']->getClientOriginalName();

        /*save file on filesystem*/
        $data['immagine']->move(
            base_path() . '/public/uploads/', $nomeImmagine
        );

        /*save file information on database*/
        $this->immagine = new Immagine();
        $this->immagine->nome = $nomeImmagine;
        $this->immagine->didascalia = $data['prodotto'];
        $this->push();
    }

    public function immagine()
    {
        return $this->belongsTo('Immagine','immagine');
    }

}
