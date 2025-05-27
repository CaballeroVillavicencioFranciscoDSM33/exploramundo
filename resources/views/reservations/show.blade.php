@extends('layouts.app')

@section('title', 'Detalle de Reserva')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detalle de Reserva</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Actividad: {{ $reservation->activity->title }}</h5>
            <p class="card-text">Descripción: {{ $reservation->activity->description }}</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Fecha de reserva:</strong> {{ $reservation->reservation_date->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Fecha de realización:</strong> {{ $reservation->execution_date->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Personas:</strong> {{ $reservation->people }}</li>
                <li class="list-group-item"><strong>Total pagado:</strong> ${{ number_format($reservation->total_price, 2) }}</li>
            </ul>
            <a href="{{ route('reservations.index') }}" class="btn btn-secondary mt-3">Volver a mis reservas</a>
        </div>
    </div>
</div>
@endsection
