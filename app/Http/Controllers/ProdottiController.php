<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect as Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Prodotto as Prodotto;
use App\Models\Immagine as Immagine;

class ProdottiController extends Controller
{

    protected $prodotto;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Prodotto $prodotto, Immagine $immagine) {
        $this->prodotto = $prodotto;
        $this->prodotto->immagine = $immagine;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodotti = $this->prodotto->where('cancellato', '=', 0)->orderBy('prodotto', 'asc')->paginate(10);/* recupero tutti i prodotti dalla classe modello */
        return view('prodotti.index',compact('prodotti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prodotti.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'prodotto' => $request->get('titolo_prodotto'),
            'descrizione' => $request->get('descrizione_prodotto'),
            'immagine' => $request->file('immagine_prodotto'),
            'prezzo' => $request->get('prezzo_prodotto'),
        );

        if ($this->prodotto->validate($data)) {
            $this->prodotto->store($data);
            return Redirect::action('ProdottiController@index');
        } else {
            $errors = $this->prodotto->getErrors();
            return Redirect::action('ProdottiController@create')->withInput()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prodotto = $this->prodotto->find($id);
        return view('prodotti.edit',compact('prodotto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
