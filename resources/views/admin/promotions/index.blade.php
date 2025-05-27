@extends('admin.layout')
@section('title', 'Promociones')
@section('content')
<div class="container-fluid">
    <div class="mb-3 text-end">
        <a href="{{ route('admin.promotions.create') }}" class="btn btn-success">Nueva Promoción</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->title }}</td>
                    <td>{{ $promotion->active ? 'Activa' : 'Inactiva' }}</td>
                    <td>
                        @if($promotion->image_path)
                            <img src="{{ asset('storage/' . $promotion->image_path) }}" width="100">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.promotions.edit', $promotion) }}" class="btn btn-sm btn-primary">Editar</a>
                        <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta promoción?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection