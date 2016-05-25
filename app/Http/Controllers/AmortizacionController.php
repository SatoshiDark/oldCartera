<?php

namespace App\Http\Controllers;

use App\Credito;
use App\Amortizacion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class AmortizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'credito_id' => 'required',
            'importe' => 'required',
            'fecha_pago' => 'required',
            'nombre_depositante' => 'required',
            'ci' => 'required',
//            'nro_registro' => 'unique:solicitudes|required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        $credito = Credito::findOrFail($input['credito_id']);
        $amortizacion = Credito::find($input['credito_id'])->amortizacion;
        //        Sum desembolsos
        $sum = 0;
        if (!empty($amortizacion)) {
            foreach ($amortizacion as $row) {
                $sum = $sum+ $row['importe'];
            }
        }
        if ($sum > $credito->importe_credito){
            return back();
        }

        $value = new Amortizacion();
        $value->fill($input);
        $value->save();
        return back();
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
