<?php

namespace App\Http\Controllers;

use App\Credito;
use App\Solicitud;
use App\Cooperativa;
use App\TipoPrestamo;
use App\ResolucionSolicitud;
use App\PlanCredito;
use App\MovimientoCredito;
use App\Amortizacion;
use App\Desembolso;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\Http\Requests;

class CreditoController extends Controller
{

    /**
     * List of to-dos
     * Remap Desembolsos
     * Create new views for amortizaciones
     * Create controller for amortizaciones
     * End a credit
     * Update mainscreen with realdata values
     * Make a report
     * Include delete action on controller
     * Include delete action on view
     *
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cooperativas = Cooperativa::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
//        $tipo_prestamos = TipoPrestamo::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        $creditos = Credito::orderBy('created_at', 'asc')->get();

        return view('credito.list', [
            'creditos' => $creditos,
//            'tipo_prestamos' => $tipo_prestamos,
            'cooperativas' => $cooperativas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'solicitud_id' => 'required',
//            'codigo_prestamo' => 'unique:creditos|required',
            'codigo_prestamo' => 'required',
            'fecha_aprobacion' => 'required',
            'fecha_desembolso' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $id = $request->solicitud_id;
        $solicitud = Solicitud::findOrFail($id);

        // ESTADOS.- 0. pendiente, 1. aprobada, 2.rechazada
        if ($solicitud->estado >= 1) {
            return Redirect::back()
                ->withInput()
                ->withErrors(array("La solicitud ya fue aprobada, contacte al administrador del sistema."));
//            return "Error. La solicitud ya fue aprobada, contacte al administrador del sistema.";
        }


        $tipo_prestamo = TipoPrestamo::findOrFail($solicitud->tipo_credito_id);
        $cooperativa = Cooperativa::findOrFail($solicitud->cooperativa_id);


        $saldo_capital = $solicitud->importe_solicitado;
        $plazo = $tipo_prestamo->tiempo_maximo_pago;
        $gracia = $tipo_prestamo->tiempo_de_gracia;
        $interes_anual = $tipo_prestamo->interes;
        //la fecha de inicio comienza al primer desembolso
        $fecha_ini = $request->fecha_desembolso;

        $detalle_plan = $this->createPlanCredito($saldo_capital, $plazo, $gracia, $interes_anual, $fecha_ini);

        $resolucion = new ResolucionSolicitud();
        $resolucion->fill(array('solicitud_id' => $solicitud->id, 'estado' => 1,
            "fecha_resolucion" => $request->fecha_aprobacion, 'monto_aprobado' => $solicitud->importe_solicitado));

        $resolucion->save();
        $solicitud->estado = 1;
        $solicitud->save();

//      Creando el nuevo credito

        $credito = new Credito();
        $data = ['solicitud_id' => $solicitud->id,
            'cooperativa_id' => $solicitud->cooperativa_id,
            'codigo_prestamo' => $request->codigo_prestamo,
            //Estado del Prestamo: 0. pendiente, 1. Finalizado, 2. Otros
            'estado_prestamo' => 0,
            'fecha_desembolso' => $fecha_ini,
//            'fecha_pago'
            'moneda' => 'Bolivianos',
            'plazo' => $plazo,
            'tiempo_gracia' => $gracia,
            'importe_credito' => $saldo_capital,
            'interes' => $interes_anual,
            'saldo_capital' => $saldo_capital,
            'suma_total_pagado' => 0,

        ];
        $credito->fill($data);
        $credito->save();

//        return $detalle_plan;
        // todo llenando plan de creditos

        foreach ($detalle_plan as $row) {
            $plan_row = new PlanCredito();
            $plan_row->credito_id = $credito->id;
            $plan_row->periodo_gracia = $row['periodo_gracia'];
            $plan_row->fecha_pago = $row['fecha'];
            $plan_row->cuota_capital = $row['cuota_mes'];
            $plan_row->cuota_interes = $row['cuota_interes'];
            $plan_row->total_cuota = $row['cuota_total'];
            $plan_row->saldo_capital = $row['saldo_capital'];
            $plan_row->save();
//            return $plan_row;
        }

        return redirect("/credito/" . $credito->id);
//        return "Solicitud Correctamente Aprobada";
//        $value = new Solicitud();
//        $input = $request->all();
//        $value->fill($input);
    }

//[{"fecha":"02-05-2016","periodo_gracia":0,"cuota_mes":0,"cuota_interes":2500,"cuota_total":2500,"saldo_capital":500000},{"fecha":"01-06-2016","periodo_gracia":0,"cuota_mes":0,"cuota_interes":2500,"cuota_total":2500,"saldo_capital":500000},{"fecha":"01-07-2016","periodo_gracia":0,"cuota_mes":0,"cuota_interes":2500,"cuota_total":2500,"saldo_capital":500000},{"fecha":"31-07-2016","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":2500,"cuota_total":17651.52,"saldo_capital":484848.48},{"fecha":"30-08-2016","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":2424.24,"cuota_total":17575.76,"saldo_capital":469696.96},{"fecha":"29-09-2016","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":2348.48,"cuota_total":17500,"saldo_capital":454545.44},{"fecha":"29-10-2016","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":2272.73,"cuota_total":17424.25,"saldo_capital":439393.92},{"fecha":"28-11-2016","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":2196.97,"cuota_total":17348.49,"saldo_capital":424242.4},{"fecha":"28-12-2016","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":2121.21,"cuota_total":17272.73,"saldo_capital":409090.88},{"fecha":"27-01-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":2045.45,"cuota_total":17196.97,"saldo_capital":393939.36},{"fecha":"26-02-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1969.7,"cuota_total":17121.22,"saldo_capital":378787.84},{"fecha":"28-03-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1893.94,"cuota_total":17045.46,"saldo_capital":363636.32},{"fecha":"27-04-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1818.18,"cuota_total":16969.7,"saldo_capital":348484.8},{"fecha":"27-05-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1742.42,"cuota_total":16893.94,"saldo_capital":333333.28},{"fecha":"26-06-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1666.67,"cuota_total":16818.19,"saldo_capital":318181.76},{"fecha":"26-07-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1590.91,"cuota_total":16742.43,"saldo_capital":303030.24},{"fecha":"25-08-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1515.15,"cuota_total":16666.67,"saldo_capital":287878.72},{"fecha":"24-09-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1439.39,"cuota_total":16590.91,"saldo_capital":272727.2},{"fecha":"24-10-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1363.64,"cuota_total":16515.16,"saldo_capital":257575.68},{"fecha":"23-11-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1287.88,"cuota_total":16439.4,"saldo_capital":242424.16},{"fecha":"23-12-2017","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1212.12,"cuota_total":16363.64,"saldo_capital":227272.64},{"fecha":"22-01-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1136.36,"cuota_total":16287.88,"saldo_capital":212121.12},{"fecha":"21-02-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":1060.61,"cuota_total":16212.13,"saldo_capital":196969.6},{"fecha":"23-03-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":984.85,"cuota_total":16136.37,"saldo_capital":181818.08},{"fecha":"22-04-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":909.09,"cuota_total":16060.61,"saldo_capital":166666.56},{"fecha":"22-05-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":833.33,"cuota_total":15984.85,"saldo_capital":151515.04},{"fecha":"21-06-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":757.58,"cuota_total":15909.1,"saldo_capital":136363.52},{"fecha":"21-07-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":681.82,"cuota_total":15833.34,"saldo_capital":121212},{"fecha":"20-08-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":606.06,"cuota_total":15757.58,"saldo_capital":106060.48},{"fecha":"19-09-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":530.3,"cuota_total":15681.82,"saldo_capital":90908.96},{"fecha":"19-10-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":454.54,"cuota_total":15606.06,"saldo_capital":75757.44},{"fecha":"18-11-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":378.79,"cuota_total":15530.31,"saldo_capital":60605.92},{"fecha":"18-12-2018","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":303.03,"cuota_total":15454.55,"saldo_capital":45454.4},{"fecha":"17-01-2019","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":227.27,"cuota_total":15378.79,"saldo_capital":30302.88},{"fecha":"16-02-2019","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":151.51,"cuota_total":15303.03,"saldo_capital":15151.36},{"fecha":"18-03-2019","periodo_gracia":1,"cuota_mes":15151.52,"cuota_interes":75.76,"cuota_total":15227.28,"saldo_capital":0}]
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $credito = Credito::findOrFail($id);
        $plan = $credito->plan;
        $desembolso = $credito->movimientos()->where('tipo', 0)->get();
        $amortizacion = $credito->movimientos()->where('tipo', 1)->get();
        $cooperativa = Cooperativa::findOrFail($credito->cooperativa_id);
        $solicitud = Solicitud::findOrFail($credito->solicitud_id);
        $sum = array();
//return $solicitud;
//        Sum amortizaciones
        $sumAmortizacion = 0;
        if (!empty($amortizacion)) {
            foreach ($amortizacion as $row) {
                $sumAmortizacion = $sumAmortizacion + $row['importe'];
            }
        }
        $sum['amortizacion'] = $sumAmortizacion;

//        Sum desembolsos
        $sumDesembolsos = 0;
        if (!empty($desembolso)) {
            foreach ($desembolso as $row) {
                $sumDesembolsos = $sumDesembolsos + $row['importe'];
            }
        }
        $sum['desembolso'] = $sumDesembolsos;

//        return $credito;
//        return $plan;


//        $saldo_capital=$solicitud->importe_solicitado;
//        $plazo=$tipo_prestamo->tiempo_maximo_pago;
//        $gracia=$tipo_prestamo->tiempo_de_gracia;
//        $interes_anual=$tipo_prestamo->interes;
//        $fecha_ini=$solicitud->fecha_solicitud;

        return view('credito.show',
            ['cooperativa' => $cooperativa,
                'solicitud' => $solicitud,
                'amortizacion' => $amortizacion,
                'desembolso' => $desembolso,
                'sum' => $sum,
                'detalle_plan' => $plan])->withCredito($credito);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function testPlanCredito()
    {
        // Pruebas Plan
        $monto_prestamo = 800000;
        $interes_anual = 6;
        $plazo = 36;
        $gracia = 3;
        $fecha_ini = "2015-12-29";
        // Nueva Variable: Dia Pago
        $diaPago = 29;
        return $this->createNewPlanCredito($monto_prestamo, $plazo, $gracia, $interes_anual, $fecha_ini, $diaPago);
        $testPlan = new MovimientoCredito(['tipo' => '0']);

        return $testPlan;
    }

    public function createNewPlanCredito($saldo_capital, $plazo, $gracia, $interesAnual, $fecha_ini, $diaPago, $i = 1)
    {
        // Generate Interes
        // Mensual: anual/mesesAño/porcentaje
        $interes_mensual = $interesAnual/12/100;
        // Diario: Mensual/30Dias
        $interesDiario = $interes_mensual/30;

        // Generate Dates TODO Agregar DiaPago
        $start = new DateTime($fecha_ini);
        $year = $start->format('Y');
        $month = $start->format('m');
        $day = $start->format('d');
        $finishDate = new DateTime($fecha_ini);
        $finishDate->setDate($year, $month + $plazo,$diaPago);
        //return $start->format('Y-m-d');
        //return $finishDate->format('Y-m-d');

        // Main loop
        $tempOldDate = new DateTime($fecha_ini);
        $mainPC = [];
        $cuotaCapitalMes = $saldo_capital / ($plazo - $gracia);
        $saldoCapital = $saldo_capital;
        for(; $i<=$plazo; $i++){
            $tempNewDate = new DateTime();
            $tempNewDate->setDate($year,$month+$i,$diaPago);
            $mainPC[$i]['fechaInicio'] = $tempOldDate->format('Y-m-d');
            $mainPC[$i]['fechaPago'] = $tempNewDate->format('Y-m-d');
            $tempDateDiff = date_diff($tempOldDate,$tempNewDate, '%d')->days;
            if($i<=$gracia){
                $mainPC[$i]['capitalAmortizar'] = 0;
            }
            else {
                $mainPC[$i]['capitalAmortizar'] = round($cuotaCapitalMes,2);
            }
            $mainPC[$i]['interesSaldos'] = round($saldoCapital*$interesDiario*$tempDateDiff, 2);
            $saldoCapital -= $mainPC[$i]['capitalAmortizar'];
            $mainPC[$i]['cuotaTotalMes'] = round($mainPC[$i]['capitalAmortizar'] + $mainPC[$i]['interesSaldos'], 2);
            $mainPC[$i]['saldoCapital'] = round($saldoCapital, 2);
            $tempOldDate = new DateTime();
            $tempOldDate->setDate($year,$month+$i,$diaPago);
        }
        return $mainPC;
    }

    public function createPlanCredito($saldo_capital, $plazo, $gracia, $interes_anual, $fecha_ini)
    {

        $interes_mensual = $interes_anual / 12 / 100;

        $cuota_capital_mes = round($saldo_capital / ($plazo - $gracia), 2);

        $contador_mes = 0;
        // Primer Mes diferencia
        $date = date('Y-m-d', strtotime($fecha_ini));
        $date = date('Y-m-d', strtotime($date . ' + 1 month'));
        $detalle_plan = [];
        while ($contador_mes < $plazo) {
            $detalle_plan[$contador_mes]['fecha'] = $date;

            $date = date('Y-m-d', strtotime($date . ' + 30 days'));

            if ($contador_mes < $gracia) {
                $detalle_plan[$contador_mes]['periodo_gracia'] = 0;
                $detalle_plan[$contador_mes]['cuota_mes'] = 0;
                $cuota_interes = round($saldo_capital * $interes_mensual, 2);
                $detalle_plan[$contador_mes]['cuota_interes'] = $cuota_interes;
                $cuota_total = 0 + $cuota_interes;
                $detalle_plan[$contador_mes]['cuota_total'] = $cuota_total;
                $detalle_plan[$contador_mes]['saldo_capital'] = $saldo_capital;
            } else {
                $detalle_plan[$contador_mes]['periodo_gracia'] = 1;
                $detalle_plan[$contador_mes]['cuota_mes'] = $cuota_capital_mes;
                $cuota_interes = round($saldo_capital * $interes_mensual, 2);
                $detalle_plan[$contador_mes]['cuota_interes'] = $cuota_interes;
                $cuota_total = $cuota_capital_mes + $cuota_interes;
                $detalle_plan[$contador_mes]['cuota_total'] = $cuota_total;
                $saldo_capital = $saldo_capital - $cuota_capital_mes;
                if ($saldo_capital >= 0) {
                    $detalle_plan[$contador_mes]['saldo_capital'] = $saldo_capital;
                } else {
                    $detalle_plan[$contador_mes]['saldo_capital'] = 0;
                }

            }
            $contador_mes = $contador_mes + 1;

        }
        return $detalle_plan;
    }
}
