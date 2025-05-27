<form method="POST" enctype="multipart/form-data"
    action="{{ isset($promotion) ? route('admin.promotions.update', $promotion) : route('admin.promotions.store') }}">
    @csrf
    @if(isset($promotion)) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $promotion->title ?? '') }}"
            required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="description"
            class="form-control">{{ old('description', $promotion->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen (opcional)</label>
        <input type="file" name="image" class="form-control" id="image-input">
        <div class="mt-2">
            <img id="image-preview"
                src="{{ isset($promotion) && $promotion->image_path ? asset('storage/' . $promotion->image_path) : '' }}"
                class="img-fluid" style="max-height: 200px;">
        </div>
    </div>

    <input type="hidden" name="active" value="0">

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ old('active', $promotion->active ?? false) ? 'checked' : '' }}>
        <label class="form-check-label" for="active">Activar promoción</label>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image-input');
            const preview = document.getElementById('image-preview');

            if (input && preview) {
                input.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            preview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endpush