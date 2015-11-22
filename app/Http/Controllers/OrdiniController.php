<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrdineTesta;
use App\Models\Carrello;
use App\Models\Stato;
use App\Models\Utente;
use App\Models\OrdineVettura;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

class OrdiniController extends Controller {

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
    protected $utente;

    /**
     * The cart variable
     *
     * @var Authenticator
     */
    protected $carrello;
    protected $stato;
    protected $vettura;

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator $auth
     * @return void
     */
    public function __construct(Guard $auth, OrdineTesta $ordine, Carrello $carrello, Stato $stato, Utente $utente, OrdineVettura $vettura) {
        $this->middleware('admin', ['only' => ['index', 'update', 'edit', 'destroy']]);
        $this->ordine = $ordine;
        $this->auth = $auth;
        $this->carrello = $carrello;
        $this->stato = $stato;
        $this->utente = $utente;
        $this->vettura = $vettura;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ordini = $this->ordine->where('cancellato', '=', false)->orderby('id', 'desc')->with('utenti.clienti')->with('stati')->paginate(20);
        $stati = $this->stato->get();
        return view('ordini.index', compact('ordini', 'stati'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = $this->auth->user()->id;

        $count = $this->carrello->where('utente', '=', $user)->count();
        if ($count == 0) {
            return Response::json(array(
                        'code' => '500', //OK
                        'msg' => 'KO',
                        'error' => 'No items into cart for user.'));
        }

        $carrello = $this->carrello->with('prodotti')->where('utente', '=', $user)->get();

        $totaleCarrello = number_format(round($request->get('cartTotal'), 2), 2);
        $scontoQuantita = number_format(round($request->get('discountUnits'), 2), 2);
        $scontoPagamento = number_format(round($request->get('discountPayment'), 2), 2);
        $costoSpedizione = number_format(round($request->get('shippingPrice'), 2), 2);
        $totaleCarrelloScontato = number_format(round($request->get('cartTotalDiscounted'), 2), 2);
        $tipoPagamento = $request->paymentType;
        $sconto = number_format(round($scontoPagamento + $scontoQuantita, 2), 2);

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

        $cliente = $this->auth->user()->clienti()->where('utente', '=', $this->auth->user()->id)->first();
        $nome = $cliente->nome . ' ' . $cliente->cognome;
        //ritorno
        $data = array(
            'item_name' => $this->ordine->id,
            'amount' => $totaleCarrelloScontato,
            'return' => url('/admin/ordini/' . $this->ordine->id),
            'name' => $nome,
            'username' => $this->auth->user()->username
        );

        //cancello il carrello dell'utente
        foreach ($carrello as $item) {
            $this->carrello->destroy($item->id);
        }
        //tutto ok ora invio le mail di conferma
        $this->sendMail($this->ordine->id);


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
    public function show($id) {
        $stati = $this->stato->where('cancellato', '=', false)->orderby('id', 'asc')->lists('descrizione', 'id')->all();

        $ordine = $this->ordine->with('prodotti', 'utenti.clienti', 'pagamenti.scontiTipoPagamento', 'stati')->find($id);

        if ($this->auth->check() && ($ordine->utente == $this->auth->user()->id || $this->utente->find($this->auth->user()->id)->ruolo == 1)) {
            $tempTot = $ordine->costo;
            $sconto = $ordine->sconto;
            $speseSpedizione = $ordine->costospedizione;
            $totale = number_format(round($tempTot - $sconto + $speseSpedizione,2), 2);
            $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);

            return view('ordini.show', compact('ordine', 'totale', 'stati', 'cartcount', 'sconto'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $stati = $this->stato->where('cancellato', '=', false)->orderby('id', 'asc')->lists('descrizione', 'id')->all();

        $ordine = $this->ordine->with('prodotti', 'utenti.clienti', 'pagamenti.scontiTipoPagamento', 'stati', 'tracking')->find($id);
        $tempTot = $ordine->costo;
        $sconto = $ordine->sconto;
        $speseSpedizione = $ordine->costospedizione;
        $totale = number_format(round($tempTot - $sconto + $speseSpedizione,2), 2);
        return view('ordini.edit', compact('ordine', 'totale', 'stati', 'sconto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $id = $request->get('ordine');
        $codice = $request->get('vettura');
        $stato = $request->get('stato');

        $stato = $this->stato->find($stato);
        $this->ordine->find($id)->stati()->save($stato);

        $vettura = $this->vettura->where('ordine', '=', $id)->first();

        if ($codice == null || trim($codice) == "") {
            if ($vettura != null) {
                $vettura->trash();
            }
            return Redirect::action('OrdiniController@index');
        }

        $data = array(
            'ordine' => $id,
            'vettura' => $codice
        );

        if ($this->vettura->validate($data)) {
            if ($vettura != null) {
                $vettura->edit($data);
            } else {
                $this->vettura->store($data);
            }
            return Redirect::action('OrdiniController@index');
        } else {
            $errors = $this->vettura->getErrors();
            return Redirect::action('OrdiniController@edit', [$id])->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function esito($id) {
        $stati = $this->stato->where('cancellato', '=', false)->orderby('id', 'asc')->lists('descrizione', 'id')->all();
        $ordine = $this->ordine->with('prodotti', 'utenti.clienti', 'pagamenti.scontiTipoPagamento', 'stati')->find($id);
        if ($this->auth->check() && ($ordine->utente == $this->auth->user()->id || $this->utente->find($this->auth->user()->id)->ruolo == 1)) {
            $tempTot = $ordine->costo;
            $sconto = $ordine->sconto;
            $speseSpedizione = $ordine->costospedizione;
            $totale = number_format(round($tempTot - $sconto + $speseSpedizione,2), 2);
            $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
            return view('ordini.esito', compact('ordine', 'totale', 'stati', 'cartcount', 'sconto'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Get the current user logged Orders
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserOrders() {
        $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
        $ordini = $this->ordine->where('utente', '=', $this->auth->user()->id)->with('stati', 'tracking', 'pagamenti.scontiTipoPagamento')->orderBy('data_creazione', 'desc')->paginate(20);
        return view('ordini.user', compact('ordini', 'cartcount'));
    }

    public function sendMail($id) {

        /* $destinatari = 'info@caisse.it';
          $email = "info@caisse.it";
          $cc_address = "ordini@caisse.it";
          $cc_address2 = "holistic@caisse.it";
          $subject = 'Ordine numero ' . $_SESSION['idordine'] . ' Ricevuto';
          //mando prima una mail a info@caisse.it e poi una al cliente
          $message = $mail; */

        $stati = $this->stato->where('cancellato', '=', false)->orderby('id', 'asc')->lists('descrizione', 'id')->all();
        $ordine = $this->ordine->with('prodotti', 'utenti.clienti', 'pagamenti.scontiTipoPagamento', 'stati')->find($id);
        if ($this->auth->check() && ($ordine->utente == $this->auth->user()->id || $this->utente->find($this->auth->user()->id)->ruolo == 1)) {
            $tempTot = $ordine->costo;
            $sconto = $ordine->sconto;
            $speseSpedizione = $ordine->costospedizione;
            $totale = number_format(round($tempTot - $sconto + $speseSpedizione,2), 2);

            $destination = $this->auth->user()->username;

            Mail::send('email.order', compact('ordine', 'totale', 'stati', 'cartcount', 'sconto'), function($message) use($ordine, $destination) {
                $message->to($destination)
                        ->subject('Conferma Ordine ' . $ordine['id']);
            });

            Mail::send('email.order', compact('ordine', 'totale', 'stati', 'cartcount', 'sconto'), function($message) use($ordine) {
                $message->to('info@caisse.it')->cc('ordini@caisse.it')->cc('holistic@caisse.it')
                        ->subject('Conferma Ordine ' . $ordine['id']);
            });
        } else {
            return Response::json(array(
                        'code' => '401', //OK
                        'msg' => 'KO',
                        'error' => "unauthorized"));
        }
    }

    public function search(Request $request) {
        $field = $request->get("field");
        $operator = $request->get("operator");

        if ($operator == "like") {
            $value = "%" . trim($request->get("value")) . "%";
        } else {
            $value = trim($request->get("value"));
        }

        if ($field == "id" || $field == "ordine") {
            $operator = "=";
            $value = intval($request->get("value"), 0);
        }

        try {
            if ($field == "id" || $field == "cliente") {
                if ($field == "cliente") {
                    $value = strtolower($value);
                    $field = "username";
                }
                $ordini = $this->ordine->with('utenti.clienti')->with('stati')->whereHas('utenti', function ($q) use ($field, $operator, $value) {
                            $q->where($field, $operator, $value);
                        })->orderby('id', 'desc')->paginate(20);
            } else {
                if ($field == "ordine") {
                    $field = "id";
                }
                if ($field == "stato") {
                    $value = intval($request->get("order-status-value"));
                    $operator = "=";
                    $ordini = $this->ordine->with('utenti.clienti')->with('stati')->whereHas('stati', function ($q) use ($field, $operator, $value) {
                                $q->where($field, $operator, $value);
                            })->orderby('id', 'desc')->paginate(20);
                } else {
                    $ordini = $this->ordine->with('utenti.clienti')->with('stati')->where($field, $operator, $value)->orderby('id', 'desc')->paginate(20);
                }
            }
            if (count($ordini) == 0) {
                $ordini = $this->ordine->where('cancellato', '=', false)->with('utenti.clienti')->with('stati')->orderby('id', 'desc')->paginate(20);
            }
            $stati = $this->stato->get();
            return view('ordini.index', compact('ordini', 'stati'));
        } catch (QueryException $err) {
            $ordini = $this->ordine->where('cancellato', '=', false)->orderby('id', 'desc')->with('utenti.clienti')->with('stati')->paginate(20);
            $stati = $this->stato->get();
            return view('ordini.index', compact('ordini', 'stati'));
        }
    }

    public function getNewOrders()
    {
        $stato = 1;
        $orders = \DB::select( \DB::raw("select ordine as id  from (select max(stato) as stato, ordine from ordini_stato group by ordine) os where stato = '$stato'") );
        $orders_id = json_decode(json_encode($orders), true);//Utilities::objectToArray($orders);

        $ordini = $this->ordine->where('cancellato', '=', false)->whereIn('id',$orders_id)->orderby('id', 'desc')->with('utenti.clienti')->with('stati')->paginate(20);
        $stati = $this->stato->get();
        return view('ordini.index', compact('ordini', 'stati'));
        //var_dump($ordini);
    }

}
