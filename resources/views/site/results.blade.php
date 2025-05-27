@extends('layouts.app')
@section('title', 'Resultados de búsqueda')
@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Resultados para {{ $date }} ({{ $people }} personas)</h2>

        @forelse($activities as $activity)
            <div class="card mb-4" style="max-width: 800px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $activity->image_path) }}" class="img-fluid rounded-start"
                            style="width: 100%; max-width: 250px; height: 180px; object-fit: cover;"
                            alt="Imagen de {{ $activity->title }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $activity->title }}</h5>
                            <p class="card-text">
                                <strong>Precio por persona:</strong> ${{ $activity->price_per_person }}<br>
                            </p>
                            <a href="{{ route('activities.show', ['activity' => $activity->id, 'date' => $date]) }}"
                                class="btn btn-primary">Ver detalle</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No se encontraron actividades para esa fecha.</p>
        @endforelse

        <div class="mt-4">
            {{ $activities->withQueryString()->links() }}
        </div>
    </div>
@endsection