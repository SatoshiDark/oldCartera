@extends('layouts.app')

@section('contentheader_title')
	Modalidades de Préstamo
@endsection
@section('htmlheader_title')
	Lista
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Modalidades de Préstamo</h3>
              <div class="box-tools pull-right">
              <a href="{{url('tipoprestamo/create')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-plus'></i> Nueva</a>
                {{--<div class="has-feedback">--}}
                  {{--<input type="text" class="form-control input-sm" placeholder="Busqueda...">--}}
                  {{--<span class="glyphicon glyphicon-search form-control-feedback"></span>--}}
                {{--</div>--}}
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
<table id="cooperativa_list" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Acciones</th>
                <th>Nombre</th>
                <th>Minimo</th>
                <th>Maximo</th>
                <th>Tiempo de Gracia</th>
                <th>Tiempo Maximo de Pago</th>
                <th>Interes Anual</th>
                <th>Comisiones</th>
            </tr>
        </thead>
        {{--<tfoot>--}}
            {{--<tr>--}}
                            {{--<th>Acciones</th>--}}
                            {{--<th>Nombre</th>--}}
                            {{--<th>Codigo</th>--}}
                            {{--<th>Nro. Registro</th>--}}
                            {{--<th>CI representante</th>--}}
                            {{--<th>Nro. Socios</th>--}}
                            {{--<th>Fecha Formacion</th>--}}
                        {{--</tr>--}}
        {{--</tfoot>--}}
        <tbody>
        @foreach ($tipoprestamos as $tipoprestamo)
            <tr>
                <td>
                <div class="btn-group">
                <a href="{{route('tipoprestamo.show', $tipoprestamo->id)}}" class="btn btn-primary btn-xs"><i class='fa fa-eye'></i> </a>
                <a href="{{route('tipoprestamo.edit', $tipoprestamo->id)}}" class="btn btn-info btn-xs"><i class='fa fa-edit'></i> </a>
                </div>

                </td>
                <td>{{ $tipoprestamo->nombre }}</td>
                <td>{{ $tipoprestamo->minimo }} Bs.</td>
                <td>{{ $tipoprestamo->maximo }} Bs.</td>
                <td>{{ $tipoprestamo->tiempo_de_gracia }} meses</td>
                <td>{{ $tipoprestamo->tiempo_maximo_pago }} meses</td>
                <td>{{ $tipoprestamo->interes }} %</td>
                <td>{{ $tipoprestamo->comisiones }} %</td>
            </tr>
        @endforeach
        </tbody>
    </table>

            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div>
        <!-- /.col -->
      </div>

@endsection
@push('pagescripts')
<script>
$(document).ready(function() {
    $('#cooperativa_list').DataTable();
} );
</script>
@endpush