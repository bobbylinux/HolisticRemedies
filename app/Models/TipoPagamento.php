<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPagamento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipopagamento';

    /**
     * The array containing the names of database columns that can't be empty on storage
     *
     */
    protected $fillable = array('nomefile', 'didascalia');

    /**
     * The variable for system date time
     *
     */
    protected $now = null;

    /**
     * The relationships
     *
     */
    public function scontiTipoPagamento() {

        return  $this->hasOne('App\Models\ScontiTipoPagamento','pagamento');
    }
}
