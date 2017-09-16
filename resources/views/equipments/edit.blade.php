@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Editar Informacion</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Modificacion de Equipo
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['equipments.update', $equipment->id], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormEquipmentsEdit']) !!}
                            {{ method_field('PUT') }}

                                <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
                                    {!! Form::label('Serial') !!}
                                    {!! Form::text('serial', $equipment->serial, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('serial'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('IP') ? ' has-error' : '' }}">
                                    {!! Form::label('IP') !!}
                                    {!! Form::text('IP', $equipment->IP, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('IP'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('IP') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    {!! Form::label('Tipo de Computador') !!}
                                    {!! Form::text('type', $equipment->type, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                	{!! Form::label('Departamento') !!}

                                    <select name="department_id" class="form-control">
                                    	<option value="default">SELECCIONE DEPARTAMENTO</option>
	                                    @foreach($departments as $data)
	                                    	<option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
	                                    @endforeach
                                    </select>

                                </div>

                                <div class="form-group">
                                	{!! Form::label('Marca') !!}

                                    <select name="brand_id" class="form-control">
                                        <option value="default">SELECCIONE DEPARTAMENTO</option>
                                        @foreach($brands as $data)
                                            <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
                                        @endforeach
                                    </select>

                                </div>

																<div class="form-group {{ $errors->has('reason') ? ' has-error' : '' }}">
                                    {!! Form::label('Motivo') !!}
                                    {!! Form::textarea('reason', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('reason'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
		                            <div class="col-md-6" style="margin-top: 20px;">
		                                {!! Form::submit('EDITAR', ['class' => 'btn btn-warning btn-block']) !!}
		                            </div>
		                        </div>

                                {!! Form::hidden('user_id', Auth::user()->id ) !!}

	                        {!! Form::close() !!}
	                    </div>
	                    <!-- /.col-lg-6 (nested) -->
	                </div>
	                <!-- /.row (nested) -->
	            </div>
	            <!-- /.panel-body -->
	        </div>
	        <!-- /.panel -->
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
@endsection
