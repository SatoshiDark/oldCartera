@extends('layouts.app')

@section('contentheader_title')
	Mineral de Produccion
@endsection
@section('htmlheader_title')
	Editar
@endsection


@section('main-content')
<div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Mineral de Produccion</h3>
              <div class="box-tools pull-right">
                            <a href="{{url('mineral')}}" class="btn btn-sm btn-info btn-flat pull-left"><i class='fa fa-th-large'></i> Lista</a>

                            </div>
            </div><!-- /.box-header -->
            <div class="box-body">
<!-- New Task Form -->
        @include('layouts.partials.errors')
        {!! Form::model($tipo_mineral, array('route' => array('mineral.update', $tipo_mineral->id), 'method' => 'put')) !!}


                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre:', ['class' => 'control-label']) !!}
                            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tipo', 'Tipo:', ['class' => 'control-label']) !!}
                            {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
                        </div>

        {!! Form::submit('Actualizar registro', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}

            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </div>
        <!-- /.col -->
      </div>

@endsection
