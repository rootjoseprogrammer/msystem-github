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
	<h3 style="text-align: center;">Monitor Registrados</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Monitores:</strong> {{ $displays->count() }}</p>
</div>
<div class="">
	<table class="table">
        <thead>
        	<tr>
						<th>Serial</th>
						<th>Modelo</th>
						<th>Bien Estadal</th>
						<th>Estafamos</th>
						<th>Tipo</th>
						<th>Marca</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($displays as $display)
        	<tr>
						<td>{{ $display->serial }}</td>
						<td>{{ $display->model }}</td>
						<td>{{ $display->state_number }}</td>
						<td>{{ $display->estafamos }}</td>
						<td>{{ $display->type }}</td>
						<td>{{ $display->Bname }}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
