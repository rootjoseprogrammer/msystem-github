@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Registrar Unidad Lectora</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registro de Unidad Lectora
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => 'read-drivers.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormReadAdd']) !!}

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
                                        <option value="default">SELECCIONE TIPO DE UNIDAD</option>
                                        <option value="cd-r">CD</option>
                                        <option value="cd-rw">CD-RW</option>
                                        <option value="dvd-r">DVD-R</option>
                                        <option value="dvd-rw">DVD-RW</option>
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
