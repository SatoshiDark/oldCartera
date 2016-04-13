<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Cooperativa;
use App\TipoPrestamo;
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
        //
//        $cooperativas = Cooperativa::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
//        $tipo_prestamos = TipoPrestamo::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        $tipo_prestamo = TipoPrestamo::findOrFail($id);
        $cooperativa = Cooperativa::findOrFail($id);
        $solicitud = Solicitud::findOrFail($id);
        return view('solicitud.show',['cooperativa' => $cooperativa, 'tipo_prestamo' => $tipo_prestamo])->withSolicitud($solicitud);
//        return view('solicitud.show',['cooperativas' => $cooperativas, 'tipo_prestamos' => $tipo_prestamos])->withSolicitud($solicitud);
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
}
