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
	<h3 style="text-align: center;">Tarjetas Madres Registradas</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Tarjetas:</strong> {{ $ms->count() }}</p>
</div>
<div class="">
	<table>
        <thead>
        	<tr>
                <th>Marca</th>
                <th>Serial</th>
                <th>Slot</th>
                <th>Puertos USB</th>
                <th>Tipo Fuente de Poder</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($ms as $m)
           <tr>
                <td>{{ $m->brand }}</td>
                <td>{{ $m->serialM }}</td>
                <td>{{ $m->slot }}</td>
                <td>{{ $m->usb }}</td>
                <td>{{ $m->type_source}}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
