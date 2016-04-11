@extends('layouts.app')

@section('contentheader_title')
	Bienvenido a SIca
@endsection
@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="row">
	<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>NX</h3>

                  <p>Cooperativas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-group"></i>
                </div>
                <a href="{{url('cooperativas')}}" class="small-box-footer">
                  Ver Detalles <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          {{--<h3>53<sup style="font-size: 20px">%</sup></h3>--}}
                          <h3>NX</h3>

                          <p>Solicitudes</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          Ver Solicitudes <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>NX</h3>

                  <p>Creditos Pendientes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tasks"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Ver creditos <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>NX<sup style="font-size: 20px">%</sup></h3>

                          <p>Graficas de apoyo</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                          Ver detalles <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
            </div>
	</div>

@endsection
