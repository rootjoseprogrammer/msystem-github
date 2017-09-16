@extends('layouts.dashboard')

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
        <div>
          <p><strong>Asunto:</strong> {{ ucwords($request->subject) }}</p>
        </div>
        <div>
          <p><strong>Fecha:</strong> {{ Carbon\Carbon::parse($request->created_at)->format('d-m-Y H:m:s') }}</p>
        </div>
        <div>
          <p><strong>Departamento:</strong> {{ ucwords($request->department_user) }}</p>
        </div>
				<div>
          <p><strong>Status:</strong> {{ ucwords($request->status) }}</p>
        </div>
				@if($request->completed_work != null)
					<div>
          	<p><strong>Finalizado El:</strong> {{ Carbon\Carbon::parse($request->completed_work)->format('d-m-Y') }}</p>
        	</div>
				@endif
        <hr>
        <div>
          <p><strong>Solicitud:</strong> {{ $request->message }}</p>
        </div>
      </div>
    </div>

			@if($request->completed_work == null || $request->status != null)
				<div class="col-lg-6">
					{!! Form::open(['url' => ['dashboard/updateAnswer', $request->Aid], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormAddResponse']) !!}
					<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
						{!! Form::label('Status') !!}
						<select class="form-control" name="status">
							<option value="{{$request->status}}">{{$request->status}}</option>
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
						{!! Form::textarea('answer', $request->answer, ['class' => 'form-control', 'required', 'autofocus']) !!}
						@if ($errors->has('answer'))
							<span class="help-block">
								<strong>{{ $errors->first('answer') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group">
						<div class="col-md-6" style="margin-top: 20px;">
							{!! Form::submit('ENVIAR', ['class' => 'btn btn-primary btn-block']) !!}
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		@endif
@endsection
