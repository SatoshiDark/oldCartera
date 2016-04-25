<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resolucionSolicitud extends Model
{
    //
    protected $table = 'solicitudes_resolucion';

    protected $fillable = array('solicitud_id','estado','fecha_resolucion','monto_aprobado');
}
