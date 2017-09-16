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
							<tr>
								<td colspan="3" width="560px"><p>REALZADO POR: {{$request->accomplished}} </p></td>
							</tr>
							<tr>
								<td colspan="3" width="560px"><p>SUPERVISOR: {{$request->supervisor}} </p></td>
							</tr>
							<tr>
								<td colspan="3" width="560px"><p>FECHA DE REALIZACION:</p></td>
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
						@endif
						</tbody>
					</table>
				</div>
			</div>
    </div>


			{{-- @if($r->completed_work == null)
				<div class="col-lg-6">
					{!! Form::open(['url' => ['dashboard/maintenancesRequest', $r->id], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormAddResponse']) !!}
					<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
						{!! Form::label('Status') !!}
						<select class="form-control" name="status">
							<option value=""></option>
							<option value="Pendiente">Pendiente</option>
							<option value="En Ejecucion">En Ejecucion</option>
							<option value="Finalizado">Finalizado</option>
						</select>
						@if ($errors->has('status'))
							<span class="help-block">
								<strong>{{ $errors->first('status') }}</strong>
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('answer') ? ' has-error' : '' }}">
						{!! Form::label('Respuesta') !!}
						{!! Form::textarea('answer', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
						@if ($errors->has('answer'))
							<span class="help-block">
								<strong>{{ $errors->first('answer') }}</strong>
							</span>
						@endif
					</div>
					@if(Auth::user()->role_id == 1)
						<div class="form-group {{ $errors->has('technical') ? ' has-error' : '' }}">
							{!! Form::label('Tecnico') !!}
							<select class="form-control" name="technical_id">
								<option value=""></option>
								@foreach ($users as $u)
									<option value="{{$u->Uid}}">{{$u->Uname}} {{$u->Ulastname}}</option>
								@endforeach
							</select>
							@if ($errors->has('technical'))
								<span class="help-block">
									<strong>{{ $errors->first('technical') }}</strong>
								</span>
							@endif
						</div>
					@endif

					<div class="form-group">
						<div class="col-md-6" style="margin-top: 20px;">
							{!! Form::submit('ENVIAR', ['class' => 'btn btn-primary btn-block']) !!}
						</div>
					</div>
					{!! Form::close() !!} --}}
				{{-- </div> --}}
			</div>
		{{-- @endif --}}
@endsection