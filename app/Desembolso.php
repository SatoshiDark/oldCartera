<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desembolso extends Model
{
    //
    protected $fillable = array('credito_id','estado','fecha_pago','documento','importe','nombre_completo',
        'ci','adjunto','observacion');
}
