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
	<h3 style="text-align: center;">Tarjetas de Red Registradas</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Tarjetas:</strong> {{ $nets->count() }}</p>
</div>
<div class="">
	<table>
        <thead>
        	<tr>
                <th>Marca</th>
                <th>Tipo de Tarjeta</th>
                <th>Tipo Slot</th>
                <th>Velocidad</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($nets as $net)
            <tr>
                <td>{{ $net->brand }}</td>
                <td>{{ strtoupper($net->type) }}</td>
                <td>{{ $net->type_slot}}</td>
                <td>{{ $net->speed }}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
