@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Informacion de Equipos</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                    Equipos Computacionales
										<a href="{{url('equipments')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </div>
                <!-- /.panel-heading -->

            	<div class="row">
				  <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'equipments.index', 'method' => 'GET']) !!}
				    <div class="input-group">
				      {!! Form::text('serial', null, ['class' => 'form-control', 'placeholder' => 'Serial']) !!}
				      <span class="input-group-btn">
				        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
				      </span>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				  {!! Form::close() !!}
				</div><!-- /.row -->

                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="DataTableEquipment" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial</th>
                                    <th>IP</th>
                                    <th>Tipo de Equipo</th>
                                    <th>Departamento</th>
                                    <th>Marca</th>
                                    <th width="180">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($equipments as $equipment)
                              	<tr>
                                    <td>{{ $equipment->id }}</td>
                                    <td>{{ $equipment->serial }}</td>
                                    <td>{{ $equipment->IP }}</td>
                                    <td>{{ strtoupper($equipment->type) }}</td>
                                    <td>{{ strtoupper($equipment->department->name) }}</td>
                                    <td>{{ $equipment->brand->name}}</td>
                                    <td width="200px" style="text-align: center;">
                                    	<a href="{{ url('equipments/'.$equipment->id.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Editar</a>
																				{{--onclick="return confirm('DESEA BORRAR REGISTRO ?');"  --}}
                                    	<a  href="{{ url('equipments/delete/'. $equipment->id) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                    		<i class="fa fa-trash" aria-hidden="true"></i>
                                    		Desincorporar</a>

                                    </td>


                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $equipments->links() }}
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
