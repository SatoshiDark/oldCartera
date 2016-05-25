@extends('layouts.app')

@section('contentheader_title')
	Tipos de Prestamos
@endsection
@section('htmlheader_title')
	Crear
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevo Mineral de produccion</h3>
              <div class="box-tools pull-right">
                            <a href="{{url('mineral')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>

                            </div>
            </div><!-- /.box-header -->
            <div class="box-body">
<!-- New Task Form -->
        @include('layouts.partials.errors')
        {!! Form::open(array('url' => 'mineral')) !!}
        {!! csrf_field() !!}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tipo', 'Tipo de Mineral:', ['class' => 'control-label']) !!}
                    {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
                </div>

            <!-- Add Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Añadir nuevo
                    </button>
                </div>
            </div>
        {!! Form::close() !!}

            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div>
        <!-- /.col -->
      </div>

@endsection