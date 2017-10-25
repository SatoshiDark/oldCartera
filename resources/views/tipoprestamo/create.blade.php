@extends('layouts.app')

@section('contentheader_title')
	Modalidades de Préstamo
@endsection
@section('htmlheader_title')
	Crear
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Nueva Modalidad de Préstamo</h3>
              <div class="box-tools pull-right">
                            <a href="{{url('tipoprestamo')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>

                            </div>
            </div><!-- /.box-header -->
            <div class="box-body">
<!-- New Task Form -->
        @include('layouts.partials.errors')
        {!! Form::open(array('url' => 'tipoprestamo')) !!}
        {!! csrf_field() !!}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('minimo', 'Monto Mínimo de Préstamo:', ['class' => 'control-label']) !!}
                    {!! Form::number('minimo', null, ['class' => 'form-control','step' => '0.1']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('maximo', 'Monto Máximo de Préstamo:', ['class' => 'control-label']) !!}
                    {!! Form::number('maximo', null, ['class' => 'form-control','step' => '0.1']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tiempo_de_gracia', 'Tiempo de grácia (expresado en meses):', ['class' => 'control-label']) !!}
                    {!! Form::number('tiempo_de_gracia', 1, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tiempo_maximo_pago', 'Tiempo maximo de pago (expresado en meses):', ['class' => 'control-label']) !!}
                    {!! Form::number('tiempo_maximo_pago', 1, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('interes', 'Interes (en % Anual):', ['class' => 'control-label']) !!}
                    {!! Form::number('interes', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('comisiones', 'Comisiones (en % Anual):', ['class' => 'control-label']) !!}
                    {!! Form::number('comisiones', null, ['class' => 'form-control']) !!}
                </div>


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