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
	<h3 style="text-align: center;">Reporte General</h3>
</hgroup>
<div>
	<p><strong>Cantidad Total de Equipo:</strong> {{ $eq->count() }}</p>
</div>
<div class="">
	<table>
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
                {{-- <th>Serial Equipo</th>
                <th>Tipo Equipo</th> --}}
            </tr>
        </thead>
        <tbody>
        @foreach($HardDrives as $HardDrive)
            <tr>
                <td>{{ $HardDrive->serialH }}</td>
                <td>{{ $HardDrive->capacity }}</td>
                <td>{{ $HardDrive->speed }}</td>
                <td>{{ $HardDrive->Bname }}</td>
                {{-- <td>{{ $HardDrive->serial }}</td>
                <td>{{ strtoupper($HardDrive->type) }}</td>         --}}
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

<div>
	<p><strong>Cantidad Total de Impresoras:</strong> {{ $printers->count() }}</p>
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
        @foreach($printers as $printer)
        	<tr>
						<td>{{ $printer->serial }}</td>
						<td>{{ $printer->model }}</td>
						<td>{{ $printer->state_number }}</td>
						<td>{{ $printer->estafamos }}</td>
						<td>{{ $printer->type }}</td>
						<td>{{ $printer->Bname }}</td>
         	</tr>
         @endforeach
        </tbody>
    </table>
</div>

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

<div>
    <p><strong>Cantidad Total de CPU:</strong> {{ $micros->count() }}</p>
</div>
<div class="">
    <table>
        <thead>
            <tr>
                {{-- <th>Equipo</th>
                <th>Marca</th> --}}
                <th>Modelo</th>
                <th>Socket</th>
                <th>Velocidad</th>
            </tr>
        </thead>
        <tbody>
        @foreach($micros as $micro)
            <tr>
                {{-- <td>{{ $micro->type }}</td>
                <td>{{ $micro->brand }}</td> --}}
                <td>{{ $micro->model }}</td>
                <td>{{ $micro->socket }}</td>
                <td>{{ $micro->speed }}</td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

<div>
    <p><strong>Cantidad Total de Tarjetas:</strong> {{ $ms->count() }}</p>
</div>
<div class="">
    <table>
        <thead>
            <tr>
                {{-- <th>Equipo</th>
                <th>Marca</th> --}}
                <th>Serial</th>
                <th>Slot</th>
                <th>Puertos USB</th>
                <th>Tipo Fuente de Poder</th>
            </tr>
        </thead>
        <tbody>
        @foreach($ms as $m)
           <tr>
                {{-- <td>{{ $m->type }}</td>
                <td>{{ $m->brand }}</td> --}}
                <td>{{ $m->serialM }}</td>
                <td>{{ $m->slot }}</td>
                <td>{{ $m->usb }}</td>
                <td>{{ $m->type_source}}</td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

<div>
    <p><strong>Cantidad Total de Tarjetas:</strong> {{ $nets->count() }}</p>
</div>
<div class="">
    <table>
        <thead>
            <tr>
                {{-- <th>Equipo</th>
                <th>Marca</th> --}}
                <th>Tipo de Tarjeta</th>
                <th>Tipo Slot</th>
                <th>Velocidad</th>
            </tr>
        </thead>
        <tbody>
        @foreach($nets as $net)
            <tr>
                {{-- <td>{{ strtoupper($net->Etype) }}</td>
                <td>{{ $net->brand }}</td> --}}
                <td>{{ $net->type_slot}}</td>
                <td>{{ strtoupper($net->type) }}</td>
                <td>{{ $net->speed }}</td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

<div>
    <p><strong>Cantidad Total de Tarjetas:</strong> {{ $rams->count() }}</p>
</div>
<div class="">
    <table>
        <thead>
            <tr>
                {{-- <th>Equipo</th>
                <th>Marca</th> --}}
                <th>Capacidad de Memoria</th>
                <th>Tipo de RAM</th>
                <th>Velocidad</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rams as $ram)
            <tr>
                {{-- <td>{{ strtoupper($ram->Etype) }}</td>
                <td>{{ $ram->brand }}</td> --}}
                <td>{{ $ram->capacity}}</td>
                <td>{{ strtoupper($ram->Rtype) }}</td>
                <td>{{ $ram->speed }}</td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

<div>
    <p><strong>Cantidad Total de Unidades:</strong> {{ $reads->count() }}</p>
</div>
<div class="">
    <table>
        <thead>
            <tr>
                {{-- <th>Equipo</th>
                <th>Marca</th> --}}
                <th>Tipo de Unidad</th>
                <th>Velocidad</th>
            </tr>
        </thead>
        <tbody>
        @foreach($reads as $read)
            <tr>
                {{-- <td>{{ strtoupper($read->Etype) }}</td>
                <td>{{ $read->brand }}</td> --}}
                <td>{{ strtoupper($read->Rtype) }}</td>
                <td>{{ $read->speed }}</td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

<div>
    <p><strong>Cantidad Total de Tarjetas:</strong> {{ $videos->count() }}</p>
</div>
<div class="">
    <table>
        <thead>
            <tr>
                {{-- <th>Equipo</th> --}}
                <th>Tipo</th>
                <th>Memoria</th>
                <th>Ranura</th>
            </tr>
        </thead>
        <tbody>
        @foreach($videos as $video)
            <tr>
                {{-- <td>{{ strtoupper($video->Etype) }}</td> --}}
                <td>{{ strtoupper($video->Vtype) }}</td>
                <td>{{ strtoupper($video->memory) }}</td>
                <td>{{ strtoupper($video->groove) }}</td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>

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
                <td>{{ $main->fecha }}</td>
            </tr>
         @endforeach
        </tbody>
    </table>
</div>
<div id="firma" style="margin-top: 80px; float: right; border-top: 1px solid #000; width: 200px;">
	<p style="text-align: center;">Jefe del Departamento</p>
</div>
@endsection
