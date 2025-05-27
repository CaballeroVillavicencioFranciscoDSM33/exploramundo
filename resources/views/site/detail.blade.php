@extends('layouts.app')
@section('title', 'Detalle de actividad')
@section('content')
    <div class="container py-4">
        <h2 class="mb-3">{{ $activity->title }}</h2>
        <p>{{ $activity->description }}</p>

        <p><strong>Fecha disponible:</strong> {{ $activity->start_date }} al {{ $activity->end_date }}</p>
        <p><strong>Precio por persona:</strong> ${{ $activity->price_per_person }}</p>

        <form method="POST" action="{{ route('reservations.store') }}">
            @csrf
            <input type="hidden" name="activity_id" value="{{ $activity->id }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="people" class="form-label">Número de personas</label>
                    <input type="number" name="people" id="people" class="form-control" min="1" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="execution_date" class="form-label">Fecha de realización</label>
                    <input type="date" name="execution_date" class="form-control"
                        min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" max="{{ $activity->end_date }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Total a pagar:</label>
                <input type="text" id="total_price" class="form-control" value="$0.00" disabled>
            </div>

            <button type="submit" class="btn btn-success">Reservar</button>
        </form>

        @if($related->count())
            <hr>
            <h5>Actividades relacionadas disponibles ese día:</h5>
            <div class="row">
                @foreach($related as $rel)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            @if($rel->image_path)
                                <img src="{{ asset('storage/' . $rel->image_path) }}" class="card-img-top" alt="{{ $rel->title }}">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $rel->title }}</h6>
                                <a href="{{ route('activities.show', ['activity' => $rel->id, 'date' => $date]) }}"
                                    class="btn btn-sm btn-outline-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        const pricePerPerson = {{ $activity->price_per_person }};
        const peopleInput = document.getElementById('people');
        const totalPriceField = document.getElementById('total_price');

        function updateTotal() {
            const people = parseInt(peopleInput.value) || 0;
            const total = pricePerPerson * people;
            totalPriceField.value = `$${total.toFixed(2)}`;
        }

        peopleInput.addEventListener('input', updateTotal);
        updateTotal(); // inicial
    </script>
@endsection