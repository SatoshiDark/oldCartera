<!-- Content Header (Page header) -->
@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Existen algunos errores con los datos ingresados</h4>
                @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
              </div>

@endif