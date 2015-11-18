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
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'prodotto' => 'required|min:2|max:200',
        'descrizione' => 'required|max:1000',
        'prezzo' => 'required|numeric|min:0'
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

    /*
     *
     * set the relationships
     *
     * */

    public function immagini() {
        return $this->belongsTo('App\Models\Immagine','immagine');
    }

    public function ordini() {

        return $this->belongsToMany('App\User\OrdineTesta', 'ordini_dettaglio','prodotto','ordine')->withPivot('quantita', 'costo','cancellato');
    }


}
