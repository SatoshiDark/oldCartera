@extends('layouts.app')

@section('contentheader_title')
	Creditos
@endsection
@section('htmlheader_title')
	Detalle
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><b>{{$solicitud->nombre_proyecto}} </b> - {{$credito->codigo_prestamo}}</h3>
                    @if ($credito->estado_prestamo == 0)
                        <small class="label bg-yellow"><i class="fa fa-warning"></i> Credito en Curso</small>
                    @else
                        <small class="label bg-green"><i class="fa fa-check"></i> Credito Terminado</small>
                    @endif
              <div class="box-tools pull-right">

{{--                    <a href="{{route('credito.edit', $credito->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}
                    <a href="{{url('credito')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <h4><b>Nombre Proyecto:</b> {{$solicitud->nombre_proyecto}}</h4>
                <h4><b>Cooperativa:</b> {{$cooperativa->nombre}}</h4>
{{--                <h4><b>Tipo de Prestamo:</b> {{$tipo_prestamo->nombre}}</h4>--}}
                <h4><b>Codigo Prestamo:</b> {{$credito->codigo_prestamo}}</h4>
                <h4><b>Monto Aprobado por el directorio:</b> {{$credito->importe_credito}}</h4>
                <h4><b>Condiciones de Prestamo</b></h4>
                <h4><b>Interes:</b> {{$credito->interes}} %</h4>
                <h4><b>Plazo:</b> {{$credito->plazo}} meses</h4>
                <h4><b>Tiempo de Gracia:</b> {{$credito->tiempo_gracia}} meses</h4>
                <h4></h4>
                <h4><b>Cronograma de desembolso segun proyecto</b></h4>
                @foreach ($desembolso as $detalle)
                    <h4><b>Desembolso: </b>{{ $detalle['fecha_pago'] }}</h4>
                    <h4><b>Importe: </b>{{ $detalle['importe'] }} Bs.</h4>
                @endforeach
                <h4></h4>
                <h4><b>Por Desembolsar:</b> {{$credito->importe_credito - $sum['desembolso']}} Bolivianos</h4>
                <h4><b>Total Desembolsado:</b> {{$sum['desembolso']}} Bolivianos</h4>
                <h4><b>Saldo Capital:</b> {{$credito->importe_credito - $sum['amortizacion']}} Bolivianos</h4>
                <h4><b>Amortización Efectiva:</b> {{$sum['amortizacion']}} Bolivianos</h4>
                <h4><b>Estado:</b> {{ $credito->estado_prestamo==0 ? "En Curso":"Finalizado"  }}</h4>
{{--                <a href="{{route('solicitudes.edit', $credito->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}

            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-xs-12">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <h3 class="box-title"><b>Plan de Creditos Aprobado</b></h3>
                      <div class="box-tools pull-right">
{{--                            <a href="{{route('solicitudes.edit', $credito->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}
                            <a href="{{url('credito')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <h4><b>Capital Otorgado:</b> {{$credito->importe_credito}} Bolivianos</h4>
                        <h4><b>Plazo: </b>{{$credito->plazo}} Meses</h4>
                        <h4><b>Tiempo de Gracia: </b>{{$credito->tiempo_gracia}} Meses</h4>
                        <h4><b>Interes Anual: </b>{{$credito->interes}} %</h4>
                        <h4>-------</h4>

                        <table id="plancreditos" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Cancelado?</th>
                                <th>Periodo Gracia</th>
                                <th>Fecha de Pago</th>
                                <th>Cuota Mes</th>
                                <th>Cuota Interes</th>
                                <th>Cuota Total</th>
                                <th>Saldo Capital</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($detalle_plan as $detalle)
                                <tr>
{{--                                    <td>{{ $detalle['periodo_gracia'] == 0 ? 'Si':'No'}}</td>--}}
                                    <td>
                                        <small class="label bg-yellow">Pendiente</small>
                                        {{--todo Fix si esta cancelado--}}
                                        {{--@if ($detalle['periodo_gracia'] == 0)--}}
                                            {{--<small class="label bg-green">Si</small>--}}
                                        {{--@else--}}
                                            {{--<small class="label bg-yellow">No</small>--}}
                                        {{--@endif--}}
                                    </td>
                                    <td>@if ($detalle['periodo_gracia'] == 0)
                                            <small class="label bg-green">Si</small>
                                        @else
                                            <small class="label bg-yellow">No</small>
                                        @endif
                                    </td>
                                    <td>{{ $detalle['fecha_pago'] }}</td>
                                    <td>{{ $detalle['cuota_capital'] }}</td>
                                    <td>{{ $detalle['cuota_interes'] }}</td>
                                    <td>{{ $detalle['total_cuota'] }}</td>
                                    <td>{{ $detalle['saldo_capital'] }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->

                </div>

    {{--Desembolsos Realizados--}}
    @if (!empty($desembolso))
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Desembolsos Realizados</b></h3>
                <div class="box-tools pull-right">
                    {{--                            <a href="{{route('solicitudes.edit', $credito->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}
                    <a href="{{url('credito')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {{--array('credito_id','estado','fecha_pago','documento','importe','nombre_completo',--}}
                {{--'ci','adjunto','observacion');--}}
                <table id="desembolsos" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Fecha de Pago</th>
                        <th>ID. Documento</th>
                        <th>Importe</th>
                        <th>Nombre</th>
                        <th>CI</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($desembolso as $detalle)
                        <tr>
                            {{--                                    <td>{{ $detalle['periodo_gracia'] == 0 ? 'Si':'No'}}</td>--}}
                            <td>
                                {{--<small class="label bg-yellow">Pendiente</small>--}}
                                {{--todo Fix si esta cancelado--}}
                                @if ($detalle['estado'] == 0)
                                <small class="label bg-green">Desembolsado</small>
                                @else
                                <small class="label bg-yellow">Pendiente</small>
                                @endif
                            </td>
                            <td>{{ $detalle['fecha_pago'] }}</td>
                            <td>{{ $detalle['documento'] }}</td>
                            <td>{{ $detalle['importe'] }}</td>
                            <td>{{ $detalle['nombre_completo'] }}</td>
                            <td>{{ $detalle['ci'] }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div>
    @endif
    {{-- Mostrar si aun no se ha desembolsado todo el monto --}}
    @if ($credito->importe_credito > $sum['desembolso'])
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Realizar Desembolso</b></h3>
                    <div class="box-tools pull-right">
{{--                        <a href="{{route('credito.edit', $credito->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}
                        <a href="{{url('credito')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @include('layouts.partials.errors')
                    {{--array('credito_id','estado','fecha_pago','documento','importe','nombre_completo',--}}
                    {{--'ci','adjunto','observacion');--}}
                    <p>Realiza los desembolsos en este formulario</p>
                    {!! Form::open(array('url' => 'desembolso')) !!}
                    {!! Form::hidden('credito_id', $credito->id) !!}
                    <div class="form-group">
                                        {!! Form::label('codigo_prestamo', 'Codigo Credito:', ['class' => 'control-label']) !!}
                                        {!! Form::text('codigo_prestamo', $credito->codigo_prestamo, ['class' => 'form-control', 'disabled']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('importe', 'Importe:', ['class' => 'control-label']) !!}
                                        {!! Form::text('importe', 0, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fecha_pago', 'Fecha Pago:', ['class' => 'control-label']) !!}
                                        {!! Form::input('date', 'fecha_pago', date('d-m-Y'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('documento', 'Identificador del Documento:', ['class' => 'control-label']) !!}
                                        {!! Form::text('documento', '', ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('nombre_completo', 'Nombre Completo Acreedor:', ['class' => 'control-label']) !!}
                                        {!! Form::text('nombre_completo', '', ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ci', 'C.I. Acreedor:', ['class' => 'control-label']) !!}
                                        {!! Form::text('ci', '', ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('observacion', 'Observaciones:', ['class' => 'control-label']) !!}
                                        {!! Form::text('observacion', '', ['class' => 'form-control']) !!}
                                    </div>

                                <!-- Add Button -->
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus"></i> Agregar Desembolso
                                        </button>
                                    </div>
                                </div>

                            {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>
        @endif

    {{--Amortizaciones Realizadas--}}
    @if (!empty($amortizacion))
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Amortizaciones Realizadas</b></h3>
                    <div class="box-tools pull-right">
                        {{--                            <a href="{{route('solicitudes.edit', $credito->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}
                        <a href="{{url('credito')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    {{--array('credito_id','plan_credito_id','fecha_pago','documento','importe','nombre_depositante',--}}
                    {{--'ci','adjunto','observacion');--}}
                    <table id="amortizacion" class="display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            {{--<th>Plan de credito</th>--}}
                            <th>Fecha de Pago</th>
                            <th>ID. Documento</th>
                            <th>Importe</th>
                            <th>Nombre</th>
                            <th>CI</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($amortizacion as $detalle)
                            <tr>
                                {{--                                    <td>{{ $detalle['periodo_gracia'] == 0 ? 'Si':'No'}}</td>--}}
                                {{--<td>--}}
                                    {{--<small class="label bg-yellow">Pendiente</small>--}}
                                    {{--todo Fix si esta cancelado--}}
                                    {{--@if ($detalle['estado'] == 0)--}}
                                        {{--<small class="label bg-green">Desembolsado</small>--}}
                                    {{--@else--}}
                                        {{--<small class="label bg-yellow">Pendiente</small>--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                <td>{{ $detalle['fecha_pago'] }}</td>
                                <td>{{ $detalle['documento'] }}</td>
                                <td>{{ $detalle['importe'] }}</td>
                                <td>{{ $detalle['nombre_depositante'] }}</td>
                                <td>{{ $detalle['ci'] }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>
    @endif
    {{-- Mostrar si aun no se ha desembolsado todo el monto --}}
    @if ($credito->importe_credito > $sum['amortizacion'])
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Realizar Amortizacion</b></h3>
                    <div class="box-tools pull-right">
                        {{--                        <a href="{{route('credito.edit', $credito->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}
                        <a href="{{url('credito')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @include('layouts.partials.errors')
                    {{--array('credito_id','plan_credito_id','fecha_pago','documento','importe','nombre_depositante',--}}
                    {{--'ci','adjunto','observacion');--}}
                    <p>Realiza las amortizaciones en este formulario</p>
                    {!! Form::open(array('url' => 'amortizacion')) !!}
                    {!! Form::hidden('credito_id', $credito->id) !!}
                    <div class="form-group">
                        {!! Form::label('codigo_prestamo', 'Codigo Credito:', ['class' => 'control-label']) !!}
                        {!! Form::text('codigo_prestamo', $credito->codigo_prestamo, ['class' => 'form-control', 'disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('documento', 'Identificador del Documento:', ['class' => 'control-label']) !!}
                        {!! Form::text('documento', '', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('importe', 'Importe:', ['class' => 'control-label']) !!}
                        {!! Form::text('importe', 0, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_pago', 'Fecha Pago:', ['class' => 'control-label']) !!}
                        {!! Form::input('date', 'fecha_pago', date('d-m-Y'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('nombre_depositante', 'Nombre Completo Depositante:', ['class' => 'control-label']) !!}
                        {!! Form::text('nombre_depositante', '', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('ci', 'C.I. Depositante:', ['class' => 'control-label']) !!}
                        {!! Form::text('ci', '', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('observacion', 'Observaciones:', ['class' => 'control-label']) !!}
                        {!! Form::text('observacion', '', ['class' => 'form-control']) !!}
                    </div>

                    <!-- Add Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Agregar Amortizacion
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>
    @endif

      </div>

@endsection
@push('pagescripts')
<script>
$(document).ready(function() {
    $('#plancreditos').DataTable( {
        "order": [[ 6, "desc" ]]
    } );
    $('#desembolsos').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
    $('#amortizacion').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );
</script>

<script>
    $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
            labels: [@foreach ($detalle_plan as $detalle)
                {{$detalle['cuota_total']}},
                @endforeach
            ],
            datasets: [

                {
                    label: "Cuotas",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [@foreach ($detalle_plan as $detalle)
                        {{$detalle['saldo_capital']}},
                        @endforeach
                    ]
                }
            ]
        };

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            //legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);
    });
</script>
@endpush
