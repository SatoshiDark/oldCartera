@extends('layouts.app')

@section('contentheader_title')
	Cooperativas
@endsection
@section('htmlheader_title')
	Detalle
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Cooperativa</b> {{$cooperativa->nombre}}</h3>
              <div class="box-tools pull-right">
                    <a href="{{route('cooperativas.edit', $cooperativa->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>
                    <a href="{{url('cooperativas')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <h4><b>Nombre:</b> {{$cooperativa->nombre}}</h4>
                <h4><b>Codigo:</b> {{$cooperativa->codigo}}</h4>
                <h4><b>Nro. de Registro:</b> {{$cooperativa->nro_registro}}</h4>
                <h4><b>Derecho Consesionario:</b> {{$cooperativa->derecho_consesionario}}</h4>
                <h4><b>Federacion Afiliada:</b> {{$cooperativa->federacion_afiliada}}</h4>
                <h4><b>C.I. Representante Legal:</b> {{$cooperativa->ci_representante_legal}}</h4>
                <h4><b>Nombre Representante Legal:</b> {{$cooperativa->nombre_representante_legal}}</h4>
                <h4><b>Fecha Formacion:</b> {{$cooperativa->fecha_formacion}}</h4>
                <h4><b>Fecha Resolucion:</b> {{$cooperativa->fecha_resolucion}}</h4>
                <h4><b>Direccion:</b> {{$cooperativa->direccion}}</h4>
                <h4><b>Telefono:</b> {{$cooperativa->telefono}}</h4>
                <h4><b>Fax:</b> {{$cooperativa->fax}}</h4>
                <h4><b>Email:</b> {{$cooperativa->email}}</h4>
                <h4><b>Website:</b> {{$cooperativa->web}}</h4>
                <div class="col-md-6 pull-right">
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['cooperativas.destroy', $cooperativa->id]
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
{{--@push('pagescripts')--}}
{{--<script>--}}
{{--$(document).ready(function() {--}}
    {{--$('#example').DataTable();--}}
{{--} );--}}
{{--</script>--}}
{{--@endpush--}}