<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrdineTesta;
use App\Models\Carrello;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Response;

class OrdiniController extends Controller
{

    /**
     * the model instance
     * @var OrdineTesta
     */
    protected $ordine;
    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    protected $carrello;

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator  $auth
     * @return void
     */
    public function __construct(Guard $auth, OrdineTesta $ordine, Carrello $carrello)
    {
        $this->ordine = $ordine;
        $this->auth = $auth;
        $this->carrello = $carrello;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch ($this->auth->user()->ruolo) {
            case 1 : //admin
                $ordini = $this->ordine->orderby('id','desc')->with('utenti.clienti')->with('stati')->paginate(20);
                break;
            case 2 : //user
                $ordini = $this->ordine->where('utente','=',$this->auth->user()->id)->paginate(20);
                break;
        }

        return view('ordini.index',compact('ordini'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->auth->user()->id;

        $count = $this->carrello->where('utente','=',$user)->count();
        if ($count == 0) {
            return Response::json(array(
                'code' => '500', //OK
                'msg' => 'KO',
                'error' => 'No items into cart for user.'));
        }

        $carrello = $this->carrello->where('utente','=',$user)->get();
        $totaleCarrello = number_format($request->cartTotal,2);
        $scontoQuantita = number_format($request->discountUnits,2);
        $scontoPagamento = number_format($request->discountPayment,2);
        $totaleCarrelloScontato = number_format($request->cartTotalDiscounted,2);
        $tipoPagamento = $request->paymentType;
        $sconto = $scontoPagamento+ $scontoQuantita;

        foreach($carrello as $item) {

        }

        return Response::json(array(
            'code' => '200', //OK
            'msg' => 'OK',
            'item' => $tipoPagamento));
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
        //
    }
}
