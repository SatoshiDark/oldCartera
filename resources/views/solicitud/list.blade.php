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
<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Todas las solicitudes</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Pendientes</a></li>
              <li><a href="#tab_3" data-toggle="tab">Aprobadas</a></li>
              <li class="box-tools pull-right"><a href="{{url('solicitudes/create')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-plus'></i> Nueva</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
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
                                                <td>{{ $cooperativas[$solicitud->cooperativa_id] }}</td>
                                                <td>{{ $tipo_prestamos[$solicitud->tipo_credito_id] }}</td>
                                                <td>{{ $solicitud->nro_solicitud }}</td>
                                                <td>{{ $solicitud->nombre_proyecto }}</td>
                                                <td>{{ $solicitud->fecha_solicitud }}</td>
                                                <td>{{ $solicitud->importe_solicitado }}</td>
                                                <td>{{ $solicitud->estado==0? "Pendiente":"Aprobado"  }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                            </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="box-body">
                                <table id="solicitud_b_list" class="display" cellspacing="0" width="100%">
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
                                        @if($solicitud->estado == 0)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('solicitudes.show', $solicitud->id)}}" class="btn btn-primary btn-xs"><i class='fa fa-eye'></i> </a>
                                                    <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-info btn-xs"><i class='fa fa-edit'></i> </a>
                                                </div>

                                            </td>
                                            <td>{{ $cooperativas[$solicitud->cooperativa_id] }}</td>
                                            <td>{{ $tipo_prestamos[$solicitud->tipo_credito_id] }}</td>
                                            <td>{{ $solicitud->nro_solicitud }}</td>
                                            <td>{{ $solicitud->nombre_proyecto }}</td>
                                            <td>{{ $solicitud->fecha_solicitud }}</td>
                                            <td>{{ $solicitud->importe_solicitado }}</td>
                                            <td>{{ $solicitud->estado==0? "Pendiente":"Aprobado"  }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="box-body">
                                <table id="solicitud_a_list" class="display" cellspacing="0" width="100%">
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
                                        @if($solicitud->estado == 1)
                                        <tr>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{route('solicitudes.show', $solicitud->id)}}" class="btn btn-primary btn-xs"><i class='fa fa-eye'></i> </a>
                                                    <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-info btn-xs"><i class='fa fa-edit'></i> </a>
                                                </div>

                                            </td>
                                            <td>{{ $cooperativas[$solicitud->cooperativa_id] }}</td>
                                            <td>{{ $tipo_prestamos[$solicitud->tipo_credito_id] }}</td>
                                            <td>{{ $solicitud->nro_solicitud }}</td>
                                            <td>{{ $solicitud->nombre_proyecto }}</td>
                                            <td>{{ $solicitud->fecha_solicitud }}</td>
                                            <td>{{ $solicitud->importe_solicitado }}</td>
                                            <td>{{ $solicitud->estado==0? "Pendiente":"Aprobado"  }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
</div>
        <div class="col-xs-12">
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>

@endsection
@push('pagescripts')
<script>
$(document).ready(function() {
    $('#solicitud_list').DataTable();
    $('#solicitud_a_list').DataTable();
    $('#solicitud_b_list').DataTable();
} );
</script>
@endpush