@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Informacion de los Matenimientos</h1>
		</div><!-- /.col-lg-12 -->
	</div>
	{{--  CONTENTINIDO --}}
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">  Mantenimientos</div><!-- /.panel-heading -->
				<div class="row">
					<div class="col-lg-6 pull-right">
						{!! Form::open(['route' => 'maintenances.index', 'method' => 'GET']) !!}
						<div class="input-group">
							{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
							<span class="input-group-btn">{!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}</span>
						</div>
						</div><!-- /.col-lg-6 -->
						{!! Form::close() !!}
					</div><!-- /.row -->
					<div class="panel-body">
						<div class="table-responsive">
							<table id="DataTableMicroprocessor" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Equipo</th>
                    <th>Serial del Equipo</th>
                    <th>Problema</th>
                    <th>Solucion</th>
                    <th>Fecha de Registro</th>
                    <th width="280">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($maints as $main)
										<tr>
											<td>{{ $main->Mid }}</td>
                      <td>{{ $main->type }}</td>
                      <td>{{ $main->serial }}</td>
                      <td>{{str_limit($main->problem, 60)}}</td>
                      <td>{{str_limit($main->solution, 60)}}</td>
                      <td>{{ $main->fecha }}</td>
                      <td width="200px" style="text-align: center;">
												<a href="{{ url('maintenances/'.$main->Mid.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													Editar</a>
													<a href="{{ url('maintenances/'.$main->Mid)}}" title="Ver" class="btn btn-info btn-sm">
														<i class="fa fa-eye" aria-hidden="true"></i>
														Ver</a>
														{{--  onclick="return confirm('DESEA BORRAR REGISTRO ?');" --}}
														<a  href="{{ url('maintenances/delete/'. $main->Mid) }}" title="Eliminar" class="btn btn-danger btn-sm">
															<i class="fa fa-trash" aria-hidden="true"></i>
															Desincorporar</a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
									<div class="col-lg-12">
										{{ $maints->links() }}
									</div><!-- /.table-responsive -->
                </div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div><!-- /.row -->
					</div>
				</div>
@endsection
