@extends('layouts.app')

@section('content')

<div class="container">

    <!--<div class="row">
        <div class="col-lg-2">
            <a href="{{ url('applications')}}" title="" class="btn btn-default btn-block">Solicitudes</a>
        </div>
    </div>-->
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
        <div class="col-md-10 col-lg-10 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">SISTEMA H.C.M. S.A.</div>
                <div class="panel-body">
                  @foreach($request as $r)
                    <div>
                      <p><strong>Asunto:</strong> {{ ucwords($r->subject) }}</p>
                    </div>
                    <div>
                      <p><strong>Fecha:</strong> {{ Carbon\Carbon::parse($r->created_at)->format('d-m-Y H:m:s') }}</p>
                    </div>
                    <div>
                      <p><strong>Departamento:</strong> {{ ucwords($r->Dname) }}</p>
                    </div>
                    <div>
                      <p><strong>Status:</strong> {{ ucwords($r->status) }}</p>
                    </div>
                    @if($r->completed_work != null)
                      <div>
                        <p><strong>Finalizado el Dia:</strong> {{ Carbon\Carbon::parse($r->completed_work)->format('d-m-Y') }}</p>
                      </div>
                    @endif
                    <hr>
                    <div>
                      <p><strong>Solicitud:</strong> {{ $r->message }}</p>
                    </div>
                    <hr>
                    <div>
                      <p><strong>Respuesta:</strong> {{ $r->answer }}</p>
                    </div>
                    <hr>
                    @if($r->according != null)
                      <div>
                        <p><strong>Conforme:</strong> {{ $r->according }}</p>
                      </div>
                    @endif
                    @if($r->according == null)
              				<div class="col-lg-12">
              					{!! Form::open(['route' => ['applications.update', $r->id], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormAddResponse']) !!}

              					<div class="form-group {{ $errors->has('according') ? ' has-error' : '' }}">
              						{!! Form::label('Conforme') !!}
              						{!! Form::textarea('according', null, ['class' => 'form-control', 'required', 'autofocus', 'rows' =>5]) !!}
              						@if ($errors->has('according'))
              							<span class="help-block">
              								<strong>{{ $errors->first('according') }}</strong>
              							</span>
              						@endif
              					</div>

              					<div class="form-group">
              						<div class="col-md-6" style="margin-top: 20px;">
              							{!! Form::submit('ENVIAR', ['class' => 'btn btn-primary btn-block']) !!}
              						</div>
              					</div>
              					{!! Form::close() !!}
              				</div>
              			</div>
              		@endif
              	   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
