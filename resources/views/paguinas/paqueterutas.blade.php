<!-- resources/views/paguinas/paqueterutas.blade.php -->
<section class="packages">
    <div class="container">
        <h2 class="mb-1">
            @php
                $explora = match (strtolower($tipo ?? 'default')) {
                    'la libertad' => ['descripcion' => 'Descubre la riqueza cultural y natural de La Libertad desde Trujillo',],

                    'amazonas' => ['descripcion' => 'Explora fortalezas ancestrales y la selva alta en Amazonas',],

                    'cajamarca' => ['descripcion' => 'Conoce los paisajes, historia y tradición de Cajamarca',],

                    'huaraz' => ['descripcion' => 'Vive la aventura en la Cordillera Blanca y sus lagunas',],

                    default => ['descripcion' => 'Explora todas las rutas disponibles de Ayniforest',],
                };
            @endphp 
            {{ $explora['descripcion'] }}
        </h2>
        <section class="packages-grid">
            @foreach ($rutas as $ruta)
                <div class="package">
                    <img src="{{ asset($ruta->imagenes->first()->url_imagen ?? 'storage/imagenes/default.jpg') }}"
                        alt="{{ $ruta->nombre_ruta }}">
                    <h3 class="package-title">{{ $ruta->nombre_ruta }}</h3>
                    <p>{{ $ruta->descripcion_general }}</p>
                    <p class="price">{{ strtoupper($ruta->tipo) }}
                    <p class="tipo">Desde: <del class="tipo1">S/ {{ $ruta->precio_regular }}</del>
                        <strong class="tipo2">S/ {{ $ruta->precio_actual }}</strong>
                    </p>
                    <a href="{{ route('rutas.descripcion', ['id_ruta' => $ruta->id_ruta]) }}" class="package-btn">Ver
                        más</a>
                </div>
            @endforeach
        </section>
        <div class="pagination"></div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const packages = document.querySelectorAll('.package');

        const observerOptions = {
            threshold: 0.1, // Se activa cuando el 10% de la tarjeta es visible
            rootMargin: "0px 0px -50px 0px" // Margen inferior para anticipar la salida
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                // Detectamos si la tarjeta está entrando en el viewport
                if (entry.isIntersecting) {
                    // Obtenemos el índice de la tarjeta dentro de su grid para el retraso
                    const index = Array.from(entry.target.parentNode.children).indexOf(entry
                        .target);
                    const delay = (index % 3) *
                        150; // Crea el efecto cascada (0ms, 150ms, 300ms)

                    setTimeout(() => {
                        entry.target.classList.add('is-visible');
                        entry.target.classList.remove('is-hidden-below');
                    }, delay);
                } else {
                    // Si la tarjeta sale por la parte inferior de la pantalla (al subir el scroll)
                    if (entry.boundingClientRect.top > 0) {
                        entry.target.classList.remove('is-visible');
                        entry.target.classList.add('is-hidden-below');
                    }
                }
            });
        }, observerOptions);

        packages.forEach(pkg => {
            observer.observe(pkg);
        });
    });
</script>
