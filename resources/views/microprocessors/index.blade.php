@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Informacion de Microprocesadores</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                    Microprocesadores
                </div>
                <!-- /.panel-heading -->

            	<div class="row">
				  <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'microprocessors.index', 'method' => 'GET']) !!}
				    <div class="input-group">
				      {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
				      <span class="input-group-btn">
				        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
				      </span>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				  {!! Form::close() !!}
				</div><!-- /.row -->

                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="DataTableMicroprocessor" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>En Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Socket</th>
                                    <th>Velocidad</th>
                                    <th width="180">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($micros as $micro)
                              	<tr>
                                    <td>{{ $micro->Mid }}</td>
                                    <td>
																			@if($micro->registered == 1)
																				Ya Equipado
																			@else
																				No Equipado
																			@endif
																		</td>
                                    <td>{{ $micro->brand }}</td>
                                    <td>{{ $micro->model }}</td>
                                    <td>{{ $micro->socket }}</td>
                                    <td>{{ $micro->speed }}</td>
                                    <td width="200px" style="text-align: center;">
                                    	<a href="{{ url('microprocessors/'.$micro->Mid.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Editar</a>
																				{{--  onclick="return confirm('DESEA BORRAR REGISTRO ?');" --}}
                                    	<a  href="{{ url('microprocessors/delete/'. $micro->Mid) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                    		<i class="fa fa-trash" aria-hidden="true"></i>
                                    		Desincorporar</a>

                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $micros->links() }}
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.row -->
    </div>

@endsection
