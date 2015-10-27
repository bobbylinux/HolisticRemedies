<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrello;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Auth\Guard;

class CarrelliController extends Controller
{

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

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator  $auth
     * @return void
     */
    public function __construct(Guard $auth, Carrello $carrello)
    {
        $this->carrello = $carrello;
        $this->auth = $auth;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
        $carrello = $this->carrello->with('prodotti.immagini')->where('utente','=',$this->auth->user()->id)->get();
        return view('carrello.index',compact('carrello','cartcount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'prodotto'  => $request->get('prodotto'),
            'quantita'  => $request->get('quantita'),
            'utente'        => $this->auth->user()->id
        );

        if ($this->carrello->validate($data)) {
            //controllo conflitti nel carrello
            $carrello = $this->carrello;
            if ($carrello->where('prodotto','=',$request->get('prodotto'))->count() > 0) {
                $carrello = $carrello->where('prodotto','=',$request->get('prodotto'))->first();
                $quantita = $carrello->quantita;
                $data['quantita'] += $quantita;
                $this->destroy( $carrello->id );
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
        //
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
        $this->carrello->trash($id);
    }
}
