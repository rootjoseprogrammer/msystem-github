@extends('layouts.reportes')

@section('content')
<header>
	<div class="logo">
		<img src="{!! asset('public/img/logo.jpeg') !!}" alt="">
	</div>
</header><!-- /header -->
<hgroup>
	<h1 style="text-align: center;">Servicio Autonomo Hospital Central de Maracay</h3>
	<h2 style="text-align: center;">Departamento de Informatica</h3>
	<h3 style="text-align: center;">Microprocesadores Registrados</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de CPU:</strong> {{ $micros->count() }}</p>
</div>
<div class="">
	<table>
        <thead>
        	<tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Socket</th>
                <th>Velocidad</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($micros as $micro)
          	<tr>
               	<td>{{ $micro->brand }}</td>
               	<td>{{ $micro->model }}</td>
               	<td>{{ $micro->socket }}</td>
               	<td>{{ $micro->speed }}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
