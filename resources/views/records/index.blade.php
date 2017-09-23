@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Historial de Infomatica</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                  Bitacora
									<a href="{{url('records')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </div>
                <!-- /.panel-heading -->

            	<div class="row">
				  <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'records.index', 'method' => 'GET']) !!}
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
                                  <th>Fecha</th>
                                  <th>Usuario</th>
                                  <th>Host</th>
                                  <th>Operacion</th>
                                  <th>Tabla</th>
                                  <th>Motivo</th>
                                  {{-- <th width="180">Acciones</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                              {{--  onclick="return confirm('DESEA BORRAR REGISTRO ?');" --}}
                            @foreach($records as $r)
                              	<tr>
                                    <td>{{  Carbon\Carbon::parse($r->date)->format('d-m-Y H:m:s')}}</td>
                                    <td>{{ $r->user }}</td>
                                    <td>{{ $r->host }}</td>
                                    <td>{{ $r->operation }}</td>
                                    <td>{{ $r->table }}</td>
                                    <td>{{ $r->reason }}</td>
                                    {{-- <td>
                                    	<a href="{{ url('read-drivers/'.$read->Rid.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Editar</a>

                                    	<a href="{{ url('read-drivers/delete/'. $read->Rid) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                    		<i class="fa fa-trash" aria-hidden="true"></i>
                                    		Eliminar</a>

                                    </td> --}}
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $records->links() }}
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
