@extends('admin.layout')
@section('title', 'Nueva Actividad')
@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Crear Nueva Actividad</h3>
    @include('admin.activities._form', ['action' => route('admin.activities.store'), 'method' => 'POST'])
</div>
@endsection
