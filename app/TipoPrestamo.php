<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPrestamo extends Model
{
    //
    protected $table = 'tipo_prestamo';

    protected $fillable = array('nombre', 'minimo', 'maximo', 'tiempo_de_gracia', 'tiempo_maximo_pago',
        'interes','comisiones');
}
