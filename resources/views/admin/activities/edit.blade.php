@extends('admin.layout')
@section('title', 'Editar Actividad')
@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Editar Actividad</h3>
    @include('admin.activities._form', ['action' => route('admin.activities.update', $activity), 'method' => 'PUT', 'activity' => $activity])
</div>
@endsection