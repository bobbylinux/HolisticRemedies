<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use App\Models\ScontoTotaleOrdine as ScontoTotaleOrdine;

class ScontiTotaleOrdineController extends Controller
{
    
    protected $scontoTotaleOrdine;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(ScontoTotaleOrdine $scontoTotaleOrdine) {
        $this->scontoTotaleOrdine = $scontoTotaleOrdine;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scontitotaleordine = $this->scontoTotaleOrdine->where('cancellato', '=', 0)->orderBy('totale_max', 'asc')->paginate(10);/* recupero tutti i prodotti dalla classe modello */
        return view('sconti.totale.index',compact('scontitotaleordine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sconti.totale.create');
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
            'totale_min'  => $request->get('totale_min'),
            'totale_max'  => $request->get('totale_max'),
            'sconto'        => $request->get('sconto')
        );

        if ($this->scontoTotaleOrdine->validate($data)) {
            $this->scontoTotaleOrdine->store($data);
            return Redirect::action('ScontiTotaleOrdineController@index');
        } else {
            $errors = $this->scontoTotaleOrdine->getErrors();
            return Redirect::action('ScontiTotaleOrdineController@create')->withInput()->withErrors($errors);
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
        $scontototaleordine = $this->scontoTotaleOrdine->find($id);
        return view('sconti.totale.edit',compact('scontototaleordine'));
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
            'totale_min'  => $request->get('totale_min'),
            'totale_max'  => $request->get('totale_max'),
            'sconto'        => $request->get('sconto')
        );

        $scontoTotaleOrdine = $this->scontoTotaleOrdine->find($id);

        if ($scontoTotaleOrdine->validate($data)) {
            $scontoTotaleOrdine->edit($data);
            return Redirect::action('ScontiTotaleOrdineController@index');
        } else {
            $errors = $this->scontoTotaleOrdine->getErrors();
            return Redirect::action('ScontiTotaleOrdineController@edit')->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $sconto = $this->scontoTotaleOrdine->find($id);
        $sconto->trash();

        return Response::json(array(
            'code' => '200', //OK
            'msg' => 'OK',
            'id' => $id));
    }
}
