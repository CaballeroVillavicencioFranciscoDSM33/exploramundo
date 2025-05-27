@extends('admin.layout')
@section('title', 'Actividades')
@section('content')
<div class="container-fluid">
    <div class="mb-3 text-end">
        <a href="{{ route('admin.activities.create') }}" class="btn btn-success">Nueva Actividad</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fechas</th>
                <th>Precio</th>
                <th>Popularidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->start_date }} al {{ $activity->end_date }}</td>
                    <td>${{ $activity->price_per_person }}</td>
                    <td>{{ $activity->popularity }}</td>
                    <td>
                        <a href="{{ route('admin.activities.edit', $activity) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta actividad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection