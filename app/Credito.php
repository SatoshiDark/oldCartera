<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    //
    protected $fillable = array('solicitud_id', 'cooperativa_id', 'codigo_prestamo',
        'estado_prestamo','fecha_desembolso', 'fecha_pago','moneda','plazo','tiempo_gracia',
        'importe_credito','total_mes','tasa','interes','cuota_capital','saldo_capital',
        'suma_total_pagado','ultima_amortizacion');
    /**
     * Get the comments for the blog post.
     */
    public function plan()
    {
        return $this->hasMany('App\PlanCredito');
    }
    public function movimientos()
    {
        return $this->hasMany('App\MovimientoCredito');
    }
    // TODO REMOVE DEPRECATED
    public function amortizacion()
    {
        return $this->hasMany('App\Amortizacion');
    }
    public function desembolso()
    {
        return $this->hasMany('App\Desembolso');
    }
}
