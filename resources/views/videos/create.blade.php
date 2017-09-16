@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Registrar Memoria de Video</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registro de Memoria de Video
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => 'videos.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormVideosAdd']) !!}

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
                                    {!! Form::label('Tipo') !!}

                                    <select name="type" class="form-control">
                                        <option value="default">SELECCIONE TIPO DE UNIDAD</option>
                                        <option value="integrada">INTEGRADA</option>
                                        <option value="externa">EXTERNA</option>
                                    </select>

                                </div>


                                <div class="form-group {{ $errors->has('memory') ? ' has-error' : '' }}">
                                    {!! Form::label('Memoria') !!}
                                    {!! Form::text('memory', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('memory'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('memory') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('groove') ? ' has-error' : '' }}">
                                    {!! Form::label('Ranura') !!}
                                    {!! Form::text('groove', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

                                    @if ($errors->has('groove'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('groove') }}</strong>
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
