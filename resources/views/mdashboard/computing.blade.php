@extends('layouts.mdashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Solicitudes a Matenimiento</h1>
		</div><!-- /.col-lg-12 -->
	</div>
	{{--  CONTENTINIDO --}}
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Solicitudes
					<a href="{{url('mdashboard/computing')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
				</div><!-- /.panel-heading -->
				<div class="row">
					<div class="col-lg-6 pull-right">
						{!! Form::open(['route' => 'mdashboard.computing', 'method' => 'GET']) !!}
						<div class="input-group">
							{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
							<span class="input-group-btn">{!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}</span>
						</div>
						</div><!-- /.col-lg-6 -->
						{!! Form::close() !!}
					</div><!-- /.row -->
					<div class="panel-body">
						<div class="table-responsive">
							<table id="DataTableRequestsMantenances" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Servicio</th>
                    <th>Ambiente</th>
                    <th>Piso</th>
                    <th>Descripcion</th>
                    <th>Tipo de solicitud</th>
										<th>Solicitante</th>
                    <th width="">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach($requests as $request)
										<tr>
											<td>{{ $request->Mid }}</td>
                      <td>{{ $request->service }}</td>
											<td>{{ $request->environment }}</td>
                      <td>{{ $request->floor }}</td>
                      <td>{{str_limit($request->description, 60)}}</td>
                      <td>{{ $request->type_request }}</td>
                      <td>{{ $request->Uname }} {{$request->lastname}}</td>
                      <td width="250px" style="text-align: center;">
												@if($request->supervisor == null)
												<a href="{{ url('mdashboard/response/'.$request->Mid)}}" title="Editar" class="btn btn-warning btn-sm">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
													Responder
												</a>
											@endif

													<a href="{{ url('mdashboard/show/request/'.$request->Mid)}}" title="Ver" class="btn btn-info btn-sm">
														<i class="fa fa-eye" aria-hidden="true"></i>
														Ver
													</a>

														<a  onclick="return confirm('DESEA BORRAR REGISTRO ?');" href="{{ url('mdashboard/delete/'. $request->Mid) }}" title="Eliminar" class="btn btn-danger btn-sm">
															<i class="fa fa-trash" aria-hidden="true"></i>
															Borrar</a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
									<div class="col-lg-12">
										{{ $requests->links() }}
									</div><!-- /.table-responsive -->
                </div><!-- /.panel-body -->
							</div><!-- /.panel -->
						</div><!-- /.row -->
					</div>
				</div>
@endsection
