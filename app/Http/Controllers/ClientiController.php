<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Nazione;

class ClientiController extends Controller
{
    
    protected $cliente;

    protected $nazioni;

    /**
     * The sysdate variable.
     *
     * @var Nazione
     */
    protected $now;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Cliente $cliente, Nazione $nazioni) {
        $this->cliente = $cliente;
        $this->nazioni = $nazioni;
        $this->now = date('Y-m-d');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clienti = $this->cliente->with('utenti.ruoli')->where('cancellato','=',false)->orderby('cognome','asc')->paginate(20);  
        return view('clienti.index',compact('clienti'));
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
        //
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
        $cliente = $this->cliente->with('utenti')->find($id);
        $nazioni = $this->nazioni->where('cancellato','=',false)->where('inizio_validita','<=',$this->now)->where('fine_validita','>=',$this->now)->lists('nazione', 'id')->all();
        return view('clienti.edit', compact('cliente','nazioni'));
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
