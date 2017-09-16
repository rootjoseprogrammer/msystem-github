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
	<h3 style="text-align: center;">Equipos Registrados</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Equipo:</strong> {{ $eq->count() }}</p>
</div>
<div class="">
	<table class="table">
        <thead>
        	<tr>
            	<th>Serial</th>
            	<th>IP</th>
            	<th>Tipo de Equipo</th>
            	<th>Departamento</th>
            	<th>Marca</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($eq as $e)
        	<tr>
             	<td>{{ $e->serial }}</td>
             	<td>{{ $e->IP }}</td>
             	<td>{{ $e->type }}</td>
             	<td>{{ $e->Dname}}</td>
             	<td>{{ $e->Bname}}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
