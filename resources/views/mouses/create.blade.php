@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Registrar Mouse</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registro de Monitor
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => 'mouses.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormMousesAdd']) !!}

                                <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
                                    {!! Form::label('Serial') !!}
                                    {!! Form::text('serial', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('serial'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('national_number') ? ' has-error' : '' }}">
                                    {!! Form::label('N. Bien Nacional') !!}
                                    {!! Form::text('national_number', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('national_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('national_number') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('type_port') ? ' has-error' : '' }}">
                                    {!! Form::label('Tipo Puerto') !!}
                                    {!! Form::text('type_port', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('type_port'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_port') }}</strong>
                                        </span>
                                    @endif
                                </div>

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
		                            <div class="col-md-6" style="margin-top: 20px;">
		                                {!! Form::submit('REGISTRAR', ['class' => 'btn btn-primary btn-block']) !!}
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
