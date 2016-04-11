<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-dashboard'></i> <span>Home</span></a></li>

            {{--<li><a href="#"><i class='fa fa-link'></i> <span>Estado Actual</span></a></li>--}}
            {{--<li><a href="#"><i class='fa fa-link'></i> <span>Graficas</span></a></li>--}}
            {{--<li><a href="#"><i class='fa fa-link'></i> <span>Reportes</span></a></li>--}}
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Cooperativas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('cooperativas') }}">Cooperativas</a></li>
                    {{--<li><a href="#">Socios</a></li>--}}
                    {{--<li><a href="#">Supervision de Cooperativas</a></li>--}}
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-edit'></i> <span>Solicitud de Prestamos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('solicitudes') }}">Todas las solicitudes</a></li>
                    <li><a href="#">Solicitudes Aprobadas</a></li>
                    <li><a href="#">Solicitudes Pendientes</a></li>
                    <li><a href="#">Garantias de las Solicitudes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-credit-card'></i> <span>Administracion de Creditos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Todas los creditos</a></li>
                    <li><a href="#">Aprobacion de creditos</a></li>
                    <li><a href="#">Plan de creditos</a></li>
                    <li><a href="#">Desembolsos</a></li>
                    <li><a href="#">Amortizaciones</a></li>
                </ul>
            </li>
            <li class="treeview">
                                        <a href="#"><i class='fa fa-book'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="#">Graficas de Desempeño</a></li>
                                            <li><a href="#">Reportes Detallados</a></li>
                                        </ul>
                                    </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-wrench'></i> <span>Configuracion general</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Tipos de Creditos</a></li>
                    <li><a href="#">Minerales de Produccion</a></li>
                    <li><a href="#">Configuracion de Usuarios</a></li>
                    {{--<li><a href="#">Permisos</a></li>--}}

                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
