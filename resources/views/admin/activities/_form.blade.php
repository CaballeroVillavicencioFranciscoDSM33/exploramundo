<form method="POST" enctype="multipart/form-data" action="{{ isset($activity) ? route('admin.activities.update', $activity) : route('admin.activities.store') }}">
    @csrf
    @if(isset($activity)) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $activity->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="description" class="form-control" required>{{ old('description', $activity->description ?? '') }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Fecha de inicio</label>
            <input type="date" id="start_date" name="start_date" class="form-control"
                min="{{ now()->addDay()->toDateString() }}"
                value="{{ old('start_date', isset($activity) ? \Illuminate\Support\Carbon::parse($activity->start_date)->format('Y-m-d') : '') }}"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Fecha de fin</label>
            <input type="date" id="end_date" name="end_date" class="form-control"
                value="{{ old('end_date', isset($activity) ? \Illuminate\Support\Carbon::parse($activity->end_date)->format('Y-m-d') : '') }}"
                required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Precio por persona</label>
            <input type="number" name="price_per_person" class="form-control" min="0" step="0.01" value="{{ old('price_per_person', $activity->price_per_person ?? '') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Popularidad</label>
            <input type="number" name="popularity" class="form-control" min="0" value="{{ old('popularity', $activity->popularity ?? 0) }}">
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Imagen (opcional)</label>
            <input type="file" name="image" class="form-control" id="image-input">
            <div class="mt-2">
                <img id="image-preview" src="{{ isset($activity) && $activity->image_path ? asset('storage/' . $activity->image_path) : '' }}" class="img-fluid" style="max-height: 200px;">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        // Vista previa imagen
        if (imageInput && imagePreview) {
            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Actualiza límites cuando cambia fecha de inicio
        function actualizarLimiteFin() {
            if (startDate.value) {
                const fechaInicio = new Date(startDate.value);
                fechaInicio.setDate(fechaInicio.getDate() + 1);
                const minFin = fechaInicio.toISOString().split('T')[0];
                endDate.min = minFin;

                if (endDate.value && endDate.value <= startDate.value) {
                    endDate.value = '';
                }
            }
        }

        // Actualiza límites cuando cambia fecha de fin
        function actualizarLimiteInicio() {
            if (endDate.value) {
                const fechaFin = new Date(endDate.value);
                fechaFin.setDate(fechaFin.getDate() - 1);
                const maxInicio = fechaFin.toISOString().split('T')[0];
                startDate.max = maxInicio;

                if (startDate.value && startDate.value >= endDate.value) {
                    startDate.value = '';
                }
            }
        }

        if (startDate && endDate) {
            startDate.addEventListener('change', function () {
                actualizarLimiteFin();
                actualizarLimiteInicio();
            });

            endDate.addEventListener('change', function () {
                actualizarLimiteInicio();
                actualizarLimiteFin();
            });

            // Ejecutar al cargar
            actualizarLimiteFin();
            actualizarLimiteInicio();
        }
    });
</script>
@endpush
