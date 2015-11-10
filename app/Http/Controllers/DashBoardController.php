<?php namespace App\Http\Controllers;

use App\Models\OrdineTesta;
use App\Models\Utente;

class DashBoardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $ordini;

    protected $utenti;

    public function __construct(OrdineTesta $ordini, Utente $utenti)
    {
        $this->middleware('admin', ['except' => ['getLogout']]);
        $this->ordini = $ordini;
        $this->utenti = $utenti;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $newOrders = $this->ordini->stati()->where('stato','=',1)->count();
        $newUsers = $this->utenti->where('confermato','=',false)->count();
        return view('dash',compact('newOrders','newUsers'));
    }

}