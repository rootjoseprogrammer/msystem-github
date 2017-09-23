<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        {!! link_to('/dashboard', 'H.C.M. S.A.', ['class' => 'navbar-brand']) !!}
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                <span class="badge">{{ $messages->count() }}</span>
            </a>
            <ul class="dropdown-menu dropdown-messages">
            @foreach($messages as $m)
                <li>
                    <a href="{{ url('dashboard/'. $m->Aid) }}">
                        <div>
                            <strong>{{$m->Uname}} {{$m->lastname}}</strong>
                            <span class="pull-right text-muted">
                                <em>{{ Carbon\Carbon::parse($m->created_at)->format('d-m-Y H:m:s') }}</em>
                            </span>
                        </div>
                        <div>
                            <div>
                                {{ ucwords($m->department_user) }}
                            </div>
                            {{ $m->message }}
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
            @endforeach
                <li>
                    <a class="text-center" href="{{ url('dashboard/requests') }}">
                        <strong>Ver Todos</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        <!-- /.dropdown-messages -->
        </li>
         <!-- /.dropdown -->
        @if(Auth::check())
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                {!! Auth::user()->email !!} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="{{ url('dashboard/settings') }}"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Cerrar Sesion
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li><!-- /.dropdown-user -->
        @endif<!-- /.dropdown -->
    </ul><!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
       <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <!--<li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </li>-->
                <li>
                    <a href="{{ url('/dashboard') }}">
                        <i class="fa fa-dashboard fa-fw"></i>
                        &nbsp;&nbsp;Dashboard
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                        &nbsp;&nbsp;Monitor <span class="fa arrow"></span>
                    </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ url('/displays') }}">Ver Monitores</a>
                            </li>
                            <li>
                                <a href="{{ url('/displays/create') }}">Registrar Monitor</a>
                            </li>
                        </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                        &nbsp;&nbsp;Impresoras <span class="fa arrow"></span>
                    </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ url('/printers') }}">Ver Impresora</a>
                            </li>
                            <li>
                                <a href="{{ url('/printers/create') }}">Registrar Impresora</a>
                            </li>
                        </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                        &nbsp;&nbsp;Mouse <span class="fa arrow"></span>
                    </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ url('/mouses') }}">Ver Mouse</a>
                            </li>
                            <li>
                                <a href="{{ url('/mouses/create') }}">Registrar Mouse</a>
                            </li>
                        </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                        &nbsp;&nbsp;Teclado <span class="fa arrow"></span>
                    </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ url('/keyboards') }}">Ver Teclado</a>
                            </li>
                            <li>
                                <a href="{{ url('/keyboards/create') }}">Registrar Teclado</a>
                            </li>
                        </ul>
                </li>



                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                        &nbsp;&nbsp;Marcas <span class="fa arrow"></span>
                    </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ url('/brands') }}">Ver Marcas</a>
                            </li>
                            <li>
                                <a href="{{ url('/brands/create') }}">Registrar Marcas</a>
                            </li>
                        </ul>
                </li>

                <li>

                    <a href="#">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                            &nbsp;&nbsp;Equipos <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/equipments') }}">Ver Equipos</a>
                        </li>
                        <li>
                            <a href="{{ url('/equipments/create') }}">Registrar Equipo</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-hdd-o" aria-hidden="true"></i>
                        &nbsp;&nbsp;Discos Duros<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/drives') }}">Ver Discos Duros</a>
                        </li>
                        <li>
                            <a href="{{ url('/drives/create') }}">Registrar Driscos Duros</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;CPU<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/microprocessors') }}">Ver CPUs</a>
                        </li>
                        <li>
                            <a href="{{ url('/microprocessors/create') }}">Registrar CPU</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Tarjeta Madre<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/motherboards') }}">Ver Tarjetas Madres</a>
                        </li>
                        <li>
                            <a href="{{ url('/motherboards/create') }}">Registrar Tarjeta Madre</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Tarjeta de Red<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/netcards') }}">Ver Tarjetas de Red</a>
                        </li>
                        <li>
                            <a href="{{ url('/netcards/create') }}">Registrar Tarjeta de Red</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Unidad Lectora<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/read-drivers') }}">Ver Unidad Lectora</a>
                        </li>
                        <li>
                            <a href="{{ url('/read-drivers/create') }}">Registrar Unidad Lectora</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Memoria de Video<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/videos') }}">Ver Memoria Video</a>
                        </li>
                        <li>
                            <a href="{{ url('/videos/create') }}">Registrar Memoria Video</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Memoria RAM<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/rams') }}">Ver Memorias Rams</a>
                        </li>
                        <li>
                            <a href="{{ url('/rams/create') }}">Registrar Memoria Ram</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Mantenimiento de Equipo<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/maintenances') }}">Ver Mantenimientos</a>
                        </li>
                        <li>
                            <a href="{{ url('/maintenances/create') }}">Registrar Mantenimiento</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Inventariado<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/inventories')}}">Ver Inventario</a>
                        </li>
                        <li>
                            <a href="{{url('/inventories/create')}}">Actualizar Inventario</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-square" aria-hidden="true"></i>
                            &nbsp;&nbsp;Historial<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('records')}}">Ver Historial</a>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->role_id == 1)
                <li>
                    <a href="#">
                        <i class="fa fa-user" aria-hidden="true"></i>
                            &nbsp;&nbsp;Usuarios<span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{url('/users')}}">Ver Usuarios</a>
                        </li>
                    </ul>
                </li>
              @endif

            </ul>
        </div><!-- /.sidebar-collapse -->
    </div><!-- /.navbar-static-side -->
</nav>
