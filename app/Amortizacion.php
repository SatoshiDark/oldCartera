<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amortizacion extends Model
{
    //
    protected $table = 'amortizaciones';
    protected $fillable = array('credito_id','plan_credito_id','fecha_pago','documento','importe','tre',
        'interes_corriente','capital','nombre_depositante','ci','adjunto','observacion');
}