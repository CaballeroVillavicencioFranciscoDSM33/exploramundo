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
