@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Registrar Tarjetas Madres</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registro de Tarjetas Madres
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => 'motherboards.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormMotherboardAdd']) !!}

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

                                <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
                                    {!! Form::label('Serial') !!}
                                    {!! Form::text('serial', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('serial'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('slot') ? ' has-error' : '' }}">
                                    {!! Form::label('Slot') !!}
                                    {!! Form::text('slot', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('slot'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('slot') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('usb') ? ' has-error' : '' }}">
                                    {!! Form::label('Conectores USB') !!}
                                    {!! Form::text('usb', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('usb'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('usb') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('type_source') ? ' has-error' : '' }}">
                                    {!! Form::label('Tipo de Fuente de Poder') !!}
                                    {!! Form::text('type_source', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('type_source'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_source') }}</strong>
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
