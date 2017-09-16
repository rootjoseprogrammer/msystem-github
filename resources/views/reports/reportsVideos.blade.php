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
	<h3 style="text-align: center;">Tarjetas de Video Registradas</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Tarjetas:</strong> {{ $videos->count() }}</p>
</div>
<div class="">
	<table>
        <thead>
        	<tr>
                <th>Tipo</th>
                <th>Memoria</th>
                <th>Ranura</th>
        	</tr>
        </thead>
        <tbody>
        @foreach($videos as $video)
            <tr>
                <td>{{ strtoupper($video->Vtype) }}</td>
                <td>{{ strtoupper($video->memory) }}</td>
                <td>{{ strtoupper($video->groove) }}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 100px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
