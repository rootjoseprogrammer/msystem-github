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
					Modificar Tarjeta de Red
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['netcards.update', $net->id], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormNetCardEdit']) !!}
                            {{ method_field('PUT') }}

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

                                    <select name="brand_id" class="form-control">
                                        <option value="default">SELECCIONE MARCA</option>
                                        @foreach($brands as $data)
                                            <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group">
                                    {!! Form::label('Tipo') !!}

                                    <select name="type" class="form-control">
                                        <option value="default">SELECCIONE  TIPO DE TARJETA</option>
                                        <option value="interna">INTERNA</option>
                                        <option value="externa">EXTERNA</option>
                                    </select>

                                </div>

                                <div class="form-group {{ $errors->has('speed') ? ' has-error' : '' }}">
                                    {!! Form::label('Velocidad') !!}
                                    {!! Form::text('speed', $net->speed, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('speed'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('speed') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('type_slot') ? ' has-error' : '' }}">
                                    {!! Form::label('Tipo de Slot') !!}
                                    {!! Form::text('type_slot', $net->type_slot, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('type_slot'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_slot') }}</strong>
                                        </span>
                                    @endif
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
