<?php

namespace App\Http\Controllers;

use App\Credito;
use App\Desembolso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class DesembolsoController extends Controller
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
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'credito_id' => 'required',
            'importe' => 'required',
            'fecha_pago' => 'required',
            'nombre_completo' => 'required',
            'ci' => 'required',
//            'nro_registro' => 'unique:solicitudes|required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        $credito = Credito::findOrFail($input['credito_id']);
        $desembolso = Credito::find($input['credito_id'])->desembolso;
        //        Sum desembolsos
        $sumDesembolsos = 0;
        if (!empty($desembolso)) {
            foreach ($desembolso as $row) {
                $sumDesembolsos = $sumDesembolsos + $row['importe'];
            }
        }
        if ($sumDesembolsos > $credito->importe_credito){
            return back();
        }

        $value = new Desembolso();
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
