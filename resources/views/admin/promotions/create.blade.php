@extends('admin.layout')
@section('title', 'Nueva Promoción')
@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Crear Nueva Promoción</h3>
    @include('admin.promotions._form', ['action' => route('admin.promotions.store'), 'method' => 'POST'])
</div>
@endsection
