@extends('layouts.dashboard')

@section('content')

	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Equipo {{ strtoupper($data->Eserial) }}</h1>
    </div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="{{url('inventories')}}" class="btn btn-primary btn-sm"><i class="fa fa-refresh" aria-hidden="true"></i></a>
					{{ strtoupper($data->Eserial) }}
				</div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-responsive">
              <thead>
                <tr>
                  <th>Equipo</th>
                  <th>Serial</th>
                  <th>Departamento</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $data->type }}</td>
                  <td>{{ $data->Eserial }}</td>
                  <td>{{ ucwords($data->nameD) }}</td>
                </tr>
                <tr>
                  <th colspan="3" style="border: none;">NOTA</th>
                </tr>
                <tr>
                  <td>{{ $data->description }}</td>
                </tr>
                <tr>
                  <th style="border: none; text-align:center;" colspan="3">COMPONENTES</th>
                </tr>
								<tr>
                  <th colspan="3">MONITOR</th>
                </tr>
                <tr>
                  <th style="border: none;">Serial</th>
                  <th style="border: none;">Numero Estadal</th>
                  <th style="border: none;">Marca</th>
                </tr>
                <tr>
									@if($data->t_c_registered == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
	                  <td style="border: none;">{{ $data->t_c_serial }}</td>
	                  <td style="border: none;">{{ $data->state_number}}</td>
	                  <td style="border: none;">{{ $data->t_cb_Bname }}</td>
									@endif
                </tr>
								<tr>
									<th colspan="3">TECLADO</th>
								</tr>
								<tr>
									<th style="border: none;">Serial</th>
									<th style="border: none;">B. Nacional</th>
									<th style="border: none;">Marca</th>
								</tr>
								<tr>
									@if($data->t_k_other_reg == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ $data->t_k_other_serial }}</td>
										<td style="border: none;">{{ $data->t_k_other_number}}</td>
										<td style="border: none;">{{ $data->t_k_other_Bname }}</td>
									@endif
								</tr>
								<tr>
									<th colspan="3">MOUSE</th>
								</tr>
								<tr>
									<th style="border: none;">Serial</th>
									<th style="border: none;">B. Nacional</th>
									<th style="border: none;">Marca</th>
								</tr>
								<tr>
									@if($data->t_m_other_reg == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ $data->t_m_other_serial }}</td>
										<td style="border: none;">{{ $data->t_m_other_number}}</td>
										<td style="border: none;">{{ $data->t_m_other_Bname }}</td>
									@endif
								</tr>
                <tr>
                  <th colspan="3">DISCO DURO</th>
                </tr>
                <tr>
                  <th style="border: none;">Serial</th>
                  <th style="border: none;">Capacidad</th>
                  <th style="border: none;">Marca</th>
                </tr>
                <tr>
									@if($data->Hregistered == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
	                  <td style="border: none;">{{ $data->serialH }}</td>
	                  <td style="border: none;">{{ $data->capacity }}</td>
	                  <td style="border: none;">{{ $data->Dname }}</td>
									@endif
                </tr>
                <tr>
                  <th colspan="3">CPU</th>
                </tr>
                <tr>
                  <th style="border: none;">Marca</th>
                  <th style="border: none;">Modelo</th>
                  <th style="border: none;">Socket</th>
                </tr>
                <tr>
									@if($data->Mregistered == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ ucwords($data->CBrand) }}</td>
	                  <td style="border: none;">{{ ucwords($data->CModel) }}</td>
	                  <td style="border: none;">{{ $data->socket }}</td>
									@endif
                </tr>
                <tr>
                  <th colspan="3">TARJETA MADRE</th>
                </tr>
                <tr>
                  <th style="border: none;">Serial</th>
                  <th style="border: none;">Slot</th>
                  <th style="border: none;">Tipo de Fuente</th>
                </tr>
                <tr>
									@if($data->registeredM == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ $data->serialM }}</td>
	                  <td style="border: none;">{{ $data->slot }}</td>
	                  <td style="border: none;">{{ $data->type_source }}</td>
									@endif
                </tr>
                <tr>
                  <th colspan="3">TARJETA DE RED</th>
                </tr>
                <tr>
                  <th style="border: none;">Tipo</th>
                  <th style="border: none;">Tipo Slot</th>
                  <th style="border: none;">Velocidad</th>
                </tr>
                <tr>
									@if($data->Nregistered == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ ucwords($data->typeNet) }}</td>
	                  <td style="border: none;">{{ $data->slotNet }}</td>
	                  <td style="border: none;">{{ $data->speedNet }}</td>
									@endif
                </tr>
                <tr>
                  <th colspan="3">UNDAD LECTORA</th>
                </tr>
                <tr>
                  <th style="border: none;">Tipo</th>
                  <th style="border: none;">Velocidad</th>
									<th style="border: none;">Marca</th>
                </tr>
                <tr>
									@if($data->registeredR == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ strtoupper($data->typeR) }}</td>
	                  <td style="border: none;">{{ $data->speedR }}</td>
										<td style="border: none;">{{ $data->RDname}}</td>
									@endif
                </tr>
                <tr>
                  <th colspan="3">MEMORA DE VIDEO</th>
                </tr>
                <tr>
                  <th style="border: none;">Tipo</th>
                  <th style="border: none;">Memoria</th>
                  <th style="border: none;">Ranura</th>
                </tr>
                <tr>
									@if($data->Vregistered == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ ucwords($data->typeV) }}</td>
	                  <td style="border: none;">{{ $data->memoryV }}</td>
	                  <td style="border: none;">{{ $data->groove }}</td>
									@endif
                </tr>
                <tr>
                  <th colspan="3">MEMORA RAM</th>
                </tr>
                <tr>
                  <th style="border: none;">Tipo</th>
                  <th style="border: none;">Memoria</th>
									<th style="border: none;">Marca</th>
                </tr>
                <tr>
									@if($data->Rregistered == 0)
										<td colspan="3" style="text-align:center;">NO EQUIPADO</td>
									@else
										<td style="border: none;">{{ ucwords($data->Rtype) }}</td>
	                  <td style="border: none;">{{ $data->Rmemory }}</td>
										<td style="border: none;">{{ $data->Rname }}</td>
									@endif
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
     </div>
   </div>
	<!-- /.row -->
@endsection
