<?php   namespace App\Models;

class Cliente extends BaseModel
{
    protected $table = "clienti";
    
    /**
     * set the relationships
     *
     *
     */
    public function utenti()
    {
        return $this->belongsTo('App\Models\Utente','utente');
    }
}
