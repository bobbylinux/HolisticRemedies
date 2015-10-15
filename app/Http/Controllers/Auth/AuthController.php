<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    private $validator_log;

    private $username = 'username';

    public function __construct()
    {

        $this->validator_log = new Logger('Auth Controller Logs');
        $this->validator_log->pushHandler(new StreamHandler(__DIR__.'/../../../storage/logs/auth.log', Logger::DEBUG));
        $this->validator_log->addInfo("Validazione utente Constructor");
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $this->validator_log->addInfo("Validazione utente ". $data['username']);
        return Validator::make($data, [
            'username' => 'required|email|max:255|unique:utenti',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
        Log::debug('Inizio login '. $username);
        if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
            return redirect()->intended('/admin');
        }

        $user = User::where('username', '=', $username)->first();

        if(isset($user)) {
            if($user->password == md5(Input::get('password'))) { // If their password is still MD5
                $user->password = Hash::make(Input::get('password')); // Convert to new format
                $user->save();
                Auth::login(Input::get('username'));
            }
        }


    }
}
