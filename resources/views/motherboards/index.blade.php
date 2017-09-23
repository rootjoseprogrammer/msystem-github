@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Informacion de Tarjeta Madre</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                    Tarjeta Madre
										<a href="{{url('motherboards')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </div>
                <!-- /.panel-heading -->

            	<div class="row">
				  <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'motherboards.index', 'method' => 'GET']) !!}
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
                        <table id="DataTableMotherboard" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>En Equipo</th>
                                    <th>Marca</th>
                                    <th>Serial</th>
                                    <th>Slot</th>
                                    <th>Puertos USB</th>
                                    <th>Tipo Fuente de Poder</th>
                                    <th width="180">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($ms as $m)
                              	<tr>
                                    <td>{{ $m->Mid }}</td>
                                    <td>
																			@if($m->registered == 1)
																				Ya Equipado
																			@else
																				No Equipado
																			@endif
																		</td>
                                    <td>{{ $m->brand }}</td>
                                    <td>{{ $m->serialM }}</td>
                                    <td>{{ $m->slot }}</td>
                                    <td>{{ $m->usb }}</td>
                                    <td>{{ $m->type_source}}</td>
                                    <td width="200px" style="text-align: center;">
                                    	<a href="{{ url('motherboards/'.$m->Mid.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Editar</a>
																				{{-- onclick="return confirm('DESEA BORRAR REGISTRO ?');"  --}}
                                    	<a href="{{ url('motherboards/delete/'. $m->Mid) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                    		<i class="fa fa-trash" aria-hidden="true"></i>
                                    		Desincorporar</a>

                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $ms->links() }}
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
