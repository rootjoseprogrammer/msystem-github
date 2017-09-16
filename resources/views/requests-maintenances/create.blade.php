@extends('layouts.dashboard')

@section('content')
  {{--  Solicitud a Mantenimiento--}}
  <div class="row">
    <div class="col-lg-12"><h1 class="page-header">Solicitud a Mantenimiento</h1></div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Solicitud
          <a href="{{url('requests-maintenances')}}" class="btn btn-primary btn-sm"><i class="fa fa-history" aria-hidden="true"></i></a>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
              {!! Form::open(['route' => 'requests-maintenances.store', 'method' => 'POST', 'role' => 'form', 'id' => 'FormMaintRequest']) !!}

              <div class="form-group {{ $errors->has('service') ? ' has-error' : '' }}">
                {!! Form::label('Servicio') !!}
                {!! Form::text('service', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                @if ($errors->has('service'))
                  <span class="help-block">
                    <strong>{{ $errors->first('serial') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('environment') ? ' has-error' : '' }}">
                {!! Form::label('Ambiente') !!}
                {!! Form::text('environment', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                @if ($errors->has('environment'))
                  <span class="help-block">
                    <strong>{{ $errors->first('serial') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group {{ $errors->has('floor') ? ' has-error' : '' }}">
                {!! Form::label('Piso') !!}
                {!! Form::text('floor', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                @if ($errors->has('floor'))
                  <span class="help-block">
                    <strong>{{ $errors->first('serial') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('Descripcion Del Trabajo Solicitado') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Solicitud', 'value' => '', 'required', 'autofocus', 'rows' => '10']) !!}
                @if ($errors->has('description'))
                  <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('type_request') ? ' has-error' : '' }}">
                {!! Form::label('Tipo de Solicitud') !!}
                <select class="form-control" name="type_request">
                  <option value=""></option>
                  <option value="urgente">Urgente</option>
                  <option value="normal">Normal</option>
                </select>
                @if ($errors->has('type_request'))
                  <span class="help-block">
                    <strong>{{ $errors->first('type_request') }}</strong>
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
            <!-- /.col-lg-6 (nested) -->
          </div>
          <!-- /.row (nested) -->
         </div>
         <!-- /.panel-body -->
       </div>
       <!-- /.panel -->
     </div>
     <!-- /.col-lg-12 -->
   </div>
   <!-- /.row -->
@endsection
