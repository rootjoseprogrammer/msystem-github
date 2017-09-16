@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Editar Informacion</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Modificacion de Marcas
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3">
                            {!! Form::open(['route' => ['brands.update', $brand->id], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormBrandsEdit']) !!}
                            {{ method_field('PUT') }}
                                
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('Nombre de Marca') !!}
                                    {!! Form::text('name', $brand->name, ['class' => 'form-control', 'required', 'autofocus']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
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