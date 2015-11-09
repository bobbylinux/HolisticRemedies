<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\Hash as Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Utente extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'utenti';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(
        'username' => 'required|email|unique:utenti,username',
        'username_c' => 'same:username',
        'password' => 'required|min:6',
        'password_c' => 'same:password'
    );

    public $passwordChangeRules = array (
        'email' => 'required|email|exists:utenti,username',
        'password' => 'required|min:6',
        'password_c' => 'same:password'
    );

    /**
     * The variable for validation rules
     *
     */
    protected $errors = "";


    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->username = strtolower($data['username']);
        $this->password = Hash::make($data['password']);
        $this->ruolo = $data['ruolo'];
        $this->confermato = false;
        $this->codice_conferma = $data['codice_conferma'];
        self::save();
    }

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function password($data)
    {
        $this->password = Hash::make($data['password']);
        $this->confermato = false;
        $this->codice_conferma = $data['codice'];
        $this->save();
    }

    /**
     * set the relationships
     *
     *
     */

    public function ruoli()
    {
        return $this->belongsTo('App\Models\Ruolo', 'ruolo');
    }

    /**
     * set the relationships
     *
     *
     */
    public function clienti()
    {
        return $this->hasOne('App\Models\Cliente', 'utente');
    }

}
