@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Informacion de los Matenimientos</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                    Mantenimientos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="DataTableMicroprocessor" class="table">
                            <thead>
                                <tr>
                                    <th>Equipo</th>
                                    <th>Serial del Equipo</th>
                                    <th>Fecha de Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($maints as $main)
                              	<tr>
                                    <td>{{ $main->type }}</td>
                                    <td>{{ $main->serial }}</td>
                                    <td>{{ $main->fecha }}</td>
                                </tr>
                                <tr>
                                  <th colspan="3" style="border-top:none;">Problema</th>
                                </tr>
                                <tr>
                                  <td colspan="3" style="border-top:none;"><p style="word-wrap: break-word;">{{$main->problem}}</p></td>
                                </tr>
                                <tr>
                                  <th colspan="3">Solucion</th>
                                </tr>
                                <tr>
                                  <td colspan="3" style="border-top:none;"><p style="word-wrap: break-word;">{{$main->solution}}</p></td>
                                </tr>

                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.row -->
    </div>

@endsection
