@extends('admin.layout')

@section('title', 'Reservas')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Reservas</h2>
        <a href="{{ route('admin.reservations.create') }}" class="btn btn-success">Crear nueva reserva</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Actividad</th>
                    <th>Fecha de Reserva</th>
                    <th>Fecha de Realización</th>
                    <th>Personas</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $index => $reservation)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                    <td>{{ $reservation->activity->title ?? 'N/A' }}</td>
                    <td>{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                    <td>{{ $reservation->execution_date->format('d/m/Y') }}</td>
                    <td>{{ $reservation->people }}</td>
                    <td>${{ number_format($reservation->total_price, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Confirmar eliminación?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
