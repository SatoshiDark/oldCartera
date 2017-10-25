<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanCredito extends Model
{
    //
    protected $table = 'plan_creditos';

    protected $fillable = array('credito_id','periodo_gracia','estado','fecha_pago','cuota_capital','cuota_interes'
        ,'total_cuota','saldo_capital','nota_modificacion');
    protected $dates = ['fecha_pago'];
//    public function setFechaPagoAtrribute($date)
//    {
//        $this->attributes['fecha_pago'] = Carbon::createFromFormat('d-m-Y', $date)->format('d-m-Y');
//    }
    public function amortizacion()
    {
        return $this->hasMany('App\Amortizacion');
    }
    public function movimientos()
    {
        return $this->hasMany('App\MovimientoCredito');
    }
}
