<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Cooperativa;
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
        $solicitudes = Solicitud::orderBy('created_at', 'asc')->get();

        return view('solicitud.list', [
            'solicitudes' => $solicitudes
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
        $cooperativas = Cooperativa::orderBy('created_at', 'asc')->get();
        return view('solicitud.create',['cooperativas' => $cooperativas]);
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

        $cooperativa = new Solicitud();
        $input = $request->all();
        $cooperativa->fill($input);
        $cooperativa->save();
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
        $solicitud = Solicitud::findOrFail($id);
        return view('solicitud.show')->withSolicitud($solicitud);
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
        return view('solicitud.edit')->withSolicitud($solicitud);
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
