@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Registrar Mantenimiento</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registro del Mantenimiento
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => 'maintenances.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormMaintAdd']) !!}

                                <div class="form-group">
                                    {!! Form::label('Equipo') !!}

                                    <select name="equipment_id" class="form-control">
                                        <option value="default">SELECCIONE EQUIPO</option>
                                        @foreach($equipments as $data)
                                            <option value="{{ $data->id }}">SERIAL:{{ strtoupper($data->serial) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->type) }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                
                                <div class="form-group {{ $errors->has('problem') ? ' has-error' : '' }}">
                                    {!! Form::label('Problema') !!}
                                    {!! Form::textarea('problem', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('problem'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('problem') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('solution') ? ' has-error' : '' }}">
                                    {!! Form::label('Solucion') !!}
                                    {!! Form::textarea('solution', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('solution'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('solution') }}</strong>
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