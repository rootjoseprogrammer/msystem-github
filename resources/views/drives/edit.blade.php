@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Modificar Informacion</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Modificar Discos Duros
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['drives.update', $hdrives->id], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormDrivesEdit']) !!}
                            {{ method_field('PUT') }}

                            <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
                                    {!! Form::label('Serial del Disco Duro') !!}
                                    {!! Form::text('serial', $hdrives->serial, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('serial'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('capacity') ? ' has-error' : '' }}">
                                    {!! Form::label('Capacidad del Disco Duro') !!}
                                    {!! Form::text('capacity', $hdrives->capacity, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('capacity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('capacity') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                  <div class="form-group {{ $errors->has('speed') ? ' has-error' : '' }}">
                                    {!! Form::label('Velocidad del Disco Duro') !!}
                                    {!! Form::text('speed', $hdrives->speed, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('speed'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('speed') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                {{-- <div class="form-group">
                                	{!! Form::label('Departamento') !!}

                                    <select name="equipment_id" class="form-control">
                                    	<option value="default">SELECCIONE EQUIPO</option>
	                                    @foreach($equipments as $data)
	                                    	<option value="{{ $data->id }}">SERIAL:{{ strtoupper($data->serial) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->type) }}</option>
	                                    @endforeach
                                    </select>

                                </div> --}}

                                <div class="form-group">
                                	{!! Form::label('Marca') !!}

                                    <select name="brand_id" class="form-control">
                                        <option value="default">SELECCIONE MARCA</option>
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
