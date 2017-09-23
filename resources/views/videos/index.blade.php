@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Informacion de Memoria de Video</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

	<div class="row">
        <div class="col-lg-12">
        	<div class="panel panel-default">
                <div class="panel-heading">
                    Memoria de Video
										<a href="{{url('videos')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                </div>
                <!-- /.panel-heading -->

            	<div class="row">
				  <div class="col-lg-6 pull-right">
				  {!! Form::open(['route' => 'videos.index', 'method' => 'GET']) !!}
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
                                    <th>Tipo</th>
                                    <th>Memoria</th>
                                    <th>Ranura</th>
                                    <th width="180">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $video)
                              	<tr>
                                    <td>{{ $video->Vid }}</td>
                                    <td>
																			@if($video->registered == 1)
																				Ya Equipado
																			@else
																				No Equipado
																			@endif
																		</td>
                                    <td>{{ strtoupper($video->Vtype) }}</td>
                                    <td>{{ strtoupper($video->memory) }}</td>
                                    <td>{{ strtoupper($video->groove) }}</td>
                                    <td width="200px" style="text-align: center;">
                                    	<a href="{{ url('videos/'.$video->Vid.'/edit')}}" title="Editar" class="btn btn-warning btn-sm">
                                    		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    		Editar</a>
																				{{-- onclick="return confirm('DESEA BORRAR REGISTRO ?');" --}}
                                    	<a  href="{{ url('videos/delete/'. $video->Vid) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                    		<i class="fa fa-trash" aria-hidden="true"></i>
                                    		Desincorporar</a>

                                    </td>
                                </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                    	{{ $videos->links() }}
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
