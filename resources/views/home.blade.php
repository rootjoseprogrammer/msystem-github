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
        <div class="col-md-10 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">SISTEMA H.C.M. S.A.</div>

                <div class="panel-body">

                    {!! Form::open(['route' => 'applications.store', 'method' => 'POST', 'class' => '', 'role' => 'form']) !!}

                        <div class="form-group{!! $errors->has('subject') ? ' has-error' : '' !!}">

                            {!! Form::label('subject', 'Asunto', ['class' => 'col-md-2 control-label']) !!}

                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Asunto..', 'value' => '', 'required', 'autofocus']) !!}
                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{!! $errors->first('subject') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">

                            {!! Form::label('message', 'Solicitud', ['class' => 'col-md-2 control-label']) !!}

                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Solicitud', 'value' => '', 'required', 'autofocus', 'rows' => '10']) !!}

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('Departamento') !!}

                                <select name="department_id" class="form-control">
                                    <option value="default">SELECCIONE DEPARTAMENTO</option>
                                    @foreach($departments as $data)
                                        <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {!! Form::hidden('user_id', Auth::user()->id ) !!}

                        <div class="form-group">
                            <div class="col-md-12 col-lg-12 col-xs-12" style="margin-top: 20px;">
                                {!! Form::submit('ENVIAR', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
