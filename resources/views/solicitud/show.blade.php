@extends('layouts.app')

@section('contentheader_title')
	Solicitudes
@endsection
@section('htmlheader_title')
	Detalle
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Solicitud: </b>{{$solicitud->nro_solicitud}} - {{$solicitud->nombre_proyecto}}    </h3>
                    @if ($solicitud['estado'] == 0)
                        <small class="label bg-yellow"><i class="fa fa-warning"></i> Solicitud Pendiente</small>
                    @else
                        <small class="label bg-green"><i class="fa fa-check"></i> Solicitud Aprobada</small>
                    @endif
              <div class="box-tools pull-right">

                    <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>
                    <a href="{{url('solicitudes')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <h4><b>Nombre:</b> {{$solicitud->nombre_proyecto}}</h4>
                <h4><b>Cooperativa:</b> {{$cooperativa->nombre}}</h4>
                <h4><b>Tipo de Prestamo:</b> {{$tipo_prestamo->nombre}}</h4>
                <h4><b>Nro Solicitud:</b> {{$solicitud->nro_solicitud}}</h4>
                <h4><b>Nombre Proyecto:</b> {{$solicitud->nombre_proyecto}}</h4>
                <h4><b>Fecha de la Solicitud:</b> {{$solicitud->fecha_solicitud}}</h4>
                <h4><b>Importe Solicitado:</b> {{$solicitud->importe_solicitado}}</h4>
                <h4><b>Importe Propio:</b> {{$solicitud->importe_propio}}</h4>
                <h4><b>Importe Total:</b> {{$solicitud->importe_total}}</h4>
                <h4><b>Estado:</b> {{ $solicitud->estado==0 ? "Pendiente":"Aprobado"  }}</h4>

{{--                <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}

                <div class="col-md-6 pull-right">
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['cooperativas.destroy', $solicitud->id]
                    ]) !!}
                        {!! Form::submit("Eliminar", ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-xs-12">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <h3 class="box-title"><b>Plan de Creditos Tentativo</b></h3>
                      <div class="box-tools pull-right">
{{--                            <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>--}}
                            <a href="{{url('solicitudes')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <h4><b>Saldo Capital:</b> {{$solicitud->importe_solicitado}}</h4>
                        <h4><b>Capital prestado:</b> {{$solicitud->importe_solicitado}}</h4>
                        <h4><b>Plazo: </b>{{$tipo_prestamo->tiempo_maximo_pago}} Meses</h4>
                        <h4><b>Tiempo de Gracia: </b>{{$tipo_prestamo->tiempo_de_gracia}} Meses</h4>
                        <h4><b>Interes Anual: </b>{{$tipo_prestamo->interes}} %</h4>
                        <h4><b>Interes Mensual: </b>{{$tipo_prestamo->interes}} %</h4>
                        <h4>-------</h4>

                        <table id="plancreditos" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
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
                                    <td>@if ($detalle['periodo_gracia'] == 0)
                                            <small class="label bg-green">Si</small>
                                        @else
                                            <small class="label bg-yellow">No</small>
                                        @endif
                                    </td>
                                    <td>{{ $detalle['fecha'] }}</td>
                                    <td>{{ $detalle['cuota_mes'] }}</td>
                                    <td>{{ $detalle['cuota_interes'] }}</td>
                                    <td>{{ $detalle['cuota_total'] }}</td>
                                    <td>{{ $detalle['saldo_capital'] }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->

                </div>
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Grafica de Cuotas</b></h3>
                <div class="box-tools pull-right">
                    <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>
                    <a href="{{url('solicitudes')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="chart">
                    <canvas id="areaChart" style="height: 249px; width: 555px;" width="555" height="249"></canvas>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div>
    {{-- Mostrar si la solicitud no esta Aprobada --}}
    @if ($solicitud['estado'] == 0)
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Aprobar solicitud</b></h3>
                    <div class="box-tools pull-right">
                        <a href="{{route('solicitudes.edit', $solicitud->id)}}" class="btn btn-sm btn-primary btn-flat pull-left"><i class='fa fa-edit'></i> </a>
                        <a href="{{url('solicitudes')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                @include('layouts.partials.errors')
                    <p>Los datos introducidos en esta solicitud se aprobaran, para realizar cambios edite la solicitud</p>
                    {!! Form::open(array('url' => 'credito')) !!}
                    {!! Form::hidden('solicitud_id', $solicitud->id) !!}
                    <div class="form-group">
                                        {!! Form::label('nro_solicitud', 'Nro. Solicitud:', ['class' => 'control-label']) !!}
                                        {!! Form::text('nro_solicitud', $solicitud->nro_solicitud, ['class' => 'form-control', 'disabled']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('codigo_prestamo', 'Codigo Credito:', ['class' => 'control-label']) !!}
                                        {!! Form::text('codigo_prestamo', $solicitud->nro_solicitud, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fecha_aprobacion', 'Fecha Aprobación:', ['class' => 'control-label']) !!}
                                        {!! Form::input('date', 'fecha_aprobacion', date('d-m-Y'), ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fecha_desembolso', 'Fecha Primer Desembolso:', ['class' => 'control-label']) !!}
                                        <p>La fecha del primer desembolso indica desde donde empezara a generarse el plan de pagos</p>
                                        {!! Form::input('date', 'fecha_desembolso', date('d-m-Y'), ['class' => 'form-control']) !!}
                                    </div>

                                <!-- Add Button -->
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus"></i> Aprobar solicitud
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
        "order": [[ 5, "desc" ]]
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
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        var lineChartOptions = areaChartOptions;
        lineChartOptions.datasetFill = false;
        lineChart.Line(areaChartData, lineChartOptions);

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: 700,
                color: "#f56954",
                highlight: "#f56954",
                label: "Chrome"
            },
            {
                value: 500,
                color: "#00a65a",
                highlight: "#00a65a",
                label: "IE"
            },
            {
                value: 400,
                color: "#f39c12",
                highlight: "#f39c12",
                label: "FireFox"
            },
            {
                value: 600,
                color: "#00c0ef",
                highlight: "#00c0ef",
                label: "Safari"
            },
            {
                value: 300,
                color: "#3c8dbc",
                highlight: "#3c8dbc",
                label: "Opera"
            },
            {
                value: 100,
                color: "#d2d6de",
                highlight: "#d2d6de",
                label: "Navigator"
            }
        ];
        var pieOptions = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            //String - The colour of each segment stroke
            segmentStrokeColor: "#fff",
            //Number - The width of each segment stroke
            segmentStrokeWidth: 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps: 100,
            //String - Animation easing effect
            animationEasing: "easeOutBounce",
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    });
</script>
@endpush
