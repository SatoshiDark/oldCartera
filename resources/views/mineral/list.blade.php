@extends('layouts.app')

@section('contentheader_title')
	Minerales de Produccion
@endsection
@section('htmlheader_title')
	Lista
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Minerales de produccion</h3>
              <div class="box-tools pull-right">
              <a href="{{url('mineral/create')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-plus'></i> Nueva</a>
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
                <th>Nombre</th>
                <th>Tipo</th>
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
        @foreach ($data as $row)
            <tr>
                <td>
                <div class="btn-group">
                <a href="{{route('mineral.show', $row->id)}}" class="btn btn-primary btn-xs"><i class='fa fa-eye'></i> </a>
                <a href="{{route('mineral.edit', $row->id)}}" class="btn btn-info btn-xs"><i class='fa fa-edit'></i> </a>
                </div>

                </td>
                <td>{{ $row->nombre }}</td>
                <td>{{ $row->tipo }}</td>
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