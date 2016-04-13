<?php

namespace App\Http\Controllers;

use App\TipoPrestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class TipoPrestamoController extends Controller
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
        $tipo_prestamos = TipoPrestamo::orderBy('created_at', 'asc')->get();

        return view('tipoprestamo.list', [
            'tipoprestamos' => $tipo_prestamos
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
        return view('tipoprestamo.create');
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
            'minimo' => 'required',
            'maximo' => 'required',
            'tiempo_de_gracia' => 'required',
            'tiempo_maximo_pago' => 'required',
            'interes' => 'required',
            'comisiones' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $values = new TipoPrestamo();
        $input = $request->all();
        $values->fill($input);
        $values->save();

        return redirect('/tipoprestamo');
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
        $value = TipoPrestamo::findOrFail($id);
        return view('tipoprestamo.show')->withTipoprestamo($value);
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
        $value = TipoPrestamo::findOrFail($id);
        return view('tipoprestamo.edit')->withTipoprestamo($value);
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
        $value = TipoPrestamo::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'minimo' => 'required',
            'maximo' => 'required',
            'tiempo_de_gracia' => 'required',
            'tiempo_maximo_pago' => 'required',
            'interes' => 'required',
            'comisiones' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        $input = $request->all();
        $value->fill($input);
        $value->save();


        return redirect('/tipoprestamo');
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
