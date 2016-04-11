@extends('layouts.app')

@section('contentheader_title')
	Solicitud
@endsection
@section('htmlheader_title')
	Lista
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Solicitudes</h3>
              <div class="box-tools pull-right">
              <a href="{{url('solicitudes/create')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-plus'></i> Nueva</a>
                {{--<div class="has-feedback">--}}
                  {{--<input type="text" class="form-control input-sm" placeholder="Busqueda...">--}}
                  {{--<span class="glyphicon glyphicon-search form-control-feedback"></span>--}}
                {{--</div>--}}
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
<table id="solicitud_list" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Acciones</th>
                <th>Cooperativa</th>
                <th>Tipo Credito</th>
                <th>Nro. Solicitud</th>
                <th>Proyecto</th>
                <th>Fecha Solicitud</th>
                <th>Importe</th>
                <th>Estado</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($solicitudes as $solicitud)
            <tr>
                <td>
                <div class="btn-group">
                <a href="{{route('solicitudes.show', $solicitud->id)}}" class="btn btn-primary btn-xs"><i class='fa fa-eye'></i> </a>
                <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-info btn-xs"><i class='fa fa-edit'></i> </a>
                </div>

                </td>
                <td>{{ $solicitud->cooperativa_id }}</td>
                <td>{{ $solicitud->tipo_credito_id }}</td>
                <td>{{ $solicitud->nro_solicitud }}</td>
                <td>{{ $solicitud->nombre_proyecto }}</td>
                <td>{{ $solicitud->fecha_solicitud }}</td>
                <td>{{ $solicitud->importe_solicitado }}</td>
                <td>{{ $solicitud->estado }}</td>
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
    $('#solicitud_list').DataTable();
} );
</script>
@endpush