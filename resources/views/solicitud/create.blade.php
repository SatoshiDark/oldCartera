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
                    {!! Form::select('cooperativa_id', $cooperativas)) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tipo_credito_id', 'Tipo Creditos:', ['class' => 'control-label']) !!}
                    {!! Form::select('tipo_credito_id', $tipo_creditos)) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('cooperativa_id', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('cooperativa_id', null, ['class' => 'form-control']) !!}
                </div>
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