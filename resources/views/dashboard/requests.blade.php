@extends('layouts.dashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Panel Administrativo</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
		<div class="col-lg-12">
			<div class="">
				<h2><a href="{{url('dashboard/jobs')}}">Mis Trabajos</a></h2>
			</div>
		</div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                    Solicitudes
										<a href="{{url('dashboard/requests')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="DataTableApplications" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Departamento</th>
                                    <th>IP</th>
                                    <th>Asunto</th>
                                    <th>Solicitud</th>
                                    <th>Fecha de Solicitud</th>
																		<th>Trabajo Finalizado</th>
																		<th>Status</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($total as $m)
                              	<tr>
                                    <td>{{ $m->id }}</td>
                                    <td>{{ ucwords($m->Uname) }} {{ ucwords($m->lastname) }}</td>
                                    <td>{{ ucwords($m->department_user) }}</td>
                                    <td>{{ $m->IP }}</td>
                                    <td>{{ ucwords($m->subject) }}</td>
                                    <td>{{ $m->message }}</td>
                                    <td>{{ Carbon\Carbon::parse($m->created_at)->format('d-m-Y H:m:s') }}</td>
																		<td>
																			@if($m->completed_work == null)
																				0
																			@else
																				{{ Carbon\Carbon::parse($m->completed_work)->format('d-m-Y') }}
																			@endif
																		</td>
																		<td>{{$m->status}}</td>
                                    <td>
                                    	<a href="{{ url('dashboard/'.$m->id)}}" title="Ver" class="btn btn-primary btn-sm">
																				<i class="fa fa-eye" aria-hidden="true"></i>
                                    		Ver
																			</a>
																			@if(Auth::user()->role_id == 1 && $m->according == null ||  $m->according == null)
																				<a href="{{ url('dashboard/'.$m->id. '/edit')}}" title="Editar" class="btn btn-warning btn-sm">
																				Editar
																				</a>
																			@endif
                                        <a onclick="return confirm('DESEA BORRAR REGISTRO ?');" href="{{ url('dashboard/destroy/'. $m->id) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Eliminar
																					</a>
																					{{-- @if($m->completed_work == null)
																					<a href="{{ url('dashboard/endwork/'. $m->id) }}" onclick="return confirm('FINALIZAR TRABAJO ?');" class="btn btn-primary btn-sm">
											                        Finalizado
											                    </a>
																				@endif --}}

                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $total->links() }}
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
