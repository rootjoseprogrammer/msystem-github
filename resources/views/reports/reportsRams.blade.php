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
	<h3 style="text-align: center;">Tarjetas Ram Registradas</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Tarjetas:</strong> {{ $rams->count() }}</p>
</div>
<div class="">
	<table>
        <thead>
        	<tr>
                <th>Marca</th>
                <th>Capacidad de Memoria</th>
                <th>Tipo de RAM</th>
                <th>Velocidad</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($rams as $ram)
            <tr>
                <td>{{ $ram->brand }}</td>
                <td>{{ $ram->capacity}}</td>
                <td>{{ strtoupper($ram->Rtype) }}</td>
                <td>{{ $ram->speed }}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
