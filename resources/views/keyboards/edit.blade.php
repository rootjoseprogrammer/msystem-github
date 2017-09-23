@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Edtar Mouse</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Modificacion de Mouse
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['keyboards.update', $k->Cid], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormKeyboardsEdit']) !!}

                                <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
                                    {!! Form::label('Serial') !!}
                                    {!! Form::text('serial', $k->serial, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('serial'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('national_number') ? ' has-error' : '' }}">
                                    {!! Form::label('Numero Bien Estadal') !!}
                                    {!! Form::text('national_number', $k->national_number, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('national_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('national_number') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('type_port') ? ' has-error' : '' }}">
                                    {!! Form::label('Tipo') !!}
                                    {!! Form::text('type_port', $k->type_port, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('type_port'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type_port') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                	{!! Form::label('Marca') !!}

                                    <select name="brand_id" class="form-control">
                                        <option value="{{$k->Bid}}">{{$k->Bname}}</option>
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
