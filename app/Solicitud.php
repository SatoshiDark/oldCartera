<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
    protected $table = 'solicitudes';

    protected $fillable = array('cooperativa_id', 'tipo_credito_id', 'nro_solicitud', 'nombre_proyecto', 'fecha_solicitud',
        'importe_solicitado','importe_propio', 'importe_total','estado','nombre_proyectista','objeto_prestamo','licencia_ambiental','federacion_afiliacion');
}
