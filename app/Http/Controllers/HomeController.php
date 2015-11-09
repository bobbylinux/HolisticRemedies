<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use App\Models\Immagine;
use App\Models\Carrello;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $prodotto;
    protected $immagine;
    protected $carrello;
    protected $utente;
    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Prodotto $prodotto, Immagine $immagine, Carrello $carrello, Guard $auth) {
        $this->prodotto = $prodotto;
        $this->immagine = $immagine;
        $this->carrello = $carrello;
        $this->auth     = $auth;
    }
    /**
     * Show the application home page to the user.
     *
     * @return Response
     */
    public function index()
    {
        $prodotti = $this->prodotto->with('immagini')->orderby('id','asc')->get();
        if ($this->auth->check()) {
            $cookie_test = Cookie::make('cookies_check', '1');
            $carrello = $this->carrello->where('utente','=',$this->auth->user()->id)->with('prodotti')->get();
            $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
            return view('index',compact('prodotti','carrello','cartcount'))->withCookie($cookie_test);
        } else {
            return view('index',compact('prodotti'));
        }
    }

}

