<?php

namespace App\Http\Controllers\Auth;

use App\Models\Nazione;
use App\Models\Cliente;
use App\Models\Ruolo;
use App\Models\Utente as User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{

    /**
     * the model instance
     * @var User
     */
    protected $user;

    /**
     * The Guard implementation.
     *
     * @var Authenticator
     */
    protected $auth;

    /**
     * The nazioni model.
     *
     * @var Nazione
     */
    protected $nazione;

    /**
     * The cliente model.
     *
     * @var Nazione
     */
    protected $cliente;

    /**
     * The role id variable
     *
     *
     */
    protected $ruolo;
    /**
     * The sysdate variable.
     *
     * @var Nazione
     */
    protected $now;

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user, Nazione $nazione, Cliente $cliente, Ruolo $ruolo)
    {
        $this->user = $user;
        $this->auth = $auth;
        $this->nazione = $nazione;
        $this->cliente = $cliente;
        $this->ruolo = $ruolo;
        $this->now = date('Y-m-d');
        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister()
    {
        $nazioni = $this->nazione->where('inizio_validita', '<', $this->now)->where('fine_validita', '>', $this->now)->lists('nazione', 'id')->all();
        return view('auth.register', compact("nazioni"));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest $request
     * @return Response
     */
    public function postRegister(RegisterRequest $request)
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
            'password' => $request->get('password'),
            'password_c' => $request->get('password_c'),
            'codice_conferma' => str_random(30),
            'ruolo' => $this->ruolo->where('ruolo','=','user')->first()->id
        );

        //validate user and cliente
        $validatorUser = $this->user->validate($data);
        $validatorCliente = $this->cliente->validate($data);
        if ($validatorUser->fails() or $validatorCliente->fails()) {
            $errors = array_merge_recursive($validatorUser->messages()->toArray(), $validatorCliente->messages()->toArray());
            
            return Redirect::action('Auth\AuthController@getRegister')->withInput()->withErrors($errors);
        }
        //memorizzo i dati

        $this->user->store($data);
        $data['utente'] = $this->user->id;
        $this->cliente->store($data);
        $codice = $data['codice_conferma'];

        $destination = $this->user->username;


        Mail::send('email.verify', compact('codice'), function($message) use($destination) {
            $message->from('info@caisse.it', 'Holistic Remedies');
            $message->to($destination)
                ->subject('Conferma iscrizione');
        });

        if (null != $request->get('confermato')) {
            $data = array(
                'cognome' => $request->get('cognome'),
                'nome' => $request->get('nome'),
                'indirizzo' => $request->get('username')
            );
            $this->cliente->submitNewsLetter($data);
        }

        return redirect('/');
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest $request
     * @return Response
     */
    public function postLogin(LoginRequest $request)
    {

        $user = User::where('username', '=', $request->username)->first();

        if (isset($user)) {
            if ($user->password == md5($request->password)) { // If their password is still MD5
                $user->password = bcrypt($request->password); // Convert to new format
                $user->save();
            }
            if ($user->confermato) {
                $remember = (null !== $request->get("remember-me")) ? true : false;
                if ($this->auth->attempt($request->only('username', 'password'), $remember)) {
                    if ($request->ajax()) {
                        return Response::json(array(
                            'code' => '200', //OK
                            'msg' => 'OK'));
                    } else if ($this->auth->user()->ruolo == 1) {
                        return redirect('admin');

                    } else {
                        return redirect('/');
                    }
                }
            }
        }


        if ($request->ajax()) {
            return Response::json(array(
                'code' => '500', //OK
                'msg' => $this->getFailedLoginMessage()));
        } else {
            return redirect('/auth/login')->withErrors([
                'email' => $this->getFailedLoginMessage()
            ]);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed') ? Lang::get('auth.failed') : 'These credentials do not match our records.';
    }

    /**
     * Confirm the registration procedure through a code control
     *
     * @return \Illuminate\View\View
     *
     */
    public function verifyUser($code)
    {
        if (!$code) {
            $data['errore'] = true;
            $data['titolo'] = Lang::choice("messages.errore", 0);
            $data['conferma'] = Lang::choice('messages.errore_signin', 0);
            return view('auth.confirm', $data);
        }

        $user = $this->user->where('codice_conferma', '=', $code)->first();

        if (!$user) {
            $data['errore'] = true;
            $data['titolo'] = Lang::choice("messages.errore", 0);
            $data['conferma'] = Lang::choice('messages.errore_signin', 0);
            return view('auth.confirm', $data);
        } else {

            $user->confermato = true;
            $user->codice_conferma = null;
            $user->save();
            $data['conferma'] = Lang::choice('messages.conferma_testo', 0);
            $data['errore'] = false;
            $data['titolo'] = Lang::choice('messages.conferma_titolo', 0);
            return view('auth.confirm', $data);
        }
    }

    /**
     * Change your password submit
     *
     * @return \Illuminate\View\View
     *
     */
    public function getPassword()
    {
        return view('auth.password');
    }

    /**
     * Change your password submit
     *
     * @return \Illuminate\View\View
     *
     */
    public function postPassword(Request $request)
    {
        $data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'password_c' => $request->get('password_c')
        );

        //validate user
        $validatorUser = $this->user->validate($data, $this->user->passwordChangeRules);
        if ($validatorUser->fails()) {
            $errors = $this->user->getErrors();
            return Redirect::action('Auth\AuthController@getPassword')->withInput()->withErrors($errors);
        }
        //se validato devo aggiornare il db
        $user = $this->user->where('username', '=', $data['email'])->first();

        $codice = str_random(30);

        $data['codice'] = $codice;

        $user->password($data);

        //invio mail di conferma
        Mail::send('email.password', ['codice' => $codice, 'user' => $user], function ($message) use ($user, $codice) {
            $message->to($user->username, $user->username)
                ->subject('Conferma cambio password');
        });
        //ritorno alla home page
        return redirect('/');
    }
}
