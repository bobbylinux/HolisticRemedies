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
        $stato = 2;
        $orders = \DB::select( \DB::raw("select count(1) as new_orders from (select * from ordini_stato where (data_creazione,ordine) in (select max(data_creazione), ordine from ordini_stato group by ordine) order by ordine desc) os where stato ='".$stato."'") );
        $newOrders = $orders[0]->new_orders;
        $users = \DB::table('utenti')
            ->select(\DB::raw('count(1) as new_users'))
            ->where('cancellato', '=', false)
            ->where('confermato', '=', false)
            ->first();
        $newUsers = $users->new_users;
        return view('dash',compact('newOrders','newUsers'));

    }

}