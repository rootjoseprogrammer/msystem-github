@extends('layouts.dashboard')

@section('content')

	<div class="row">
    <div class="col-lg-12"><h1 class="page-header">Inventario</h1></div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
				<div class="panel-heading">
					Inventariado
					<a href="{{url('inventories')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
				</div><!-- /.panel-heading -->

      <div class="row">
        <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'inventories.index', 'method' => 'GET']) !!}
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
                    <th>Equipo</th>
                    <th>Serial del Equipo</th>
                    <th width="200">Departamento</th>
                    <th width="280">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($stock as $i)
                    <tr>
                      <td>{{ $i->id }}</td>
                      <td>{{ $i->type }}</td>
                      <td>{{ $i->serial }}</td>
                      <td>{{ ucwords($i->Dname) }}</td>
                      <td width="200px" style="text-align: center;">
                        <a href="{{ url('inventories/'.$i->id.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Editar
                        </a>
                        <a href="{{ url('inventories/'.$i->id)}}" title="Ver" class="btn btn-info btn-sm">
                          <i class="fa fa-eye" aria-hidden="true"></i>Ver
                        </a>
												{{-- onclick="return confirm('DESEA BORRAR REGISTRO ?');"  --}}
                        <a href="{{ url('inventories/delete/'. $i->id) }}" title="Eliminar" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash" aria-hidden="true"></i>Desincorporar
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-lg-12">
              {{ $stock->links() }}
            </div><!-- /.table-responsive -->
          </div><!-- /.panel-body -->
        </div><!-- /.panel -->
      </div><!-- /.row -->
    </div><!-- /.row -->
@endsection
