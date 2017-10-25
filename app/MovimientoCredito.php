<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoCredito extends Model
{
    //
    protected $table = 'movimiento_creditos';

    protected $fillable = array('credito_id', 'plan_credito_id', 'tipo', 'fecha_pago', 'mov_documento', 'mora'
    , 'interes', 'capital_pagado', 'monto_cancelado','saldo_capital', 'saldo_capital_plan_pagos', 'saldo_total_cartera'
    , 'dif_capital_mora', 'dif_capital_interes', 'descripcion');
    protected $dates = ['fecha_pago'];
}
