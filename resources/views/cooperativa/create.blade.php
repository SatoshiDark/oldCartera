@extends('layouts.app')

@section('contentheader_title')
	Cooperativas
@endsection
@section('htmlheader_title')
	Crear
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Nueva Cooperativa</h3>
              <div class="box-tools pull-right">
                            <a href="{{url('cooperativas')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>

                            </div>
            </div><!-- /.box-header -->
            <div class="box-body">
<!-- New Task Form -->
        @include('layouts.partials.errors')
        <form action="{{ url('cooperativas') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}

            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre" class="col-sm-3 control-label">Nombre</label>

                <div class="col-sm-6">
                    <input type="text" name="nombre" id="coop-nombre" class="form-control" value="{{ old('nombre') }}">
                </div>
            </div>
            <!-- Codigo -->
            <div class="form-group">
                <label for="codigo" class="col-sm-3 control-label">Codigo</label>

                <div class="col-sm-6">
                    <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}">
                </div>
            </div>
            <!-- Nro de Registro -->
            <div class="form-group">
                <label for="nro_registro" class="col-sm-3 control-label">Nro. de Registro</label>

                <div class="col-sm-6">
                    <input type="text" name="nro_registro" id="coop-registro" class="form-control">
                </div>
            </div>
            <!-- Derecho consesionario -->
            <div class="form-group">
                <label for="derecho_consesionario" class="col-sm-3 control-label">Derecho Consesionario</label>

                <div class="col-sm-6">
                    <input type="text" name="derecho_consesionario" id="coop-derecho_c" class="form-control">
                </div>
            </div>
            <!-- Federacion -->
            <div class="form-group">
                <label for="federacion_afiliada" class="col-sm-3 control-label">Federacion Afiliada</label>

                <div class="col-sm-6">
                    <input type="text" name="federacion_afiliada" id="coop-federacion" class="form-control">
                </div>
            </div>
            <!-- CI -->
            <div class="form-group">
                <label for="ci_representante_legal" class="col-sm-3 control-label">C.I. Representante Legal</label>

                <div class="col-sm-6">
                    <input type="text" name="ci_representante_legal" id="coop-ci" class="form-control">
                </div>
            </div>
            <!-- Nombre RL -->
            <div class="form-group">
                <label for="nombre_representante_legal" class="col-sm-3 control-label">C.I. Representante Legal</label>

                <div class="col-sm-6">
                    <input type="text" name="nombre_representante_legal" id="coop-nombre_rl" class="form-control">
                </div>
            </div>
            <!-- Fecha de Formacion -->
            <div class="form-group">
                <label for="fecha_formacion" class="col-sm-3 control-label">Fecha Formacion</label>

                <div class="col-sm-6">
                    <input type="date" name="fecha_formacion" id="coop-fecha_forma" class="form-control">
                </div>
            </div>
            <!-- Fecha Resolucion -->
            <div class="form-group">
                <label for="fecha_resolucion" class="col-sm-3 control-label">Fecha Resolucion</label>

                <div class="col-sm-6">
                    <input type="date" name="fecha_resolucion" id="coop-fecha_resol" class="form-control">
                </div>
            </div>
            <!-- Direccion -->
            <div class="form-group">
                <label for="direccion" class="col-sm-3 control-label">Direccion</label>

                <div class="col-sm-6">
                    <input type="text" name="direccion" id="coop-direccion" class="form-control">
                </div>
            </div>
            <!-- Telefono -->
            <div class="form-group">
                <label for="telefono" class="col-sm-3 control-label">Telefono</label>

                <div class="col-sm-6">
                    <input type="text" name="telefono" id="coop-telefono" class="form-control">
                </div>
            </div>
            <!-- Fax -->
            <div class="form-group">
                <label for="fax" class="col-sm-3 control-label">Fax</label>

                <div class="col-sm-6">
                    <input type="text" name="fax" id="coop-fax" class="form-control">
                </div>
            </div>

            <!-- eMail -->
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>

                <div class="col-sm-6">
                    <input type="email" name="email" id="coop-email" class="form-control">
                </div>
            </div>

            <!-- Website -->
            <div class="form-group">
                <label for="web" class="col-sm-3 control-label">Website</label>

                <div class="col-sm-6">
                    <input type="text" name="web" id="coop-web" class="form-control">
                </div>
            </div>

            {{--<!-- Nombre -->--}}
            {{--<div class="form-group">--}}
                {{--<label for="nombre" class="col-sm-3 control-label">Nombre</label>--}}

                {{--<div class="col-sm-6">--}}
                    {{--<input type="text" name="nombre" id="coop-nombre" class="form-control">--}}
                {{--</div>--}}
            {{--</div>--}}



            <!-- Add Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Añadir nuevo
                    </button>
                </div>
            </div>
        </form>

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