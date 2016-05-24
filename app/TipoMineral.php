<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMineral extends Model
{
    //
    protected $table = 'mineral_produccion';

    protected $fillable = array('nombre', 'tipo');
}
