@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Registrar Microprocesadores</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registro del CPU
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => 'microprocessors.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormMicroAdd']) !!}

                                {{-- <div class="form-group">
                                    {!! Form::label('Equipo') !!}

                                    <select name="equipment_id" class="form-control">
                                        <option value="default">SELECCIONE EQUIPO</option>
                                        @foreach($equipments as $data)
                                            <option value="{{ $data->id }}">SERIAL:{{ strtoupper($data->serial) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->type) }}</option>
                                        @endforeach
                                    </select>

                                </div> --}}

                                <div class="form-group">
                                    {!! Form::label('Marca') !!}

                                    <select name="brand" class="form-control">
                                        <option value="default">SELECCIONE MARCA</option>
                                        <option value="intel">INTEL</option>
                                        <option value="amd">AMD</option>
                                    </select>

                                </div>

                                <div class="form-group {{ $errors->has('speed') ? ' has-error' : '' }}">
                                    {!! Form::label('Velocidad') !!}
                                    {!! Form::text('speed', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('speed'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('speed') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('model') ? ' has-error' : '' }}">
                                    {!! Form::label('Modelo') !!}
                                    {!! Form::text('model', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('socket') ? ' has-error' : '' }}">
                                    {!! Form::label('Socket') !!}
                                    {!! Form::text('socket', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('socket'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('socket') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
		                            <div class="col-md-6" style="margin-top: 20px;">
		                                {!! Form::submit('REGISTRAR', ['class' => 'btn btn-primary btn-block']) !!}
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
