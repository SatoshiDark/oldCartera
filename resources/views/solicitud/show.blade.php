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
              <h3 class="box-title"><b>Solicitud</b> {{$solicitud->nombre}}</h3>
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
@endpush
{{--

$saldo_capital=$values['saldo_capital'];
$capital_prestado=$saldo_capital;
$plazo=$values['plazo'];
$gracia=$values['tiempo_gracia'];

$interes_anual=$values['interes'];
$interes_mensual=$interes_anual/12/100;
$fecha_ini=$values['fecha_desembolso'];
$cuota_capital_mes=round($values['saldo_capital']/($plazo-$gracia),2);
echo("capital= $saldo_capital   ");
echo("Plazo en meses= $plazo   ");
echo("interes anual= $interes_anual   ");
echo("interes mensual = $interes_mensual   ");
$contador_mes=0;
echo "<table><tr><th>Fecha</th><th>PG</th><th>Cuota Mes</th><th>Cuota Interes</th><th>Cuota Total</th><th>Saldo a Capital</th></tr>";

$id_credito=$values['id_credito'];

$date = $fecha_ini;
//$date = date('d-m-Y', strtotime("+0 months", strtotime($date)));
$es_gracia=1;
while ($contador_mes < $plazo)
{

echo "<tr>";
echo("<td>$date</td>");
//$date = date('d-m-Y', strtotime("+1 months", strtotime($date)));
//$date= date("d-m-Y", strtotime('+30 days'));
$Date=date('d-m-Y', strtotime($Date. ' + 30 days'));
//echo("<br>");

//echo date_format($date);
//$date = date_add($date,date_interval_create_from_date_string('30 days'));
//$date = strtotime("+".$values['fecha_pago']." days", strtotime($date));

if($contador_mes<$gracia)
{

echo("<td>$es_gracia</td>");
echo("<td>cuota_mes= 0\t</td>");
$cuota_interes=round($saldo_capital*$interes_mensual,2);
echo("<td>cuota interes= $cuota_interes\t</td>");
$cuota_total=0+$cuota_interes;
echo("<td>cuota Total= $cuota_total\t</td>");
echo("<td>nuevo saldo a capital= $saldo_capital\t</td>");
}
else
{
$es_gracia=0;
echo("<td>$es_gracia</td>");
echo("<td>cuota_mes= $cuota_capital_mes\t</td>");
$cuota_interes=round($saldo_capital*$interes_mensual,2);
echo("<td>cuota interes= $cuota_interes\t</td>");
$cuota_total=$cuota_capital_mes+$cuota_interes;
echo("<td>cuota Total= $cuota_total\t</td>");
$saldo_capital=$saldo_capital-$cuota_capital_mes;
echo("<td>nuevo saldo a capital= $saldo_capital\t</td>");

echo "</tr>";
}

//insertando en la base de datos
$sql = "INSERT INTO plan_credito (id_credito,periodo_gracia,fecha_pago,cuota_capital,cuota_interes,total_cuota,saldo_capital) values
  ($id_credito,$es_gracia, $date, $cuota_capital_mes,$cuota_interes,$cuota_total,$saldo_capital)";
//CustomQuery($sql);
$contador_mes+=1;
}
echo "</table>";


//header("Location: plan_credito_list.php?mastertable=credito&masterkey1=" .$values["id_credito"]);
//exit();




// Place event code here.
// Use "Add Action" button to add code snippets.

return true;--}}
