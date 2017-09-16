@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Inventario</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registro del Inventario
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open(['route' => 'inventories.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormInventAdd', 'class' => 'form-horizontal']) !!}

                                <div class="form-group">
																	{{-- COMPUTADOR --}}
                                    {!! Form::label('Equipo', 'Equipo', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="equipment_id" class="form-control">
																					<option value="default">SELECCIONE EQUIPO</option>
																					@foreach($equipments as $data)
																							<option value="{{ $data->id }}">SERIAL:{{ strtoupper($data->serial) }} &nbsp;&nbsp;CAPACIDAD:{{ strtoupper($data->type) }}</option>
																					@endforeach
																			</select>

																		</div>
																		{{--  DISCO DURO --}}
																		{!! Form::label('Disco Duro', 'Disco Duro', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="hd_id" class="form-control">
																					<option value="default">SELECCIONE DISCO DURO</option>
																					@foreach($hd as $data)
																							<option value="{{ $data->Hid }}">SERIAL:{{ strtoupper($data->serialH) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->capacity) }}</option>
																					@endforeach
																			</select>
																		</div>
                                </div>

																<div class="form-group">
																	{{-- RAM --}}
                                    {!! Form::label('RAM', 'RAM', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="ram_id" class="form-control">
																					<option value="default">SELECCIONE RAM</option>
																					@foreach($rams as $data)
																							<option value="{{ $data->id }}">MARCA:{{ strtoupper($data->brand) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->Rtype) }}</option>
																					@endforeach
																			</select>

																		</div>
																		{{--  VIDEO --}}
																		{!! Form::label('Video', 'Video', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="video_id" class="form-control">
																					<option value="default">SELECCIONE VIDEO</option>
																					@foreach($videos as $data)
																							<option value="{{ $data->id }}">RANURA:{{ strtoupper($data->groove) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->Vtype) }}&nbsp;&nbsp;MEMORIA:{{ strtoupper($data->memory) }}</option>
																					@endforeach
																			</select>
																		</div>
                                </div>

																<div class="form-group">
																	{{-- MOTHERBOARD --}}
                                    {!! Form::label('Tarjeta Madre', 'Tarjeta Madre', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="ms_id" class="form-control">
																					<option value="default">SELECCIONE MOTHERBOARD</option>
																					@foreach($ms as $data)
																							<option value="{{ $data->id }}">MARCA:{{ strtoupper($data->brand) }} &nbsp;&nbsp;SERAL:{{ strtoupper($data->serialM) }}</option>
																					@endforeach
																			</select>

																		</div>
																		{{--  READRIVERS --}}
																		{!! Form::label('Unidad Lectora', 'Unidad Lectora', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="rd_id" class="form-control">
																					<option value="default">SELECCIONE UNIDAD</option>
																					@foreach($rd as $data)
																							<option value="{{ $data->id }}">TIPO:{{ strtoupper($data->Rtype) }} &nbsp;&nbsp;MARCA:{{ strtoupper($data->brand) }}</option>
																					@endforeach
																			</select>
																		</div>
                                </div>

																<div class="form-group">
																	{{-- CPU --}}
                                    {!! Form::label('CPU', 'CPU', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="cpu_id" class="form-control">
																					<option value="default">SELECCIONE CPU</option>
																					@foreach($cpu as $data)
																							<option value="{{ $data->id }}">MARCA:{{ strtoupper($data->brand) }} &nbsp;&nbsp;MODELO:{{ strtoupper($data->model) }} &nbsp;&nbsp;SOCKET:{{ strtoupper($data->socket) }}</option>
																					@endforeach
																			</select>

																		</div>
																		{{--  RED --}}
																		{!! Form::label('RED', 'RED', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			<select name="net_id" class="form-control">
																					<option value="default">SELECCIONE TARJETA DE RED</option>
																					@foreach($net as $data)
																							<option value="{{ $data->id }}">TIPO:{{ strtoupper($data->type) }} &nbsp;&nbsp; SLOT:{{ strtoupper($data->type_slot) }} &nbsp;&nbsp;MARCA:{{ strtoupper($data->brand) }}</option>
																					@endforeach
																			</select>
																		</div>
                                </div>



																{{--  DESCRPCION DEL EQUIPO QUE SE REGISTRA EN EL INVENTARIO--}}
                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    {!! Form::label('Nota','Nota', ['class' => 'control-label col-lg-1']) !!}
																		<div class="col-lg-4">
																			{!! Form::textarea('description', null, ['class' => 'form-control', 'required', 'autofocus', 'rows' => '6']) !!}

	                                    @if ($errors->has('description'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('problem') }}</strong>
	                                        </span>
	                                    @endif
																		</div>

                                </div>

                                <div class="form-group" style="margin-top: 50px;">
		                            <div class="col-md-2 col-lg-2" >
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
