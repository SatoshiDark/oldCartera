<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooperativa extends Model
{
    //
    protected $fillable = ['nombre', 'codigo','nro_registro','derecho_consesionario','federacion_afiliada',
        'ci_representante_legal','nombre_representante_legal','cantidad_socios','fecha_formacion','fecha_resolucion','direccion','departamento_id','provincia_id',
        'municipio_id','localidad_id','telefono','fax','casilla_postal','email','web','mineral_id','latitude','longitude'];

}
