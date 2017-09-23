@extends('layouts.dashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>

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

		{{--  MATENIMIENTO --}}
		<div class="col-md-6 col-lg-3 col-xs-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Mis Trabajos</div>
				<div class="panel-body">
					<a href="{{ url('dashboard/jobs') }}" style="cursor: pointer;"> Ir <span class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</span></a>
				</div>
			</div>
		</div>

	</div>
@endsection
