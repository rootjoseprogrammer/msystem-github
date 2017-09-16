@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row" style="margin-top: 20px;">
      <div class="col-md-2 col-lg-2 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">Acciones</div>
          <div class="panel-body">
            <a href="{{url('/home')}}" class="btn btn-lg btn-default btn-block">Solicitud</a>
            <a href="{{url('/history')}}" class="btn btn-lg btn-default btn-block">Historial</a>
          </div>
        </div>
      </div>
        <div class="col-md-10 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">SISTEMA H.C.M. S.A.</div>

                <div class="panel-body">
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table id="DataTableApplications" class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Asunto</th>
                                      <th>Solicitud</th>
                                      <th>Fecha de Solicitud</th>
  																		<th>Trabajo Finalizado</th>
                                      <th>Solicitud A</th>
  																		<th>Status</th>
                                      <th>Opcion</th>
                                  </tr>
                              </thead>
                              <tbody>
                              @foreach($msm as $m)
                                	<tr>
                                      <td>{{ $m->Aid }}</td>
                                      <td>{{ ucwords($m->subject) }}</td>
                                      <td>{{ $m->message }}</td>
                                      <td>{{ Carbon\Carbon::parse($m->created_at)->format('d-m-Y H:m:s') }}</td>
  																		<td>
  																			@if($m->completed_work == null)
  																				0
  																			@else
  																			{{ Carbon\Carbon::parse($m->completed_work)->format('d-m-Y') }}
  																		@endif
  																		</td>
                                      <td>{{ucwords($m->Dname)}}</td>
  																		<td>{{$m->status}}</td>
                                      <td>
                                      	<a href="{{ url('show/'.$m->Aid)}}" title="Ver" class="btn btn-primary btn-sm">
  																				<i class="fa fa-eye" aria-hidden="true"></i>
                                      		Ver
  																			</a>
                                          {{-- <a onclick="return confirm('DESEA BORRAR REGISTRO ?');" href="{{ url('dashboard/destroy/'. $m->Aid) }}" title="Eliminar" class="btn btn-danger btn-sm">
                                              <i class="fa fa-trash" aria-hidden="true"></i>
                                              Eliminar
  																					</a> --}}


                                      </td>
                                  </tr>
                               @endforeach
                              </tbody>
                          </table>
                      </div>
                      <div class="col-lg-12">
                      	{{ $msm->links() }}
                      </div>
                      <!-- /.table-responsive -->
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
