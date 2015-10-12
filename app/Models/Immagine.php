<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Immagine extends BaseModel
{
    protected $table = 'immagini';

    public function prodotto()
    {
        return $this->hasOne('Prodotto','immagine','id');
    }
}
