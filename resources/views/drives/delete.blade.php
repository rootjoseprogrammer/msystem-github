@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Borrar Elemento</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Discos Duros
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['drives.destroy', $hdrives->id], 'method' => 'DELETE', 'role' => 'form', 'id' => 'FormDrivesEdit']) !!}
                            {{-- {{ method_field('DELETE') }} --}}

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
		                                {!! Form::submit('BORRAR', ['class' => 'btn btn-danger btn-block']) !!}
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
