<?php

namespace App\Http\Controllers;

use App\Cooperativa;
use App\TipoMineral;
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
        $minerales = TipoMineral::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        return view('cooperativa.create',['minerales' => $minerales]);
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
        $mineral = TipoMineral::find($cooperativa->mineral_id);
        $cooperativa->mineral= empty($mineral->nombre)? '':$mineral->nombre;
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
        $minerales = TipoMineral::orderBy('created_at', 'asc')->get()->lists('nombre', 'id');
        return view('cooperativa.edit',['minerales' => $minerales])->withCooperativa($cooperativa);
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
