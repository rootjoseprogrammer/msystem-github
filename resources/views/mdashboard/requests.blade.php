@extends('layouts.mdashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Panel Administrativo</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                    Solicitudes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="DataTableApplications" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Departamento</th>
                                    <th>Asunto</th>
                                    <th>Solicitud</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($total as $m)
                              	<tr>
                                    <td>{{ $m->Aid }}</td>
                                    <td>{{ ucwords($m->Uname) }} {{ ucwords($m->lastname) }}</td>
                                    <td>{{ ucwords($m->department_user) }}</td>
                                    <td>{{ ucwords($m->subject) }}</td>
                                    <td>{{ $m->message }}</td>
                                    <td>{{ $m->created_at }}</td>
                                    <td>
                                    	<a href="{{ url('mdashboard/'.$m->Aid)}}" title="Ver" class="btn btn-primary btn-sm">
                                    		<i class="fa fa-eye" aria-hidden="true"></i>
                                    		Ver</a>
                                        <a onclick="return confirm('DESEA BORRAR REGISTRO ?');" href="{{ url('mdashboard/destroy/'. $m->Aid) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            Eliminar</a>
                                    </td>
                                </tr> 
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $total->links() }}
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