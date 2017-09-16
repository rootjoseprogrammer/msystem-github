@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Edtar Impresora</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Modificacion de Impresora
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['printers.update', $printer->Did], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormDisplaysEdit']) !!}

                                <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
                                    {!! Form::label('Serial') !!}
                                    {!! Form::text('serial', $printer->serial, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('serial'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('serial') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('model') ? ' has-error' : '' }}">
                                    {!! Form::label('Modelo') !!}
                                    {!! Form::text('model', $printer->model, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('model'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('model') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('state_number') ? ' has-error' : '' }}">
                                    {!! Form::label('Numero Bien Estadal') !!}
                                    {!! Form::text('state_number', $printer->state_number, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('state_number'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('state_number') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('estafamos') ? ' has-error' : '' }}">
                                    {!! Form::label('Estafamos') !!}
                                    {!! Form::text('estafamos', $printer->estafamos, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('estafamos'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('estafamos') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    {!! Form::label('Tipo') !!}
                                    {!! Form::text('type', $printer->type, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                	{!! Form::label('Marca') !!}

                                    <select name="brand_id" class="form-control">
                                        <option value="{{$printer->Bid}}">{{$printer->Bname}}</option>
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
