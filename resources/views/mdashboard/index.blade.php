@extends('layouts.mdashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>
		<div class="col-lg-3 col-md-6">
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
            <a href="{{ url('mdashboard/requests') }}">
              <span class="pull-left">Ver Todos</span>
              <span class="pull-right">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
            </a>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

		<div class="col-lg-3 col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-comments fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">{{ $messages->count() }}</div>
              <div>Informatica</div>
            </div>
          </div>
        </div>
        <a href="#">
          <div class="panel-footer">
            <a href="{{ url('mdashboard/computing') }}">
              <span class="pull-left">Ver Todos</span>
              <span class="pull-right">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
            </a>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

	</div>
@endsection
