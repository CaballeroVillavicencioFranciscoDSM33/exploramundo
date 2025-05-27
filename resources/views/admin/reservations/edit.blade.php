@extends('admin.layout')
@section('title', 'Editar Reserva')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar reserva</h2>
    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.reservations._form', ['reservation' => $reservation])
    </form>
</div>
@endsection