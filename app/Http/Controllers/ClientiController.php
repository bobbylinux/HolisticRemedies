<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cliente;
use App\Models\Carrello;
use App\Models\Nazione;
use App\Models\Utente;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\VarDumper\VarDumper;

class ClientiController extends Controller
{

    protected $cliente;

    protected $nazioni;

    protected $auth;

    protected $carrello;

    protected $utente;
    /**
     * The sysdate variable.
     *
     * @var now
     */
    protected $now;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(Cliente $cliente, Nazione $nazioni, Utente $utente, Guard $auth, Carrello $carrello)
    {
        $this->middleware('admin', ['except' => ['editProfile', 'updateProfile']]);
        $this->carrello = $carrello;
        $this->cliente = $cliente;
        $this->nazioni = $nazioni;
        $this->utente = $utente;
        $this->auth = $auth;
        $this->now = date('Y-m-d');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clienti = $this->cliente->with('utenti.ruoli')->where('cancellato', '=', false)->orderby('data_creazione', 'desc')->paginate(20);
        return view('clienti.index', compact('clienti'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = $this->cliente->with('utenti')->find($id);
        $nazioni = $this->nazioni->where('cancellato', '=', false)->where('inizio_validita', '<=', $this->now)->where('fine_validita', '>=', $this->now)->lists('nazione', 'id')->all();
        return view('clienti.edit', compact('cliente', 'nazioni'));
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
        $data = array(
            'cognome' => $request->get('cognome'),
            'nome' => $request->get('nome'),
            'societa' => $request->get('societa'),
            'indirizzo' => $request->get('indirizzo'),
            'citta' => $request->get('comune'),
            'cap' => $request->get('cap'),
            'provincia' => $request->get('provincia'),
            'stato' => $request->get('nazione'),
            'telefono' => $request->get('telefono'),
            'ruolo' => $request->get('ruolo'),
            'confermato' => $request->get('confermato')
        );

        //validate cliente
        $validatorCliente = $this->cliente->validate($data);
        if ($validatorCliente->fails()) {
            $errors = $validatorCliente->messages();
            return Redirect::action('ClientiController@edit', [$id])->withInput()->withErrors($errors);
        }
        $cliente = $this->cliente->find($id);
        $cliente->edit($data);
        $userId = $cliente->utente;


        $utente = $this->utente->find($userId);
        if ($utente != null) {
            if (isset($data['confermato'])) {
                $utente->confermato = true;
            } else {
                $utente->confermato = false;
            }
            if (isset($data['ruolo'])) {
                $utente->ruolo = 1;
            } else {
                $utente->ruolo = 2;
            }
        }
        
        $utente->save();
        return Redirect::action('ClientiController@index');

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

    public function editProfile()
    {
        $utente = $this->auth->user()->id;
        $cliente = $this->cliente->where('utente', '=', $utente)->first();
        $cartcount = $this->carrello->getCartItemsNumber($this->auth->user()->id);
        $nazioni = $this->nazioni->where('cancellato', '=', false)->where('inizio_validita', '<=', $this->now)->where('fine_validita', '>=', $this->now)->lists('nazione', 'id')->all();
        return view('clienti.profile', compact('cliente', 'nazioni', 'cartcount'));
    }

    public function updateProfile(Request $request)
    {
        //valido l'utente e il cliente
        $data = array(
            'cognome' => $request->get('cognome'),
            'nome' => $request->get('nome'),
            'indirizzo' => $request->get('indirizzo'),
            'citta' => $request->get('citta'),
            'cap' => $request->get('cap'),
            'provincia' => $request->get('provincia'),
            'stato' => $request->get('stato'),
            'telefono' => $request->get('telefono'),
            'username' => $request->get('username'),
            'username_c' => $request->get('username_c'),
        );

        //validate user and cliente
        $username_new = trim(strtolower($data['username']));
        $find = $this->utente->where('id', '=', $this->auth->user()->id)->where('username', '=', $username_new)->count();
        if ($find == 0) {
            $validatorUser = $this->utente->validate($data, $this->utente->editProfileRules);
            $validatorCliente = $this->cliente->validate($data);
            if ($validatorUser->fails() or $validatorCliente->fails()) {
                $errors = array_merge_recursive($validatorUser->messages()->toArray(), $validatorCliente->messages()->toArray());

                return Redirect::action('ClientiController@editProfile')->withInput()->withErrors($errors);
            }
        } else {
            $validatorCliente = $this->cliente->validate($data);
            if ($validatorCliente->fails()) {
                $errors = $validatorCliente->messages();

                return Redirect::action('ClientiController@editProfile')->withInput()->withErrors($errors);
            }
        }

        if ($find == 0) {
            //memorizzo i dati
            $user = $this->utente->find($this->auth->user()->id);
            $user->username = trim(strtolower($data['username']));
            $user->save();
        }

        $data['utente'] = $this->auth->user()->id;
        $cliente = $this->cliente->where('utente', '=', $this->auth->user()->id)->first();
        $cliente->edit($data);
        return redirect('/');
    }

    public function search(Request $request)
    {
        $field = $request->get("field");
        $operator = $request->get("operator");

        if ($operator == "like") {
            $value = "%" . trim($request->get("value")) . "%";
        } else {
            $value = trim($request->get("value"));
        }

        if ($field == "attivo") {
            if (strtolower(trim($request->get("value"))) == "sì" || strtolower(trim($request->get("value"))) == "si" || strtolower(trim($request->get("value"))) == "1" || strtolower(trim($request->get("value"))) == "yes" || strtolower(trim($request->get("value"))) == "true") {
                $value = 1;
            } else
                if (strtolower(trim($request->get("value"))) == "no" || strtolower(trim($request->get("value"))) == "0" || strtolower(trim($request->get("value"))) == "false") {
                    $value = 0;
                }
            $field = "confermato";
            $operator = "=";
        }

        if ($field == "cognome" || $field == "nome") {
            $value = strtoupper($value);
        }

        if ($field == "id") {
            $operator = "=";
            $value = intval($request->get("value"));
        }

        try {
            if ($field == "username" || $field == "confermato") {
                if ($field == "username") {
                    $value = strtolower($value);
                }
                $clienti = $this->cliente->with('utenti.ruoli')->whereHas('utenti', function ($q) use ($field,$operator, $value) {
                    $q->where($field, $operator, $value);

                })->orderby('cognome','asc')->paginate(20);
            } else {
                $clienti = $this->cliente->with('utenti.ruoli')->where($field, $operator, $value)->paginate(20);
            }
            if (count($clienti) == 0) {
                $clienti = $this->cliente->with('utenti.ruoli')->where('cancellato', '=', false)->orderby('cognome', 'asc')->paginate(20);
            }
            return view('clienti.index', compact('clienti'));
        } catch (QueryException $err) {
            $clienti = $this->cliente->with('utenti.ruoli')->where('cancellato', '=', false)->orderby('cognome', 'asc')->paginate(20);
            return view('clienti.index', compact('clienti'));
        }


    }

    public function getNewCustomers()
    {
        $clienti = $this->cliente->with('utenti.ruoli')->where('cancellato', '=', false)->whereHas('utenti', function ($q)  {
            $q->where('confermato', '=', false);
        })->orderby('data_creazione', 'desc')->paginate(20);

        return view('clienti.index', compact('clienti'));
    }

}
