@extends('layouts.mdashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>
  </div>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">{{ ucwords($request->Uname) }} {{ ucwords($request->lastname) }}</div>
      <div class="panel-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<td style="text-align: center;" colspan="3"><p style="font-weight: bold;">SOLICITUD DE ORDENES DE TRABAJO AL SERVICIO DE MANTENIMIENTO</p></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td width="560px"><p>SERVICIO: {{ ucwords($request->service) }}</p></td>
								<td width="560px"><p>AMBIENTE: {{ ucwords($request->environment) }}</p></td>
								<td width="560px"><p>PISO: {{ ucwords($request->floor) }}</p></td>
							</tr>
							<tr>
								<td colspan="3"><p>DESCRIPCION DEL TRABAJO SOLICITADO:</p></td>
							</tr>
							<tr>
								<td colspan="3" style="border-top: 0px;" ><p style="text-align: justfy;">{{$request->description}}</p></td>
							</tr>
							<tr>
								<td colspan="1"><p>TIPO DE SOLICITUD: {{strtoupper($request->type_request)}}</p> </td>
								<td><p>SOLICITANTE: {{ ucwords($request->Uname) }} {{ ucwords($request->lastname) }}</p></td>
							</tr>
							@if(Auth::user()->department_id == 2)
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3"><p style="font-weight: bold;">SECCONES:</p></td>
							</tr>
							<tr>
								<td colspan="1"  width="560px"><p>ALBAÑILERIA: {{$request->masonry}} </p></td>
								<td colspan="1" width="560px"><p>MECANICA: {{$request->mechanics}} </p></td>
								<td colspan="1" width="560px"><p>REFRGERACION: {{$request->refrigeration}} </p></td>
							</tr>
							<tr>
								<td colspan="1" width="560px"><p>CARPINTERIA: {{$request->carpentry}} </p></td>
								<td colspan="1" width="560px"><p>PNTURA: {{$request->painting}} </p></td>
								<td colspan="1" width="560px"><p>DEPOSITO: {{$request->deposit}} </p></td>
							</tr>
							<tr>
								<td colspan="1" width="560px"><p>ELECTRICIDAD: {{$request->electricity}} </p></td>
								<td colspan="2" width="560px"><p>PLOMERIA: {{$request->plumbing}} </p></td>
							</tr>
							{{-- <tr>
								<td colspan="3" width="560px"><p>REALIZADO POR: {{$request->accomplished}} </p></td>
							</tr> --}}
							<tr>
								<td colspan="3" width="560px"><p>SUPERVISOR: {{$request->supervisor}} </p></td>
							</tr>
							<tr>
								@if($request->date != null)
									<td colspan="3" width="560px"><p>FECHA DE REALIZACION: {{Carbon\Carbon::parse($request->date)->format('d-m-Y')}}</p></td>
								@else
									<td colspan="3" width="560px"><p>FECHA DE REALIZACION: En Espera</p></td>
								@endif
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3"><p style="font-weight: bold;">MATERALES:</p></td>
							</tr>
							<tr>
								<td colspan="2" style="text-align: center;"><p style="font-weight: bold;">DESCRIPCION:</p></td>
								<td colspan="1" style="text-align: center;"><p style="font-weight: bold;">CANTDAD:</p></td>
							</tr>
							<tr>
								<td colspan="2" width=""><p>{{$request->materials_description}} </p></td>
								<td colspan="1"><p style="text-align: center;">{{$request->quantity}}</td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3"><p style="font-weight: bold;">OBSERVACIONES:</p></td>
							</tr>
							<tr>
								<td colspan="3" width=""><p>{{$request->observations}} </p></td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td colspan="3"><p style="font-weight: bold;">CONFORME:</p></td>
							</tr>
							<tr>
								<td colspan="3" width="" style="border-top: 0px;"><p>{{$request->according}} </p></td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
				@if($request->complete == 0)
				<div class="col-lg-2">
						<a href="#" onclick="event.preventDefault();document.getElementById('end-form').submit();" class="btn btn-primary btn-block">
								Finalizar Trabajo
						</a>
						{{Form::open(['route' => ['mdashboard.endwork', $request->Mid], 'id' => 'end-form', 'method' => 'PUT'])}}
						{!! Form::close() !!}
				</div>
				@endif
			</div>
    </div>
	</div>
@endsection
