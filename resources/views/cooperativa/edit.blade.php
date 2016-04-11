@extends('layouts.app')

@section('contentheader_title')
	Cooperativas
@endsection
@section('htmlheader_title')
	Editar
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Cooperativa</h3>
              <div class="box-tools pull-right">
                            <a href="{{url('cooperativas')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>

                            </div>
            </div><!-- /.box-header -->
            <div class="box-body">
<!-- New Task Form -->
        @include('layouts.partials.errors')
        {!! Form::model($cooperativa, array('route' => array('cooperativas.update', $cooperativa->id), 'method' => 'put')) !!}


        <div class="form-group">
            {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('codigo', 'Codigo:', ['class' => 'control-label']) !!}
            {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('nro_registro', 'Nro Registro:', ['class' => 'control-label']) !!}
            {!! Form::text('nro_registro', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('derecho_consesionario', 'Derecho Consesionario:', ['class' => 'control-label']) !!}
            {!! Form::text('derecho_consesionario', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('federacion_afiliada', 'Federacion Afiliada:', ['class' => 'control-label']) !!}
            {!! Form::text('federacion_afiliada', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('ci_representante_legal', 'C.I. Representante legal:', ['class' => 'control-label']) !!}
            {!! Form::text('ci_representante_legal', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nombre_representante_legal', 'Nombre Representante legal:', ['class' => 'control-label']) !!}
            {!! Form::text('nombre_representante_legal', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('fecha_formacion', 'Fecha Formacion:', ['class' => 'control-label']) !!}
            {!! Form::input('date', 'fecha_formacion', date('d-m-Y'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('fecha_resolucion', 'Fecha Resolucion:', ['class' => 'control-label']) !!}
            {!! Form::input('date', 'fecha_resolucion', date('d-m-Y'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('direccion', 'Direccion:', ['class' => 'control-label']) !!}
            {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('telefono', 'Telefono:', ['class' => 'control-label']) !!}
            {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('fax', 'Fax:', ['class' => 'control-label']) !!}
            {!! Form::text('fax', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('web', 'Website:', ['class' => 'control-label']) !!}
            {!! Form::text('web', null, ['class' => 'form-control']) !!}
        </div>



        {!! Form::submit('Actualizar registro', ['class' => 'btn btn-primary']) !!}

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