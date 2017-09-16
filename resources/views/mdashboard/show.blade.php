@extends('layouts.mdashboard')

@section('content')
	<div class="row">
		<div class="col-lg-12">
      <h1 class="page-header">Panel Administrativo</h1>
    </div>
  </div>
  <div class="row">
    @foreach($request as $r)
    <div class="panel panel-default">
      <div class="panel-heading">{{ ucwords($r->Uname) }} {{ ucwords($r->lastname) }}</div>
      <div class="panel-body">
        <div>
          <p><strong>Asunto:</strong> {{ ucwords($r->subject) }}</p>
        </div>
        <div>
          <p><strong>Fecha:</strong> {{ $r->created_at }}</p>
        </div>
        <div>
          <p><strong>Departamento:</strong> {{ ucwords($r->department_user) }}</p>
        </div>
        <hr>
        <div>
          <p><strong>Solicitud:</strong> {{ $r->message }}</p>
        </div>
      </div>
    </div>
    @endforeach
	</div>
@endsection