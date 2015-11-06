<?php namespace App\Models;


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
    protected $rules = array(
        'prodotto' => 'required|min:2|max:200',
        'descrizione' => 'required|max:1000',
        'immagine' => 'required|numeric',
        'prezzo' => 'required|numeric|min:0'
    );

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
        $this->immagine = $data['immagine'];

        self::save();
    }
    
    /**
     * The function for update in database from view
     *
     * @data array
     */
    public function edit($data)
    {
        $this->prodotto = $data['prodotto'];
        $this->descrizione = $data['descrizione'];
        $this->prezzo = $data['prezzo'];
        $this->immagine = $data['immagine'];

        $this->save();
    }

    /*
     *
     * set the relationships
     *
     * */

    public function immagini() {
        return $this->belongsTo('App\Models\Immagine','immagine');
    }

    public function ordini() {

        return $this->belongsToMany('App\User\OrdineTesta', 'ordini_dettaglio','prodotto','ordine');
    }


}
