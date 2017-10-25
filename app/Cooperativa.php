<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cooperativa extends Model
{
    //
    protected $fillable = ['nombre', 'codigo', 'nro_registro', 'derecho_consesionario', 'federacion_afiliada',
        'ci_representante_legal', 'nombre_representante_legal', 'cantidad_socios', 'fecha_formacion', 'fecha_resolucion', 'direccion', 'departamento_id', 'provincia_id',
        'municipio_id', 'localidad_id', 'telefono', 'fax', 'casilla_postal', 'email', 'web', 'mineral_id', 'latitude', 'longitude', 'personeria_juridica', 'coordinadas_utm', 'produccion_anual'];

    public function getFechaFormacionAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getFechaResolucionAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
