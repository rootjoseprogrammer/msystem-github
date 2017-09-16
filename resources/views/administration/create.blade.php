@extends('layouts.administration')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Registrar Departamento</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Departamento
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => 'administration.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormAdminAdd']) !!}
                                
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('Nombre del Departamento') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
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