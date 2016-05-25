@extends('layouts.app')

@section('contentheader_title')
	Mineral de Produccion
@endsection
@section('htmlheader_title')
	Detalle
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Mineral de produccion</b> {{$tipo_mineral->nombre}}</h3>
              <div class="box-tools pull-right">
                    <a href="{{route('mineral.edit', $tipo_mineral->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>
                    <a href="{{url('mineral')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <h4><b>Nombre:</b> {{$tipo_mineral->nombre}}</h4>
                <h4><b>Tipo:</b> {{$tipo_mineral->tipo}}</h4>
                <div class="col-md-6 pull-right">
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['mineral.destroy', $tipo_mineral->id]
                    ]) !!}
                        {!! Form::submit("Eliminar", ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div>
        <!-- /.col -->
      </div>

@endsection
