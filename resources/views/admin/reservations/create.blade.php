@extends('admin.layout')
@section('title', 'Crear Reserva')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Crear nueva reserva</h2>
    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf
        @include('admin.reservations._form', ['reservation' => new \App\Models\Reservation])
    </form>
</div>
@endsection