@extends('layouts.dashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">MODIFICAR INFORMACION</div>
            <div class="panel-body">
                  {!! Form::open(['route' => ['users.update', $user->Uid], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormUserEdit', 'class' => 'form-horizontal']) !!}

									<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
											<label for="name" class="col-md-4 control-label">Activo</label>

											<div class="col-md-6">
													<select class="form-control" name="active">
														<option value="1">Si</option>
														<option value="0">No</option>
													</select>
											</div>
									</div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nombre</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $user->Uname }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Apellido</label>

                        <div class="col-md-6">
                            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $user->Ulastname }}" required autofocus>

                            @if ($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                        <label for="cedula" class="col-md-4 control-label">Cedula</label>

                        <div class="col-md-6">
                            <input id="cedula" type="text" class="form-control" name="cedula" value="{{ $user->cedula }}" required autofocus maxlength="8">

                            @if ($errors->has('cedula'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cedula') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Departamento</label>

                        <div class="col-md-6">
                            <select name="department_id" class="form-control">
                                <option value="{{ $user->department_id }}">{{ strtoupper($user->Dname) }}</option>
                                @foreach($departments as $data)
                                <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contraseña</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required value="{{ $user->password }}">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmación de Contraseña</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-warning">
                              Editar
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
  </div>
@endsection
