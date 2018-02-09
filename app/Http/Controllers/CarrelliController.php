<?php

namespace App\Http\Controllers;

use App\Models\ScontoTipoPagamento;
use App\Models\ScontoTotaleOrdine;
use Illuminate\Http\Request;
use App\Models\Carrello;
use App\Models\ScontoQuantita;
use App\Models\TipoPagamento;
use App\Models\Spedizione;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Auth\Guard;

class CarrelliController extends Controller {

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
    protected $prodotto;
    protected $scontiQuantita;
    protected $scontiTipoPagamento;
    protected $scontiTotaleOrdine;
    protected $tipoPagamento;
    protected $spedizione;
    
    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator $auth
     * @return void
     */
    public function __construct(Guard $auth, Carrello $carrello, ScontoQuantita $scontiQuantita, ScontoTipoPagamento $scontiTipoPagamento, ScontoTotaleOrdine $scontiTotaleOrdine, TipoPagamento $tipoPagamento, Spedizione $spedizione) {
        
        $this->middleware('auth');
        
        $this->carrello = $carrello;
        $this->auth = $auth;
        $this->scontiQuantita = $scontiQuantita;
        $this->scontiTipoPagamento = $scontiTipoPagamento;
        $this->scontiTotaleOrdine = $scontiTotaleOrdine;
        $this->tipoPagamento = $tipoPagamento;
        $this->spedizione = $spedizione;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
        $carrello = $this->carrello->with('prodotti.immagini')->where('utente', '=', $this->auth->user()->id)->orderby('prodotto', 'asc')->get();
        $this->carrello->getTotal($this->auth->user()->id,$this->scontiQuantita, null, $this->scontiTotaleOrdine, 0, $this->spedizione, $carttotaldiscounted, $discountUnits, $discountPayment, $discountTotal, $percentageDiscountTotal, $percentualePagamento, $spedizione,$carttotal, $totale_min);
        $tipopagamento = $this->tipoPagamento->orderby('pagamento','asc')->get();
        //$spedizione = $this->spedizione->get();
        return view('carrello.index', compact('carrello', 'cartcount','discountUnits','discountTotal','carttotaldiscounted','carttotal','tipopagamento','spedizione', 'totale_min', 'percentageDiscountTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = array(
            'prodotto' => intval($request->get('prodotto')),
            'quantita' => intval($request->get('quantita')),
            'utente' => $this->auth->user()->id
        );
        if ($this->carrello->validate($data)) {
            //controllo conflitti nel carrello
            $count = $this->carrello->where('utente','=',$this->auth->user()->id)->where('prodotto', '=', $request->get('prodotto'))->count();
            if ($count > 0) {
                $carrello = $this->carrello->where('utente','=',$this->auth->user()->id)->where('prodotto', '=', $request->get('prodotto'))->first();
                $quantita = $carrello->quantita;
                $data['quantita'] += intval($quantita);
                $this->carrello->trash($carrello->id);
            }

            $this->carrello->store($data);
            //ricavo il numero di oggetti totali nel carrello
            $units = $this->carrello->getCartItemsNumber($this->auth->user()->id);
            return Response::json(array('code' => '200','msg' => 'OK','units' => $units,));
        } else {
            $errors = $this->carrello->getErrors();
            return Response::json(array('code' => '500','msg' => 'KO','errors' => $errors,));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = array(
            "id" => $id,
            "prodotto" => $request->get("prodotto"),
            "quantita" => $request->get("quantita"),
            "utente" => $this->auth->user()->id
        );

        $carrello = $this->carrello->with('prodotti')->find($id);

        if ($this->carrello->validate($data)) {
            $carrello->refresh($data);
            $data['prezzo'] = number_format($carrello->prodotti->prezzo * $carrello->quantita, 2);
            $carrello->getTotal($this->auth->user()->id,$this->scontiQuantita,null,$this->scontiTotaleOrdine,0,$this->spedizione,$data['totaleScontato'],$data['sconto'],$data['scontoPagamento'],$data['scontoTotaleOrdine'],$data['percentualeScontoTotaleOrdine'],$data['percentualePagamento'],$data['spedizione'],$data['totale'],$data['totale_min']);
            $data['items'] = $carrello->getCartItemsNumber($this->auth->user()->id);

            return Response::json(array('code' => '200','msg' => 'OK','item' => $data));
        } else {
            $errors = $carrello->getErrors();
            return Response::json(array('code' => '500','msg' => 'KO','errors' => $errors));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //per sicurezza faccio un controllo id carrello->utente se coincidono 
        $utente = $this->carrello->find($id);
        if (intval($utente->utente) == intval($this->auth->user()->id)) {
            $this->carrello->trash($id);
            //una volta cancellato devo ricalcolare il totale
            $quantita = $this->carrello->getCartItemsNumber($this->auth->user()->id);
            $this->carrello->getTotal($this->auth->user()->id,$this->scontiQuantita, null, $this->scontiTotaleOrdine, 0, $this->spedizione,$totaleScontato,$sconto,$scontoPagamento,$scontoSuTotale,$percentualeScontoSuTotale, $percentualePagamento,$spedizione,$totale, $total_min);

            $data = array(
                'quantita' => $quantita,
                'totale' => $totale,
                'sconto' => $sconto,
                'spedizione' => $spedizione,
                'totaleScontato' => $totaleScontato,
                'totale_min' => $total_min,
                'percentualeScontoTotaleOrdine' => $percentualeScontoSuTotale,
                'scontoTotaleOrdine' => $scontoSuTotale
            );
            return Response::json(array(
                        'code' => '200', //OK
                        'msg' => 'OK',
                        'item' => $data));
        }
        return Response::json(array(
            'code' => '401', //OK
            'msg' => 'KO',
            'error' => $utente->utente));

    }


    public function getTotalWithPaymentDiscount($idPagamento) {
        $quantita = $this->carrello->getCartItemsNumber($this->auth->user()->id);
        $this->carrello->getTotal($this->auth->user()->id,$this->scontiQuantita,$this->scontiTipoPagamento, $this->scontiTotaleOrdine, $idPagamento, $this->spedizione,$totaleScontato,$sconto,$scontoPagamento,$scontoSuTotale,$percentualeScontoSuTotale,$percentualePagamento,$spedizione,$totale, $total_min);

        $formPagamento = $this->tipoPagamento->find($idPagamento)->forms;

        $data = array(
            'quantita' => $quantita,
            'totale' => $totale,
            'sconto' => $sconto,
            'scontoPagamento' => $scontoPagamento,
            'scontoSuTotale' => $scontoSuTotale,
            'percentualeScontoSuTotale' => $percentualeScontoSuTotale,
            'percentualePagamento' => $percentualePagamento,
            'spedizione' => $spedizione,
            'totaleScontato' => $totaleScontato,
            'total_min' => $total_min,
            'formPagamento' => $formPagamento
        );
        return Response::json(array(
            'code' => '200', //OK
            'msg' => 'OK',
            'item' => $data));
    }


}
