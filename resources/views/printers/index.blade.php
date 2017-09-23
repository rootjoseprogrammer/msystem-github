@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Informacion de Impresoras</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                  Impresoras
									<a href="{{url('printers')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </div>
                <!-- /.panel-heading -->

            	<div class="row">
				  <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'printers.index', 'method' => 'GET']) !!}
				    <div class="input-group">
				      {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
				      <span class="input-group-btn">
				        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
				      </span>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				  {!! Form::close() !!}
				</div><!-- /.row -->

                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="DataTableDisplays" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Serial</th>
                                    <th>Modelo</th>
                                    <th>Bien Estadal</th>
                                    <th>Estafamos</th>
																		<th>Tipo</th>
                                    <th>Marca</th>
                                    <th width="180">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($printers as $p)
                              	<tr>
                                    <td>{{ $p->Cid }}</td>
                                    <td>{{ $p->serial }}</td>
                                    <td>{{ $p->model }}</td>
                                    <td>{{ $p->state_number }}</td>
                                    <td>{{ $p->estafamos }}</td>
                                    <td>{{ $p->type }}</td>
                                    <td>{{ $p->Bname }}</td>

                                    <td width="200px" style="text-align: center;">
                                    	<a href="{{ url('printers/'.$p->Cid.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Editar</a>
																				{{-- onclick="return confirm('DESEA BORRAR REGISTRO ?');"  --}}
                                    	<a href="{{ url('printers/delete/'. $p->Cid) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                    		<i class="fa fa-trash" aria-hidden="true"></i>
                                    		Desincorporar</a>

                                    </td>


                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $printers->links() }}
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
