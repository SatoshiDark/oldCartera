@extends('layouts.app')

@section('contentheader_title')
	Cooperativas
@endsection
@section('htmlheader_title')
	Lista
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Cooperativas</h3>
              <div class="box-tools pull-right">
              <a href="{{url('cooperativas/create')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-plus'></i> Nueva</a>
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
                <th>Codigo</th>
                <th>Nro. Registro</th>
                <th>CI representante</th>
                <th>Representante</th>
                <th>Fecha Formacion</th>
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
        @foreach ($cooperativas as $cooperativa)
            <tr>
                <td>
                <div class="btn-group">
                <a href="{{route('cooperativas.show', $cooperativa->id)}}" class="btn btn-primary btn-xs"><i class='fa fa-eye'></i> </a>
                <a href="{{route('cooperativas.edit', $cooperativa->id)}}" class="btn btn-info btn-xs"><i class='fa fa-edit'></i> </a>
                {{--<a href="{{route('cooperativas.show', $cooperativa->id)}}" class="btn btn-warning btn-xs"><i class='fa fa-user'></i> </a>--}}
                                {{--<form action="{{ url('cooperativas/'.$cooperativa->id) }}" method="POST">--}}
                                {{--{!! csrf_field() !!}--}}
                                    {{--{!! method_field('DELETE') !!}--}}

                                    {{--<button type="submit" class="btn btn-danger btn-box-tool">--}}
                                        {{--<i class="fa fa-trash"></i>--}}
                                    {{--</button>--}}
                                {{--</form>--}}
                </div>

                </td>
                <td>{{ $cooperativa->nombre }}</td>
                <td>{{ $cooperativa->codigo }}</td>
                <td>{{ $cooperativa->nro_registro }}</td>
                <td>{{ $cooperativa->ci_representante_legal }}</td>
                <td>{{ $cooperativa->nombre_representante_legal }}</td>
                <td>{{ $cooperativa->fecha_formacion }}</td>
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