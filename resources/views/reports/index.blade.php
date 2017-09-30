@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Reportes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="col-lg-12" style="margin-top: 10px;">
                <a class="btn btn-primary btn-block" href="{{url('reports/general')}}" title="">PDF GENERAL</a>
            </div>

						<div class="col-lg-6" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/displays')}}" title="">PDF MONITOR</a>
            </div>

						<div class="col-lg-6" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/mouses')}}" title="">PDF MOUSE</a>
            </div>

						<div class="col-lg-6" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/keyboards')}}" title="">PDF TECLADO</a>
            </div>

            <div class="col-lg-6" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/printers')}}" title="">PDF IMPRESORA</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/equipments')}}" title="">PDF EQUIPOS</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/drives')}}" title="">PDF DISCO DURO</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/microprocessors')}}" title="">PDF CPU</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/netcards')}}" title="">PDF TARJETA DE RED</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/motherboards')}}" title="">PDF TARJETA MADRE</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/rams')}}" title="">PDF RAM</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/read-drivers')}}" title="">PDF UNIDAD LECTORA</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/videos')}}" title="">PDF TARJETA DE VIDEO</a>
            </div>

            <div class="col-lg-4" style="margin-top: 10px;">
                <a class="btn btn-default btn-block" href="{{url('reports/maintenances')}}" title="">PDF MANTENIMIENTO</a>
            </div>
        </div>
    </div>

@endsection
