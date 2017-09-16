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
	<h3 style="text-align: center;">Mantenimientos Registrados</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Mantenimiento:</strong> {{ $maints->count() }}</p>
</div>
<div class="">
	<table>
        <thead>
        	<tr>
            	<th>Equipo</th>
                <th>Serial del Equipo</th>
                <th>Problema</th>
                <th>Solucion</th>
                <th>Fecha de Registro</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($maints as $main)
            <tr>
                <td>{{ $main->type }}</td>
                <td>{{ $main->serial }}</td>
                <td>{{ $main->problem }}</td>
                <td>{{ $main->solution }}</td>
                <td>{{ Carbon\Carbon::parse($main->fecha)->format('d-m-Y H:m:s') }}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
