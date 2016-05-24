@extends('layouts.app')

@section('contentheader_title')
	Tipos de Prestamo
@endsection
@section('htmlheader_title')
	Detalle
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Tipo de Prestamo</b> {{$tipoprestamo->nombre}}</h3>
              <div class="box-tools pull-right">
                    <a href="{{route('tipoprestamo.edit', $tipoprestamo->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>
                    <a href="{{url('tipoprestamo')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <h4><b>Nombre:</b> {{$tipoprestamo->nombre}}</h4>
                <h4><b>Monto minimo:</b> {{$tipoprestamo->minimo}}</h4>
                <h4><b>Monto maximo:</b> {{$tipoprestamo->maximo}}</h4>
                <h4><b>Tiempo de gracia:</b> {{$tipoprestamo->tiempo_de_gracia}} meses</h4>
                <h4><b>Tiempo maximo de pago:</b> {{$tipoprestamo->tiempo_maximo_pago}} meses</h4>
                <h4><b>Interes anual:</b> {{$tipoprestamo->interes}} %</h4>
                <h4><b>Comisiones:</b> {{$tipoprestamo->comisiones}} %</h4>
                <div class="col-md-6 pull-right">
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['tipoprestamo.destroy', $tipoprestamo->id]
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