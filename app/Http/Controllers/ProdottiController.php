<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Prodotto;
use App\Models\Immagine;

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
        //validate user and cliente
        $validatorImage = $this->immagine->validate($data);
        $validatorProdotto = $this->prodotto->validate($data);
        if ($validatorImage->fails() or $validatorProdotto->fails()) {
            $errors = array_merge_recursive($validatorImage->messages()->toArray(), $validatorProdotto->messages()->toArray());
            
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

        $prodotto = $this->prodotto->find($id);

        if ($request->hasFile('immagine_prodotto')) {
            //validate image and product
            $validatorImage = $this->immagine->validate($data);
            $validatorProdotto = $this->prodotto->validate($data);
            if ($validatorImage->fails() or $validatorProdotto->fails()) {
                $errors = array_merge_recursive($validatorImage->messages()->toArray(), $validatorProdotto->messages()->toArray());

                return Redirect::action('ProdottiController@edit',[$id])->withInput()->withErrors($errors);
            }

            $img_id = $this->immagine->store($data);
            $data['immagine'] = $img_id;
        } else {
            //vuol dire che non è stata aggiunta una nuova foto
            $img_id = $prodotto->immagine;
            $data['immagine'] = $img_id;
            $validatorProdotto = $this->prodotto->validate($data);
            if ($validatorProdotto->fails()) {
                $errors = $this->prodotto->getErrors();

                return Redirect::action('ProdottiController@edit',[$id])->withInput()->withErrors($errors);
            }
        }

        $prodotto->edit($data);

        return Redirect::action('ProdottiController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $prodotto = $this->prodotto->find($id);
        $prodotto->trash();

        $imgId = $prodotto->immagine;
        $immagine = $this->immagine->find($imgId);
        $immagine->trash();

        return Response::json(array(
            'code' => '200', //OK
            'msg' => 'OK',
            'id' => $id));
    }

}
