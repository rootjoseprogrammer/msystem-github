@extends('layouts.dashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>
  </div>
  <div class="row">
    @foreach($request as $r)
    <div class="panel panel-default">
      <div class="panel-heading">{{ ucwords($r->Uname) }} {{ ucwords($r->lastname) }}</div>
      <div class="panel-body">
        <div>
          <p><strong>Asunto:</strong> {{ ucwords($r->subject) }}</p>
        </div>
        <div>
          <p><strong>Fecha:</strong> {{ Carbon\Carbon::parse($r->created_at)->format('d-m-Y H:m:s') }}</p>
        </div>
        <div>
          <p><strong>Departamento:</strong> {{ ucwords($r->department_user) }}</p>
        </div>
				<div>
          <p><strong>Status:</strong> {{ ucwords($r->status) }}</p>
        </div>
				@if($r->completed_work != null)
					<div>
          	<p><strong>Finalizado el Dia:</strong> {{ Carbon\Carbon::parse($r->completed_work)->format('d-m-Y') }}</p>
        	</div>
				@endif
        <hr>
        <div>
          <p><strong>Solicitud:</strong> {{ $r->message }}</p>
        </div>
				@if($r->according != null)
					<div>
          	<p><strong> Conforme:</strong> {{ $r->according }}</p>
        	</div>
				@endif
      </div>
    </div>

			@if($r->according == null)
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
					{!! Form::close() !!}
				</div>
			</div>
			@endif

			@if($r->according != null)
			<div class="col-lg-2">
					<a href="#" onclick="event.preventDefault();document.getElementById('end-form').submit();" class="btn btn-primary btn-block">
							Finalizar Trabajo
					</a>
					{{Form::open(['route' => ['dashboard.endwork', $r->Aid], 'id' => 'end-form', 'method' => 'PUT'])}}
					{!! Form::close() !!}
			</div>
			@endif

	@endforeach
@endsection
