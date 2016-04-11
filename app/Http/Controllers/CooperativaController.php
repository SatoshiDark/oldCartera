<?php

namespace App\Http\Controllers;

use App\Cooperativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
//use Validator, Input, Redirect;
use App\Http\Requests;

class CooperativaController extends Controller
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
        $cooperativas = Cooperativa::orderBy('created_at', 'asc')->get();

        return view('cooperativa.list', [
            'cooperativas' => $cooperativas
        ]);
        //return view('cooperativa.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cooperativa.create');
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
            'nombre' => 'required|max:255',
            'nro_registro' => 'unique:cooperativas|required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $cooperativa = new Cooperativa();
        $input = $request->all();
        $cooperativa->fill($input);
        $cooperativa->save();
//        $cooperativa->nombre = $request->nombre;
//        $cooperativa->codigo = $request->codigo;
//        $cooperativa->nro_registro = $request->nro_registro;
//        $cooperativa->derecho_consesionario = $request->derecho_consesionario;
//        $cooperativa->federacion_afiliada = $request->federacion_afiliada;
//        $cooperativa->ci_representante_legal = $request->ci_representante_legal;
//        $cooperativa->nombre_representante_legal = $request->nombre_representante_legal;
//        $cooperativa->fecha_formacion = $request->fecha_formacion;
//        $cooperativa->fecha_resolucion = $request->fecha_resolucion;
//        $cooperativa->direccion = $request->direccion;
//        $cooperativa->telefono = $request->telefono;
//        $cooperativa->fax = $request->fax;
//        $cooperativa->email = $request->email;
//        $cooperativa->web = $request->web;
//        $cooperativa->save();

        return redirect('/cooperativas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cooperativa = Cooperativa::findOrFail($id);
        return view('cooperativa.show')->withCooperativa($cooperativa);
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
        $cooperativa = Cooperativa::findOrFail($id);
        return view('cooperativa.edit')->withCooperativa($cooperativa);
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
        $cooperativa = Cooperativa::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'nro_registro' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        $input = $request->all();
        $cooperativa->fill($input);
        $cooperativa->save();


        return redirect('/cooperativas');
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
