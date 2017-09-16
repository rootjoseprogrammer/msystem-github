@extends('layouts.dashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>
		{{-- <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-comments fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $messages->count() }}</div>
              <div>Solicitudes</div>
            </div>
          </div>
        </div>
        <a href="#">
          <div class="panel-footer">
            <a href="{{ url('dashboard/requests') }}">
              <span class="pull-left">Ver Todos</span>
              <span class="pull-right">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
            </a>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div> --}}

    {{-- <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-tasks fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"></div>
              <div>Equipos</div>
            </div>
          </div>
        </div>
        <a href="{{ url('equipments') }}">
          <div class="panel-footer">
            <a href="{{ url('equipments') }}">
              <span class="pull-left">Ir</span>
              <span class="pull-right">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
            </a>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div> --}}

    {{-- <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-file-pdf-o fa-5x" aria-hidden="true"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div>Reportes</div>
            </div>
          </div>
        </div>
        <a href="{{ url('reports') }}">
          <div class="panel-footer">
            <a href="{{ url('reports') }}">
              <span class="pull-left">Ir</span>
              <span class="pull-right">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
            </a>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div> --}}

    {{--<div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-tasks fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge"></div>
              <div>Mantenimiento</div>
            </div>
          </div>
        </div>
        <a href="{{ url('maintenances') }}">
          <div class="panel-footer">
            <a href="{{ url('maintenances') }}">
              <span class="pull-left">Ir</span>
              <span class="pull-right">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
            </a>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div> --}}

		{{-- <div class="col-md-6 col-lg-3 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
              <i class="fa fa-comments fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $messages->count() }}</div>
              <div>Solicitudes</div>
            </div>
					</div>
				</div>
				<div class="panel-body">
					<a href="{{ url('dashboard/requests') }}">
						<span class="pull-left">Ver Todos</span>
						<span class="pull-right">
							<i class="fa fa-arrow-circle-right"></i>
						</span>
					</a>
				</div>
			</div>
		</div> --}}

		{{--  SOLICITUDES--}}
		<div class="col-md-6 col-lg-3 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Solicitudes <span class="pull-right">{{ $messages->count() }}</span></div>
				<div class="panel-body">
					<a href="{{ url('dashboard/requests') }}" style="cursor: pointer;"> Ir <span class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</span></a>
				</div>
			</div>
		</div>

		{{--  EQUIPOS --}}
		<div class="col-md-6 col-lg-3 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Equipos</div>
				<div class="panel-body">
					<a href="{{ url('equipments') }}" style="cursor: pointer;"> Ir <span class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</span></a>
				</div>
			</div>
		</div>

		{{--  REPORTES --}}
		<div class="col-md-6 col-lg-3 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Reportes</div>
				<div class="panel-body">
					<a href="{{ url('reports') }}" style="cursor: pointer;"> Ir <span class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</span></a>
				</div>
			</div>
		</div>

		{{--  MATENIMIENTO --}}
		<div class="col-md-6 col-lg-3 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Mantenimiento</div>
				<div class="panel-body">
					<a href="{{ url('maintenances') }}" style="cursor: pointer;"> Ir <span class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</span></a>
				</div>
			</div>
		</div>

		{{--  Solicitud a Mantenimiento--}}
		<div class="col-md-6 col-lg-3 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Solicitar a Mantenimiento</div>
				<div class="panel-body">
					<a href="{{ url('requests-maintenances/create') }}" style="cursor: pointer;">Enviar Solicitud<span class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</span></a>
				</div>
				<div class="panel-body">
					<a href="{{ url('requests-maintenances') }}" style="cursor: pointer;">Historal<span class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</span></a>
				</div>
			</div>
		</div>

	</div>
@endsection
