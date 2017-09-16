@extends('layouts.reportes')

@section('content')
<header>
	<div class="logo">
		<img src="{!! asset('public/img/logo.jpeg') !!}" alt="">
	</div>
</header><!-- /header -->
<hgroup>
	<h3 style="text-align: center;">Servicio Autonomo Hospital Central de Maracay</h3>
	<h3 style="text-align: center;">Departamento de Informatica</h3>
	<h3 style="text-align: center;">Discos Duros Registrados</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Discos:</strong> {{ $HardDrives->count() }}</p>
</div>
<div class="">
	<table>
		<thead>
			<tr>
				<th>Serial</th>
				<th>Capacidad</th>
				<th>Velocidad</th>
				<th>Marca</th>
			</tr>
		</thead>
		<tbody>
			@foreach($HardDrives as $HardDrive)
				<tr>
					<td>{{ $HardDrive->serialH }}</td>
					<td>{{ $HardDrive->capacity }}</td>
					<td>{{ $HardDrive->speed }}</td>
					<td>{{ $HardDrive->Bname }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
