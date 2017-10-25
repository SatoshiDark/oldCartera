@extends('layouts.app')

@section('contentheader_title')
	Solicitud
@endsection
@section('htmlheader_title')
	Crear
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Nueva Solicitud</h3>
              <div class="box-tools pull-right">
                            <a href="{{url('solicitudes')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>

                            </div>
            </div><!-- /.box-header -->
            <div class="box-body">
<!-- New Task Form -->
        @include('layouts.partials.errors')
                {!! Form::open(array('url' => 'solicitudes')) !!}
                {!! csrf_field() !!}

            <!-- Nombre -->
                <div class="form-group">
                    {!! Form::label('cooperativa_id', 'Cooperativa:', ['class' => 'control-label']) !!}

                    {!! Form::select('cooperativa_id', $cooperativas, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tipo_credito_id', 'Tipo Creditos:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipo_credito_id', $tipo_prestamos, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('objeto_prestamo', 'Objeto del Prestamo:', ['class' => 'control-label']) !!}
                    {!! Form::select('objeto_prestamo', ['Mineria','Instalacion de planta metalurgica'], ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nro_solicitud', 'Nro. Solicitud:', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_solicitud', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nombre_proyecto', 'DENOMINACIÓN DEL PROYECTO:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre_proyecto', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nombre_proyectista', 'NOMBRE PROYECTISTA:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre_proyectista', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('licencia_ambiental', 'LICENCIA AMBIENTAL:', ['class' => 'control-label']) !!}
                    {!! Form::text('licencia_ambiental', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('federacion_afiliacion', 'FEDERACION AFILIADA:', ['class' => 'control-label']) !!}
                    {!! Form::text('federacion_afiliacion', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                            {!! Form::label('fecha_solicitud', 'Fecha Solicitud:', ['class' => 'control-label']) !!}
                            {!! Form::input('date', 'fecha_solicitud', date('d-m-Y'), ['class' => 'form-control']) !!}
                        </div>
                <div class="form-group">
                    {!! Form::label('importe_solicitado', 'Importe Solicitado:', ['class' => 'control-label']) !!}
                    {!! Form::text('importe_solicitado', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('importe_propio', 'Importe Propio:', ['class' => 'control-label']) !!}
                    {!! Form::text('importe_propio', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('importe_total', 'Importe Total:', ['class' => 'control-label']) !!}
                    {!! Form::text('importe_total', null, ['class' => 'form-control']) !!}
                </div>
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('adjunto', 'Archivo Adjunto:', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::file('adjunto', null, ['class' => 'form-control']) !!}--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('requisitos', 'Requisitos:', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::text('requisitos', null, ['class' => 'form-control']) !!}--}}
                {{--</div>--}}

                {{--array('cooperativa_id', 'tipo_credito_id', 'nro_solicitud', 'nombre_proyecto', 'fecha_solicitud',--}}
                {{--'importe_solicitado','importe_propio', 'importe_total','estado');--}}
            <!-- Add Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Añadir nuevo
                    </button>
                </div>
            </div>

        {!! Form::close() !!}

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