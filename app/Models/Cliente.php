<?php   namespace App\Models;

class Cliente extends BaseModel
{
    protected $table = "clienti";

    protected $rules = array(
        'cognome' => 'required|min:2|max:100|alpha',
        'nome' => 'required|min:2|max:100|alpha',
        'indirizzo' => 'required|min:5|max:200',
        'citta' => 'required|min:2|max:255|alpha',
        'cap' => 'alpha_dash|max:5',
        'provincia' => 'max:10',
        'stato' => 'required|numeric|exists:nazioni,id',
        'telefono' => 'required|max:20'
    );

    /**
     * The variable for validation rules
     *
     */
    protected $errors = "";


    public function store($data) {

        $this->cognome = strtoupper($data['cognome']);
        $this->nome = strtoupper($data['nome']);
        $this->indirizzo = strtoupper($data['indirizzo']);
        $this->comune = strtoupper($data['citta']);
        $this->cap = strtoupper($data['cap']);
        $this->provincia = strtoupper($data['provincia']);
        $this->nazione = $data['stato'];
        $this->telefono = strtoupper($data['telefono']);
        $this->utente = $data['utente'];
        self::save();
    }

    public function edit($data) {

        $this->cognome = strtoupper($data['cognome']);
        $this->nome = strtoupper($data['nome']);
        //$this->societa = strtoupper($data['societa']);
        $this->indirizzo = strtoupper($data['indirizzo']);
        $this->comune = strtoupper($data['citta']);
        $this->cap = strtoupper($data['cap']);
        $this->provincia = strtoupper($data['provincia']);
        $this->nazione = $data['stato'];
        $this->telefono = strtoupper($data['telefono']);
        $this->save();
    }
    /**
     * set the relationships
     *
     *
     */
    public function utenti()
    {
        return $this->belongsTo('App\Models\Utente','utente');
    }
}
