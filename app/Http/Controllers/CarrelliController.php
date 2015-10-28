<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrello;
use App\Models\ScontoQuantita;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Auth\Guard;

class CarrelliController extends Controller {

    /**
     * the model instance
     * @var User
     */
    protected $carrello;

    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;
    protected $prodotto;
    protected $scontiQuantita;
    
    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator $auth
     * @return void
     */
    public function __construct(Guard $auth, Carrello $carrello, ScontoQuantita $scontiQuantita) {
        $this->carrello = $carrello;
        $this->auth = $auth;
        $this->scontiQuantita = $scontiQuantita;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
        $carrello = $this->carrello->with('prodotti.immagini')->where('utente', '=', $this->auth->user()->id)->orderby('prodotto', 'asc')->get();
        $carttotal = $this->carrello->getTotal($this->auth->user()->id,$this->scontiQuantita);
        return view('carrello.index', compact('carrello', 'cartcount', 'carttotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = array(
            'prodotto' => $request->get('prodotto'),
            'quantita' => $request->get('quantita'),
            'utente' => $this->auth->user()->id
        );

        if ($this->carrello->validate($data)) {
            //controllo conflitti nel carrello
            $carrello = $this->carrello;
            if ($carrello->where('prodotto', '=', $request->get('prodotto'))->count() > 0) {
                $carrello = $carrello->where('prodotto', '=', $request->get('prodotto'))->first();
                $quantita = $carrello->quantita;
                $data['quantita'] += $quantita;
                $this->carello->trash($carrello->id);
            }

            $this->carrello->store($data);
            //ricavo il numero di oggetti totali nel carrello
            $units = $this->carrello->getCartItemsNumber($this->auth->user()->id);
            return Response::json(array(
                        'code' => '200', //OK
                        'msg' => 'OK',
                        'units' => $units,
            ));
        } else {
            $errors = $this->carrello->getErrors();
            return Response::json(array(
                        'code' => '500', //KO
                        'msg' => 'KO',
                        'errors' => $errors,
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = array(
            "id" => $id,
            "prodotto" => $request->get("prodotto"),
            "quantita" => $request->get("quantita"),
            "utente" => $this->auth->user()->id
        );

        $carrello = $this->carrello->with('prodotti')->find($id);

        if ($this->carrello->validate($data)) {
            $carrello->refresh($data);
            $data['prezzo'] = number_format($carrello->prodotti->prezzo * $carrello->quantita, 2);
            $data['totale'] = $carrello->getTotal($this->auth->user()->id,$this->scontiQuantita);
            $data['items'] = $carrello->getCartItemsNumber($this->auth->user()->id);

            return Response::json(array(
                        'code' => '200', //OK
                        'msg' => 'OK',
                        'item' => $data));
        } else {
            $errors = $carrello->getErrors();
            return Response::json(array(
                        'code' => '500', //OK
                        'msg' => 'KO',
                        'errors' => $errors
            ));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //per sicurezza faccio un controllo id carrello->utente se coincidono 
        $utente = $this->carrello->find($id)->first()->utente;
        if ($utente == $this->auth->user()->id) {
            $this->carrello->trash($id);
            //una volta cancellato devo ricalcolare il totale
            $quantita = $this->carrello->getCartItemsNumber($this->auth->user()->id);
            $totale = $this->carrello->getTotal($this->auth->user()->id,$this->scontiQuantita);
            $data = array(
                'quantita' => $quantita,
                'totale' => $totale
            );
            return Response::json(array(
                        'code' => '200', //OK
                        'msg' => 'OK',
                        'item' => $data));
        }
    }

}
