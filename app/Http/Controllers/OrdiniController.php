<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrdineTesta;
use App\Models\Carrello;
use App\Models\Stato;
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

    /**
     * The cart variable
     *
     * @var Authenticator
     */
    protected $carrello;

    protected $stato;


    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator $auth
     * @return void
     */
    public function __construct(Guard $auth, OrdineTesta $ordine, Carrello $carrello, Stato $stato)
    {
        $this->ordine = $ordine;
        $this->auth = $auth;
        $this->carrello = $carrello;
        $this->stato = $stato;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordini = $this->ordine->where('cancellato','=',false)->orderby('id', 'desc')->with('utenti.clienti')->with('stati')->paginate(20);

        return view('ordini.index', compact('ordini'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->auth->user()->id;

        $count = $this->carrello->where('utente', '=', $user)->count();
        if ($count == 0) {
            return Response::json(array(
                'code' => '500', //OK
                'msg' => 'KO',
                'error' => 'No items into cart for user.'));
        }

        $carrello = $this->carrello->with('prodotti')->where('utente', '=', $user)->get();

        $totaleCarrello = number_format($request->get('cartTotal'), 2);
        $scontoQuantita = number_format($request->get('discountUnits'), 2);
        $scontoPagamento = number_format($request->get('discountPayment'), 2);
        $costoSpedizione = number_format($request->get('shippingPrice'), 2);
        $totaleCarrelloScontato = number_format($request->get('cartTotalDiscounted'), 2);
        $tipoPagamento = $request->paymentType;
        $sconto = $scontoPagamento + $scontoQuantita;

        //valido i dati di ingresso per la testata dell'ordine
        $data = array(
            'utente' => $this->auth->user()->id,
            'costo' => $totaleCarrello,
            'costospedizione' => $costoSpedizione,
            'sconto' => $sconto,
            'tipopagamento' => $tipoPagamento
        );
        //validate images
        if (!$this->ordine->validate($data)) {
            $errors = $this->ordine->getErrors();
            return Response::json(array(
                'code' => '500', //OK
                'msg' => 'KO',
                'error' => $errors));
        }
        //salvo la testata
        $this->ordine->store($data);
        //salvo il dettaglio
        foreach ($carrello as $item) {
            $this->ordine->prodotti()->attach($item->prodotto, ['quantita' => $item->quantita, 'costo' => $item->prodotti->prezzo]);
        }
        //salvo lo stato
        $stato = $this->stato->where('descrizione', '=', 'IN ATTESA PAGAMENTO')->first();
        $this->ordine->stati()->attach($stato);

        $cliente = $this->auth->user()->clienti()->where('utente','=',$this->auth->user()->id)->first();
        $nome = $cliente->nome . ' ' . $cliente->cognome;
        //ritorno
        $data = array(
            'item_name' => $this->ordine->id,
            'amount' => $totaleCarrelloScontato,
            'return' => "http://localhost/ordini/" . $this->ordine->id . "/edit",
            'name' => $nome,
            'username' => $this->auth->user()->username
        );

        //cancello il carrello dell'utente
        foreach ($carrello as $item) {
            $this->carrello->destroy($item->id);
        }

        return Response::json(array(
            'code' => '200', //OK
            'msg' => 'OK',
            'item' => $data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stati = $this->stato->where('cancellato','=',false)->orderby('id','asc')->lists('descrizione', 'id')->all();

        $ordine = $this->ordine->with('prodotti','utenti.clienti','pagamenti.scontiTipoPagamento','stati')->find($id);
        $tempTot = $ordine->costo + $ordine->costospedizione - $ordine->sconto;
        $scontoPagamento = $tempTot * ($ordine->pagamenti->scontiTipoPagamento->sconto/100);
        $totale = $tempTot - $scontoPagamento;
        return view('ordini.esito',compact('ordine','totale','stati'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function esito($id)
    {
        return view('ordini.esito');
    }
    /**
     * Get the current user logged Orders
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserOrders()
    {
        $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
        $ordini = $this->ordine->where('utente','=',$this->auth->user()->id)->with('stati','tracking','pagamenti.scontiTipoPagamento')->orderBy('data_creazione','desc')->paginate(20);
        return view('ordini.user',compact('ordini','cartcount'));
    }


}
