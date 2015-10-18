<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruolo extends Model
{
    protected $table = "ruolo_utenti";

    /** * Get the users for the role. */
    public function utenti()
    {
        return $this->hasMany('App\Models\Utente','ruolo');
    }
}
