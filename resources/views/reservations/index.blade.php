@extends('layouts.app')

@section('title', 'Mis Reservas')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Mis Reservas</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($reservations->count())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Actividad</th>
                            <th>Fecha de reserva</th>
                            <th>Fecha de realización</th>
                            <th>Personas</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->activity->title }}</td>
                                <td>{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                                <td>{{ $reservation->execution_date->format('d/m/Y') }}</td>
                                <td>{{ $reservation->people }}</td>
                                <td>${{ number_format($reservation->total_price, 2) }}</td>
                                <td>
                                    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-primary">Ver</a>
                                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Estás seguro de cancelar esta reserva?')">Cancelar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No tienes reservas aún.</p>
        @endif
    </div>
@endsection