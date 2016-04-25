@extends('layouts.app')

@section('contentheader_title')
	Creditos
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
              <a href="{{url('solicitudes/list')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-plus'></i> Nueva</a>
                {{--<div class="has-feedback">--}}
                  {{--<input type="text" class="form-control input-sm" placeholder="Busqueda...">--}}
                  {{--<span class="glyphicon glyphicon-search form-control-feedback"></span>--}}
                {{--</div>--}}
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
<table id="data_list" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Acciones</th>
                <th>Estado</th>
                <th>Cooperativa</th>
                <th>Codigo</th>
                <th>Saldo Capital</th>
                <th>Plazo</th>
                <th>Tiempo de Gracia</th>
                <th>Interes</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($creditos as $credito)
            <tr>
                <td>
                <div class="btn-group">
                <a href="{{route('credito.show', $credito->id)}}" class="btn btn-primary btn-xs"><i class='fa fa-eye'></i> </a>
                <a href="{{route('credito.edit', $credito->id)}}" class="btn btn-info btn-xs"><i class='fa fa-edit'></i> </a>
                </div>

                </td>
                <td>{{ $credito->estado==0? "En curso":"Completado"  }}</td>
                <td>{{ $cooperativas[$credito->cooperativa_id] }}</td>
                <td>{{ $credito->codigo_prestamo }}</td>
                <td>{{ $credito->saldo_capital}} BOB</td>
                <td>{{ $credito->plazo }} meses</td>
                <td>{{ $credito->tiempo_gracia }} meses</td>
                <td>{{ $credito->interes }} %</td>

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
    $('#data_list').DataTable();
} );
</script>
@endpush