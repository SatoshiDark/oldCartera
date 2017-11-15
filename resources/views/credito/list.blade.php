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
        <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Todos los creditos</a></li>
                      <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">En curso</a></li>
                      <li><a href="#tab_3" data-toggle="tab">Finalizados</a></li>
                      {{--<li class="pull-right"><a href="{{url('solicitudes/list')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-plus'></i> Nueva Solicitud</a></li>--}}
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="box-body">
                        <table id="credito_list" class="display" cellspacing="0" width="100%">
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

                                    </div>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        <div class="box-body">
                                        <table id="credito_b_list" class="display" cellspacing="0" width="100%">
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
                                                @if($credito->estado == 0)
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
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_3">
                        <div class="box-body">
                                        <table id="credito_a_list" class="display" cellspacing="0" width="100%">
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
                                                @if($credito->estado==1)
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

@endsection
@push('pagescripts')
<script>
$(document).ready(function() {
    $('#credito_list').DataTable();
    $('#credito_a_list').DataTable();
    $('#credito_b_list').DataTable();
} );
</script>
@endpush