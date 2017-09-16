@extends('layouts.mdashboard')

@section('content')
  {{--  Solicitud a Mantenimiento--}}
  <div class="row">
    <div class="col-lg-12"><h1 class="page-header">Responder Solicitud</h1></div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Solicitud
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
      					<table class="table">
      						<thead>
      							<tr>
      								<td style="text-align: center;" colspan="3"><p style="font-weight: bold;">SOLICITUD DE ORDENES DE TRABAJO AL SERVICIO DE MANTENIMIENTO</p></td>
      							</tr>
      						</thead>
      						<tbody>
      							<tr>
      								<td width="560px"><p>SERVICIO: {{ ucwords($request->service) }}</p></td>
      								<td width="560px"><p>AMBIENTE: {{ ucwords($request->environment) }}</p></td>
      								<td width="560px"><p>PISO: {{ ucwords($request->floor) }}</p></td>
      							</tr>
      							<tr>
      								<td colspan="3"><p>DESCRIPCION DEL TRABAJO SOLICITADO:</p></td>
      							</tr>
      							<tr>
      								<td colspan="3" style="border-top: 0px;" ><p style="text-align: justfy;">{{$request->description}}</p></td>
      							</tr>
      							<tr>
      								<td colspan="1"><p>TIPO DE SOLICITUD: {{strtoupper($request->type_request)}}</p> </td>
      								<td><p>SOLICITANTE: {{ ucwords($request->Uname) }} {{ ucwords($request->lastname) }}</p></td>
      							</tr>
                  </table>
                </div>
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

   <div class="row">
     <div class="col-lg-12">
       <div class="panel panel-default">
         <div class="panel-heading">
           Solicitud
           <a href="{{url('mdashboard/computing')}}" class="btn btn-primary btn-sm"><i class="fa fa-history" aria-hidden="true"></i></a>
         </div>
         <div class="panel-body">
           <div class="row">
             <div class="col-lg-6 col-lg-offset-3">
               {!! Form::open(['route' => ['mdashboard.computingResponse', $request->Mid], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormMaintRequest', 'class' => 'form-horizontal']) !!}

               <div class="form-group {{ $errors->has('masonry') ? ' has-error' : '' }}">
                 {!! Form::label('Albañileria') !!}
                 {!! Form::text('masonry', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('masonry'))
                   <span class="help-block">
                     <strong>{{ $errors->first('masonry') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('carpentry') ? ' has-error' : '' }}">
                 {!! Form::label('Carpinteria') !!}
                 {!! Form::text('carpentry', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('carpentry'))
                   <span class="help-block">
                     <strong>{{ $errors->first('carpentry') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('electricity') ? ' has-error' : '' }}">
                 {!! Form::label('Electricidad') !!}
                 {!! Form::text('electricity', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('electricity'))
                   <span class="help-block">
                     <strong>{{ $errors->first('electricity') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('mechanics') ? ' has-error' : '' }}">
                 {!! Form::label('Mecanica') !!}
                 {!! Form::text('mechanics', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('mechanics'))
                   <span class="help-block">
                     <strong>{{ $errors->first('mechanics') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('painting') ? ' has-error' : '' }}">
                 {!! Form::label('Pintura') !!}
                 {!! Form::text('painting', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('painting'))
                   <span class="help-block">
                     <strong>{{ $errors->first('painting') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('plumbing') ? ' has-error' : '' }}">
                 {!! Form::label('Plomeria') !!}
                 {!! Form::text('plumbing', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('plumbing'))
                   <span class="help-block">
                     <strong>{{ $errors->first('plumbing') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('refrigeration') ? ' has-error' : '' }}">
                 {!! Form::label('Refrigeracion') !!}
                 {!! Form::text('refrigeration', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('refrigeration'))
                   <span class="help-block">
                     <strong>{{ $errors->first('refrigeration') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('deposit') ? ' has-error' : '' }}">
                 {!! Form::label('Deposito') !!}
                 {!! Form::text('deposit', null, ['class' => 'form-control', 'autofocus']) !!}
                 @if ($errors->has('deposit'))
                   <span class="help-block">
                     <strong>{{ $errors->first('deposit') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
                 {!! Form::label('Supervisor') !!}
                 <select class="form-control" name="supervisor">
                   <option value=""></option>
                   @foreach ($users as $user)
                     <option value="{{$user->Uname}} {{$user->lastname}}">{{$user->Uname}} {{$user->lastname}}</option>
                   @endforeach
                 </select>
                 @if ($errors->has('supervisor'))
                   <span class="help-block">
                     <strong>{{ $errors->first('supervisor') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group{{ $errors->has('materials_description') ? ' has-error' : '' }}">
                 {!! Form::label('Descripcion Del Material') !!}
                 {!! Form::textarea('materials_description', null, ['class' => 'form-control', 'placeholder' => 'Solicitud', 'value' => '', 'required', 'autofocus', 'rows' => '10']) !!}
                 @if ($errors->has('materials_description'))
                   <span class="help-block">
                     <strong>{{ $errors->first('materials_description') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
                 {!! Form::label('Fecha de Realizacion') !!}
                 {!! Form::date('date', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                 @if ($errors->has('date'))
                   <span class="help-block">
                     <strong>{{ $errors->first('date') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group {{ $errors->has('quantity') ? ' has-error' : '' }}">
                 {!! Form::label('Cantidad de Material') !!}
                 {!! Form::text('quantity', null, ['class' => 'form-control', 'required', 'autofocus']) !!}
                 @if ($errors->has('quantity'))
                   <span class="help-block">
                     <strong>{{ $errors->first('quantity') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group{{ $errors->has('observations') ? ' has-error' : '' }}">
                 {!! Form::label('Observacion') !!}
                 {!! Form::textarea('observations', null, ['class' => 'form-control', 'placeholder' => 'Solicitud', 'value' => '', 'required', 'autofocus', 'rows' => '10']) !!}
                 @if ($errors->has('observations'))
                   <span class="help-block">
                     <strong>{{ $errors->first('observations') }}</strong>
                   </span>
                 @endif
               </div>

               <div class="form-group">
                 <div class="col-md-6" style="margin-top: 20px;">
                   {!! Form::submit('RESPONDER', ['class' => 'btn btn-primary btn-block']) !!}
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
