<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ScontoQuantita as ScontoQuantita;

class ScontiQuantitaController extends Controller
{
    
    protected $scontoQuantita;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(ScontoQuantita $scontoQuantita) {
        $this->scontoQuantita = $scontoQuantita;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scontiquantita = $this->scontoQuantita->where('cancellato', '=', 0)->orderBy('quantita_min', 'asc')->paginate(10);/* recupero tutti i prodotti dalla classe modello */
        return view('sconti.quantita.index',compact('scontiquantita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sconti.quantita.create');
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
            'quantita_min'  => $request->get('quantita_min'),
            'quantita_max'  => $request->get('quantita_max'),
            'sconto'        => $request->get('sconto')
        );

        if ($this->scontoQuantita->validate($data)) {
            $this->scontoQuantita->store($data);
            return Redirect::action('ScontiQuantitaController@index');
        } else {
            $errors = $this->scontoQuantita->getErrors();
            return Redirect::action('ScontiQuantitaController@create')->withInput()->withErrors($errors);
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
        $scontoquantita = $this->scontoQuantita->find($id);
        return view('sconti.quantita.edit',compact('scontoquantita'));
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
            'quantita_min'  => $request->get('quantita_min'),
            'quantita_max'  => $request->get('quantita_max'),
            'sconto'        => $request->get('sconto')
        );

        $scontoQuantita = $this->scontoQuantita->find($id);

        if ($scontoQuantita->validate($data)) {
            $scontoQuantita->edit($data);
            return Redirect::action('ScontiQuantitaController@index');
        } else {
            $errors = $this->scontoQuantita->getErrors();
            return Redirect::action('ScontiQuantitaController@edit')->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $sconto = $this->scontoQuantita->find($id);
        $sconto->trash();

        return Response::json(array(
            'code' => '200', //OK
            'msg' => 'OK',
            'id' => $id));
    }
}
