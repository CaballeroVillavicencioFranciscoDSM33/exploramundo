@extends('admin.layout')
@section('title', 'Editar Promoción')
@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Editar Promoción</h3>
    @include('admin.promotions._form', ['action' => route('admin.promotions.update', $promotion), 'method' => 'PUT', 'promotion' => $promotion])
</div>
@endsection
