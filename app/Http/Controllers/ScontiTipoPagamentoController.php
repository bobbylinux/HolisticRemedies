<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ScontoTipoPagamento;
use App\Models\TipoPagamento;
use Illuminate\Support\Facades\Lang;

class ScontiTipoPagamentoController extends Controller
{
    protected $scontoPagamento;

    protected $tipoPagamento;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(ScontoTipoPagamento $scontoPagamento, TipoPagamento $tipoPagamento) {
        $this->scontoPagamento = $scontoPagamento;
        $this->tipoPagamento = $tipoPagamento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scontipagamento = $this->scontoPagamento->with('tipiPagamento')->where('cancellato', '=', false)->orderBy('pagamento', 'asc')->paginate(10);/* recupero tutti i prodotti dalla classe modello */
        return view('sconti.pagamento.index',compact('scontipagamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipopagamento = $this->tipoPagamento->where('cancellato','=',false)->orderBy('pagamento', 'asc')->lists('pagamento', 'id'); //aggiornamento necessario per laravel 5.1
        return view('sconti.pagamento.create',compact('tipopagamento'));
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
            'pagamento'  => $request->get('tipo_pagamento'),
            'sconto'        => $request->get('sconto')
        );

        if ($this->scontoPagamento->validate($data)) {
            $this->scontoPagamento->store($data);
            return Redirect::action('ScontiTipoPagamentoController@index');
        } else {
            $errors = $this->scontoPagamento->getErrors();
            return Redirect::action('ScontiTipoPagamentoController@create')->withInput()->withErrors($errors);
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
        $sconto = $this->scontoPagamento->find($id);
        $tipopagamento = $this->tipoPagamento->where('cancellato','=',false)->orderBy('pagamento', 'asc')->lists('pagamento', 'id'); //aggiornamento necessario per laravel 5.1
        return view('sconti.pagamento.edit',compact('tipopagamento','sconto'));
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
        $data = array(
            'pagamento'  => $request->get('tipo_pagamento'),
            'sconto'        => $request->get('sconto')
        );

        if ($this->scontoPagamento->validate($data)) {
            $sconto = $this->scontoPagamento->find($id);
            $sconto->edit($data);
            return Redirect::action('ScontiTipoPagamentoController@index');
        } else {
            $errors = $this->scontoPagamento->getErrors();
            return Redirect::action('ScontiTipoPagamentoController@edit',[$id])->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $sconto = $this->scontoPagamento->find($id);
        $sconto->trash();

        return Response::json(array(
            'code' => '200', //OK
            'msg' => 'OK',
            'id' => $id));
    }



}
