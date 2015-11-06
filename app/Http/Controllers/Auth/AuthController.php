<?php

namespace App\Http\Controllers\Auth;

use App\Models\Nazione;
use App\Models\Cliente;
use App\Models\Utente as User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller {

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
     * The sysdate variable.
     *
     * @var Nazione
     */
    protected $now;

    /**
     * Create a new authentication controller instance.
     *
     * @param  Authenticator  $auth
     * @return void
     */
    public function __construct(Guard $auth, User $user, Nazione $nazione, Cliente $cliente) {
        $this->user = $user;
        $this->auth = $auth;
        $this->nazione = $nazione;
        $this->cliente = $cliente;
        $this->now = date('Y-m-d');
        $this->middleware('guest', ['except' => ['getLogout']]);
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister() {
        $nazioni = $this->nazione->where('inizio_validita','<',$this->now)->where('fine_validita','>',$this->now)->lists('nazione', 'id')->all();
        return view('auth.register',compact("nazioni"));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest  $request
     * @return Response
     */
    public function postRegister(RegisterRequest $request) {
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
            'password_c' => $request->get('password_c')
        );

        //validate user and cliente
        $validatorUser = $this->user->validate($data);
        $validatorCliente = $this->cliente->validate($data);
        if ($validatorUser->fails() or $validatorCliente->fails()) {
            $errors = array_merge_recursive($validatorUser->messages()->toArray(), $validatorCliente->messages()->toArray());
            
            return Redirect::action('Auth\AuthController@getRegister')->withInput()->withErrors($errors);
        }
        //memorizzo i dati
        /*$this->user->username = $request->username;
        $this->user->password = Hash::make($request->getPassword());
        $this->user->save();
        //redirect invio conferma
        $this->auth->login($this->user);*/
        //return redirect('/');
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin() {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest  $request
     * @return Response
     */
    public function postLogin(LoginRequest $request) {

        $user = User::where('username', '=', $request->username)->first();

        if (isset($user)) {
            if ($user->password == md5($request->password)) { // If their password is still MD5
                $user->password = bcrypt($request->password); // Convert to new format
                $user->save();
            }
        }

        if ($this->auth->attempt($request->only('username', 'password'))) {
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
        return redirect('/auth/login')->withErrors([
                    'email' => $this->getFailedLoginMessage()
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout() {
        $this->auth->logout();

        return redirect('/');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage() {
        return Lang::has('auth.failed') ? Lang::get('auth.failed') : 'These credentials do not match our records.';
    }

}
