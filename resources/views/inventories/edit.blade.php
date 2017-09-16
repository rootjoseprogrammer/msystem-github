@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
            <h1 class="page-header">Inventario</h1>
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Editar del Inventario</div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              {!! Form::open(['route' => ['inventories.update', $i->Eid], 'method' => 'PUT', 'role' => 'form', 'id' => 'FormInventAdd', 'class'=> 'form-horizontal']) !!}

              <div class="form-group">
                {!! Form::label('Serial', 'Serial', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									{!! Form::text('serial', $i->Eserial, ['class' => 'form-control', 'required', 'autofocus']) !!}
								</div>

								{{--  DISCO DURO --}}
								{!! Form::label('Disco Duro', 'Disco Duro', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									<select name="hd_id" class="form-control">
											<option value="{{ $i->Hid }}" selected="selected">SERIAL:{{ strtoupper($i->serialH) }} &nbsp;&nbsp;TIPO:{{ strtoupper($i->capacity) }}</option>
											@foreach($hd as $data)
													<option value="{{ $data->Hid }}">SERIAL:{{ strtoupper($data->serialH) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->capacity) }}</option>
											@endforeach
									</select>
								</div>
              </div>

              <div class="form-group">
                {!! Form::label('IP', 'IP', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									{!! Form::text('ip', $i->IP, ['class' => 'form-control', 'required', 'autofocus']) !!}
								</div>

								{{-- RAM --}}
									{!! Form::label('RAM', 'RAM', ['class' => 'control-label col-lg-1']) !!}
									<div class="col-lg-4">
										<select name="ram_id" class="form-control">
												<option value="{{ $i->ramId }}">MARCA:{{ strtoupper($i->Rname) }} &nbsp;&nbsp;TIPO:{{ strtoupper($i->Rtype) }}</option>
												@foreach($rams as $data)
														<option value="{{ $data->id }}">MARCA:{{ strtoupper($data->brand) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->Rtype) }}</option>
												@endforeach
										</select>

									</div>
              </div>

              <div class="form-group">
                {!! Form::label('Tipo', 'Tipo', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									{!! Form::text('type', $i->type, ['class' => 'form-control', 'required', 'autofocus']) !!}
								</div>

								{{--  VIDEO --}}
								{!! Form::label('Video', 'Video', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									<select name="video_id" class="form-control">
											<option value="{{ $i->Vid }}">RANURA:{{ strtoupper($i->groove) }} &nbsp;&nbsp;TIPO:{{ strtoupper($i->typeV) }}&nbsp;&nbsp;MEMORIA:{{ strtoupper($i->memoryV) }}</option>
											@foreach($videos as $data)
													<option value="{{ $data->id }}">RANURA:{{ strtoupper($data->groove) }} &nbsp;&nbsp;TIPO:{{ strtoupper($data->Vtype) }}&nbsp;&nbsp;MEMORIA:{{ strtoupper($data->memory) }}</option>
											@endforeach
									</select>
								</div>
              </div>

              <div class="form-group">
                {!! Form::label('Departamento', 'Departamento', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									<select name="department_id" class="form-control">
	                  <option value="{{ $i->department_id }}">{{ strtoupper($i->nameD) }}</option>
	                  @foreach($departments as $data)
	                    <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
	                  @endforeach
	                </select>
								</div>

								{{-- MOTHERBOARD --}}
									{!! Form::label('Tarjeta Madre', 'Tarjeta Madre', ['class' => 'control-label col-lg-1']) !!}
									<div class="col-lg-4">
										<select name="ms_id" class="form-control">
												<option value="{{ $i->Mid }}">MARCA:{{ strtoupper($i->Mname) }} &nbsp;&nbsp;SERIAL:{{ strtoupper($i->serialM) }}</option>
												@foreach($ms as $data)
														<option value="{{ $data->id }}">MARCA:{{ strtoupper($data->brand) }} &nbsp;&nbsp;SERIAL:{{ strtoupper($data->serialM) }}</option>
												@endforeach
										</select>

									</div>
              </div>

              <div class="form-group">
                {!! Form::label('Marca', 'Marca', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									<select name="brand_id" class="form-control">
	                  <option value="{{ $i->EBid }}">{{ strtoupper($i->EBname) }}</option>
	                  @foreach($brands as $data)
	                    <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
	                  @endforeach
	                </select>
								</div>

								{{--  READRIVERS --}}
								{!! Form::label('Unidad Lectora', 'Unidad Lectora', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									<select name="rd_id" class="form-control">
											<option value="{{ $i->Rid }}">TIPO:{{ strtoupper($i->typeR) }} &nbsp;&nbsp;MARCA:{{ strtoupper($i->RDname) }}</option>
											@foreach($rd as $data)
													<option value="{{ $data->id }}">TIPO:{{ strtoupper($data->Rtype) }} &nbsp;&nbsp;MARCA:{{ strtoupper($data->brand) }}</option>
											@endforeach
									</select>
								</div>
							</div>

					<div class="form-group">
						{{-- CPU --}}
							{!! Form::label('CPU', 'CPU', ['class' => 'control-label col-lg-1']) !!}
							<div class="col-lg-4">
								<select name="cpu_id" class="form-control">
										<option value="{{ $i->Cid }}">MARCA:{{ strtoupper($i->CBrand) }} &nbsp;&nbsp;MODELO:{{ strtoupper($i->CModel) }} &nbsp;&nbsp;SOCKET:{{ strtoupper($i->socket) }}</option>
										@foreach($cpu as $data)
												<option value="{{ $data->id }}">MARCA:{{ strtoupper($data->brand) }} &nbsp;&nbsp;MODELO:{{ strtoupper($data->model) }} &nbsp;&nbsp;SOCKET:{{ strtoupper($data->socket) }}</option>
										@endforeach
								</select>

							</div>
							{{--  RED --}}
							{!! Form::label('RED', 'RED', ['class' => 'control-label col-lg-1']) !!}
							<div class="col-lg-4">
								<select name="net_id" class="form-control">
										<option value="{{ $i->Netid }}">TIPO:{{ strtoupper($i->typeNet) }} &nbsp;&nbsp; SLOT:{{ strtoupper($i->slotNet) }} &nbsp;&nbsp;MARCA:{{ strtoupper($i->Netname) }}</option>
										@foreach($net as $data)
												<option value="{{ $data->id }}">TIPO:{{ strtoupper($data->type) }} &nbsp;&nbsp; SLOT:{{ strtoupper($data->type_slot) }} &nbsp;&nbsp;MARCA:{{ strtoupper($data->brand) }}</option>
										@endforeach
								</select>
							</div>
					</div>
					{{--  MOTIVO DEL PORQUE EDITA EL INVENTARIO--}}
					<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
						<div class="form-group {{ $errors->has('reason') ? ' has-error' : '' }}">
								{!! Form::label('Motivo', 'Motivo', ['class' => 'control-label col-lg-1']) !!}
								<div class="col-lg-4">
									{!! Form::textarea('reason', null, ['class' => 'form-control', 'required', 'autofocus', 'rows' => '4']) !!}
									@if ($errors->has('reason'))
											<span class="help-block">
													<strong>{{ $errors->first('reason') }}</strong>
											</span>
									@endif
								</div>
						</div>

					</div>
							<div class="row" style="margin-top: 50px;">
								 <div class="col-md-2 col-lg-2" >
									 {!! Form::submit('EDITAR', ['class' => 'btn btn-warning btn-block']) !!}
								  </div>
								</div>

								{{--  ID DE LOS COMPONENTES ANTERIORES --}}
								{!! Form::hidden('user_id', Auth::user()->id ) !!}
								{!! Form::hidden('hd_id_old', $i->Hid ) !!}
								{!! Form::hidden('ram_id_old', $i->ramId ) !!}
								{!! Form::hidden('video_id_old', $i->Vid ) !!}
								{!! Form::hidden('ms_id_old', $i->Mid ) !!}
								{!! Form::hidden('rd_id_old', $i->Rid ) !!}
								{!! Form::hidden('cpu_id_old', $i->Cid ) !!}
								{!! Form::hidden('net_id_old', $i->Netid ) !!}

								{!! Form::close() !!}
							</div><!-- /.col-lg-6 (nested) -->
						</div><!-- /.row (nested) -->
					</div><!-- /.panel-body -->
				</div><!-- /.panel -->
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->
@endsection























{{--
<form class="form-inline" role="form">

   <div class="form-group">
      <label for="email">Email</label>
	  <input type="email" class="form-control" id="email" placeholder="Enter email">
 </div>
   <div class="form-group">
      <label for="pwd">Password</label>
	  <input type="password" class="form-control" id="pwd" placeholder="Enter password">
   </div>
   <button type="submit" class="btn btn-default">Register</button>
</form> --}}
