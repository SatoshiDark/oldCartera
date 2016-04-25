<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Cooperativa;
use App\TipoPrestamo;
use App\ResolucionSolicitud;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use App\Http\Requests;

class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cooperativas = Cooperativa::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        $tipo_prestamos = TipoPrestamo::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        $solicitudes = Solicitud::orderBy('created_at', 'asc')->get();

        return view('solicitud.list', [
            'solicitudes' => $solicitudes,
            'tipo_prestamos' => $tipo_prestamos,
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
        $cooperativas = Cooperativa::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        $tipo_prestamos = TipoPrestamo::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');

        return view('solicitud.create',['cooperativas' => $cooperativas, 'tipo_prestamos' => $tipo_prestamos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nro_solicitud' => 'required|max:255',
//            'nro_registro' => 'unique:solicitudes|required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $value = new Solicitud();
        $input = $request->all();
        $value->fill($input);
        $value->estado = 0; //estado 0 = pendiente
        $value->importe_total = $value->importe_propio + $value->importe_solicitado; //estado 0 = pendiente

        $value->save();
        return redirect('/solicitudes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $solicitud = Solicitud::findOrFail($id);
        $tipo_prestamo = TipoPrestamo::findOrFail($solicitud->tipo_credito_id);
        $cooperativa = Cooperativa::findOrFail($solicitud->cooperativa_id);

        $saldo_capital=$solicitud->importe_solicitado;
        $plazo=$tipo_prestamo->tiempo_maximo_pago;
        $gracia=$tipo_prestamo->tiempo_de_gracia;
        $interes_anual=$tipo_prestamo->interes;
        $fecha_ini=$solicitud->fecha_solicitud;

        $detalle_plan = $this->createPlanCredito($saldo_capital,$plazo,$gracia,$interes_anual,$fecha_ini);

        return view('solicitud.show',
            ['cooperativa' => $cooperativa,
                'tipo_prestamo' => $tipo_prestamo,
                'detalle_plan' => $detalle_plan])->withSolicitud($solicitud);
//        return view('solicitud.show',['cooperativas' => $cooperativas, 'tipo_prestamos' => $tipo_prestamos])->withSolicitud($solicitud);
    }


    /**
     * Crea un array con el plan de creditos tentativo
     *
     * @param  double $saldo_capital
     * @param  int $plazo
     * @param  int $gracia
     * @param  int $interes_anual
     * @param  Date $fecha_ini
     * @return array
     */
    public function createPlanCredito ($saldo_capital, $plazo, $gracia, $interes_anual,$fecha_ini){

        $interes_mensual=$interes_anual/12/100;

        $cuota_capital_mes=round($saldo_capital/($plazo-$gracia),2);

        $contador_mes =0;
        $date = date('d-m-Y', strtotime($fecha_ini));
        $detalle_plan=[];
        while ($contador_mes < $plazo)
        {
            $detalle_plan[$contador_mes]['fecha']=$date;

            $date=date('d-m-Y', strtotime($date. ' + 30 days'));

            if($contador_mes<$gracia)
            {
                $detalle_plan[$contador_mes]['periodo_gracia']=0;
                $detalle_plan[$contador_mes]['cuota_mes']=0;
                $cuota_interes=round($saldo_capital*$interes_mensual,2);
                $detalle_plan[$contador_mes]['cuota_interes']=$cuota_interes;
                $cuota_total=0+$cuota_interes;
                $detalle_plan[$contador_mes]['cuota_total']=$cuota_total;
                $detalle_plan[$contador_mes]['saldo_capital']=$saldo_capital;
            }
            else
            {
                $detalle_plan[$contador_mes]['periodo_gracia']=1;
                $detalle_plan[$contador_mes]['cuota_mes']=$cuota_capital_mes;
                $cuota_interes=round($saldo_capital*$interes_mensual,2);
                $detalle_plan[$contador_mes]['cuota_interes']=$cuota_interes;
                $cuota_total=$cuota_capital_mes+$cuota_interes;
                $detalle_plan[$contador_mes]['cuota_total']=$cuota_total;
                $saldo_capital=$saldo_capital-$cuota_capital_mes;
                if($saldo_capital>=0){
                    $detalle_plan[$contador_mes]['saldo_capital']=$saldo_capital;
                }
                else{
                    $detalle_plan[$contador_mes]['saldo_capital']=0;
                }

            }
            $contador_mes=$contador_mes + 1;

        }
        return $detalle_plan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $solicitud = Solicitud::findOrFail($id);
        $cooperativas = Cooperativa::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        $tipo_prestamos = TipoPrestamo::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        return view('solicitud.edit',['cooperativas' => $cooperativas, 'tipo_prestamos' => $tipo_prestamos])->withSolicitud($solicitud);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $solicitud = Solicitud::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nro_solicitud' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        $input = $request->all();
        $solicitud->fill($input);
        $solicitud->importe_total = $solicitud->importe_propio + $solicitud->importe_solicitado; //estado 0 = pendiente
        $solicitud->save();


        return redirect('/solicitudes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function aprobarsolicitud(Request $request)
    {


        return $request;
        //
//        $validator = Validator::make($request->all(), [
//            'nro_solicitud' => 'required|max:255',
////            'nro_registro' => 'unique:solicitudes|required',
//        ]);
//
//        if ($validator->fails()) {
//            return Redirect::back()
//                ->withInput()
//                ->withErrors($validator);
//        }
//
//        $value = new Solicitud();
//        $input = $request->all();
//        $value->fill($input);
//        $value->estado = 0; //estado 0 = pendiente
//        $value->importe_total = $value->importe_propio + $value->importe_solicitado; //estado 0 = pendiente
//
//        $value->save();
//        return redirect('/solicitudes');
    }

}
