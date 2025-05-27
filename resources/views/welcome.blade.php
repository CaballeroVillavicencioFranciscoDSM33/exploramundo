@extends('layouts.app')

@section('title', 'ExploraMundo')

@section('content')
    @if($promotions->count())
        <div class="container mb-5">
            <div class="swiper mySwiper shadow rounded">
                <div class="swiper-wrapper">
                    @foreach($promotions as $promo)
                        <div class="swiper-slide">
                            <div class="position-relative w-100" style="height: 400px; overflow: hidden;">
                                <img src="{{ $promo->image_path ? asset('storage/' . $promo->image_path) : 'https://via.placeholder.com/1200x400/6c757d/ffffff?text=' . urlencode($promo->title) }}"
                                    alt="{{ $promo->title }}" class="w-100 h-100" style="object-fit: cover;">

                                <div class="position-absolute bottom-0 start-0 w-100 px-4 py-3 d-flex align-items-end"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); height: 100%;">
                                    <h3 class="text-white fw-bold m-0" style="text-shadow: 1px 1px 5px rgba(0,0,0,0.8);">
                                        {{ $promo->title }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    new Swiper('.mySwiper', {
                        loop: true,
                        autoplay: {
                            delay: 4500,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        effect: 'slide',
                        speed: 800,
                    });
                });
            </script>
        @endpush
    @endif

    <div class="text-center mb-5">
        <h1 class="fw-bold">ExploraMundo</h1>
        <p class="lead">Descubre y reserva experiencias inolvidables.</p>
        <p class="text-muted">Desde playas hasta montañas, tenemos lo que buscas.</p>
    </div>

    <div class="container">
        <form action="{{ route('activities.search') }}" method="GET" onsubmit="return validarBusqueda()">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="date" class="form-label">Fecha</label>
                    <input type="date" name="date" id="date" class="form-control"
                        min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" required>
                </div>
                <div class="col-md-3">
                    <label for="people" class="form-label">Número de personas</label>
                    <input type="number" name="people" id="people" class="form-control" min="1" required>
                </div>
                <div class="col-md-2">
                    <label for="price_min" class="form-label">Precio mínimo</label>
                    <input type="number" name="price_min" id="price_min" class="form-control" min="0" required>
                </div>
                <div class="col-md-2">
                    <label for="price_max" class="form-label">Precio máximo</label>
                    <input type="number" name="price_max" id="price_max" class="form-control" min="1" required>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function validarBusqueda() {
            const minPrice = parseFloat(document.getElementById('price_min').value);
            const maxPrice = parseFloat(document.getElementById('price_max').value);

            if (isNaN(minPrice) || isNaN(maxPrice)) {
                alert("Debes ingresar valores válidos en los campos de precio.");
                return false;
            }

            if (minPrice < 0 || maxPrice < 0) {
                alert("Los precios no pueden ser negativos.");
                return false;
            }

            if (minPrice === 0 && maxPrice === 0) {
                alert("Si el precio mínimo es 0, el máximo debe ser mayor que 0.");
                return false;
            }

            if (minPrice > maxPrice) {
                alert("El precio mínimo no puede ser mayor que el máximo.");
                return false;
            }

            return true;
        }
    </script>
@endsection