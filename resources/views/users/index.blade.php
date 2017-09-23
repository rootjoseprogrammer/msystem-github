@extends('layouts.dashboard')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Usuarios
          <a href="{{url('users')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>
        <div class="row">
				  <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'users.index', 'method' => 'GET']) !!}
				    <div class="input-group">
				      {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search...', 'maxlength' => '8']) !!}
				      <span class="input-group-btn">
				        {!! Form::submit('Buscar', ['class' => 'btn btn-default']) !!}
				      </span>
				    </div>
				  </div>
				  {!! Form::close() !!}
        </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="DataTableUsers" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cedula</th>
                                    <th>Email</th>
                                    <th>Activo</th>
                                    <th width="200px" style="text-align: center;">Status</th>
                                    <th width="200px" style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $u)
                              	<tr>
                                    <td>{{ ucwords($u->Uname) }}</td>
                                    <td>{{ ucwords($u->Ulastname) }}</td>
                                    <td>{{ $u->cedula }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                      @if($u->active != 0)
                                        Si
                                      @else
                                        No
                                      @endif
                                    </td>
                                    <td>
                                      <a href="{{ url('users/enable/'.$u->Uid)}}" title="Activar" class="btn btn-success btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Activar
                                      </a>
                                      <a href="{{ url('users/disable/'.$u->Uid)}}" title="Desactivar" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                      		Desactivar
                                      </a>
                                    </td>
                                    <td >
                                      <a href="{{ url('users/'.$u->Uid.'/edit')}}" title="Edtar" class="btn btn-warning btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Editar
                                      </a>
                                      {{--  onclick="return confirm('DESEA BORRAR REGISTRO ?');"  --}}
                                    	<a href="{{ url('users/delete/'. $u->Uid) }}" title="Desincorporar" class="btn btn-danger btn-sm">
                                    		<i class="fa fa-trash" aria-hidden="true"></i>
                                    		Desincorporar</a>

                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $users->links() }}
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
