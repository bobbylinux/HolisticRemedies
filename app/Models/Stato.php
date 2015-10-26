<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stato extends BaseModel
{
    protected $table = "stati";

    /*
     *
     * Set the relationships
     *
     */

    public function ordini()
    {
        return $this->belongsToMany('App\Models\OrdineTesta', 'ordini_stato', 'stato', 'ordine')->last();
    }
}
