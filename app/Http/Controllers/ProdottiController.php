<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Prodotto as Prodotto;
use App\Models\Immagine as Immagine;

class ProdottiController extends Controller {

    protected $prodotto;
    protected $immagine;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Prodotto $prodotto, Immagine $immagine) {
        $this->prodotto = $prodotto;
        $this->immagine = $immagine;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $prodotti = $this->prodotto->where('cancellato', '=', false)->orderBy('prodotto', 'asc')->paginate(10); /* recupero tutti i prodotti dalla classe modello */
        return view('prodotti.index', compact('prodotti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('prodotti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = array(
            'prodotto' => $request->get('titolo_prodotto'),
            'descrizione' => $request->get('descrizione_prodotto'),
            'immagine' => $request->file('immagine_prodotto'),
            'prezzo' => $request->get('prezzo_prodotto'),
            'didascalia' => $request->get('titolo_prodotto')
        );
        //validate images
        if (!$this->immagine->validate($data)) {
            $errors = $this->immagine->getErrors();
            return Redirect::action('ProdottiController@create')->withInput()->withErrors($errors);
        }
        //validates products
        if (!$this->prodotto->validate($data)) {
            $errors = $this->prodotto->getErrors();
            return Redirect::action('ProdottiController@create')->withInput()->withErrors($errors);
        }

        $img_id = $this->immagine->store($data);
        $data['immagine'] = $img_id;
        $this->prodotto->store($data);

        return Redirect::action('ProdottiController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $prodotto = $this->prodotto->find($id);
        $immagine = $this->immagine->find($prodotto->immagine);
        return view('prodotti.edit', compact('prodotto', 'immagine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = array(
            'prodotto' => $request->get('titolo_prodotto'),
            'descrizione' => $request->get('descrizione_prodotto'),
            'immagine' => $request->file('immagine_prodotto'),
            'prezzo' => $request->get('prezzo_prodotto'),
            'didascalia' => $request->get('titolo_prodotto')
        );
        //validate images
        if (null !== $request->file('immagine_prodotto')) {
            if (!$this->immagine->validate($data)) {
                $errors = $this->prodotto->getErrors();
                return Redirect::action('ProdottiController@create')->withInput()->withErrors($errors);
            }
        }
        //validates products
        if (!$this->prodotto->validate($data)) {
            $errors = $this->prodotto->getErrors();
            return Redirect::action('ProdottiController@create')->withInput()->withErrors($errors);
        }
        
        if (null !==$request->file('immagine_prodotto')) {
            $img_id = $this->immagine->store($data);
        }
        $data['immagine'] = $img_id;
        $this->prodotto->store($data);

        return Redirect::action('ProdottiController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
