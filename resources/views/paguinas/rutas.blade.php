<!--resources/views/paguinas/rutas.blade.php-->
@extends('layouts.app')

{{-- Título dinámico para SEO según la región/tipo seleccionada --}}
@section('title', isset($tipo) ? 'Tours y Rutas en ' . ucwords($tipo) . ' | Ayniforest' : 'Rutas y Tours | Ayniforest')

@section('meta_description', isset($tipo) ? ucwords($tipo) . ' — Explora nuestros tours y paquetes. Reserva en línea y descubre los mejores destinos.' : 'Explora nuestras rutas y tours desde Trujillo. Reserva online con Ayniforest.')
@section('canonical_url', url()->current())
@section('og_title', isset($tipo) ? 'Tours en ' . ucwords($tipo) . ' - Ayniforest' : 'Rutas - Ayniforest')
@section('og_description', isset($tipo) ? 'Encuentra paquetes, fechas y reserva tu tour en ' . ucwords($tipo) . '.' : 'Explora nuestras rutas y tours desde Trujillo.')
@section('og_image', asset('imagenes/logo.webp'))

@section('plantilla')
    <link rel="stylesheet" href="{{ asset('css/paquetes.css') }}">
    @php
    $hero = match (strtolower($tipo ?? 'default')) {
        'la libertad' => [
            'titulo' => 'Tours en La Libertad',
            'descripcion' => 'Descubre la riqueza cultural y natural de La Libertad desde Trujillo',
            'clase' => 'hero-la-libertad',
        ],
        'amazonas' => [
            'titulo' => 'Aventuras en Amazonas',
            'descripcion' => 'Explora fortalezas ancestrales y la selva alta en Amazonas',
            'clase' => 'hero-amazonas',
        ],
        'cajamarca' => [
            'titulo' => 'Rutas en Cajamarca',
            'descripcion' => 'Conoce los paisajes, historia y tradición de Cajamarca',
            'clase' => 'hero-cajamarca',
        ],
        'huaraz' => [
            'titulo' => 'Expediciones en Huaraz',
            'descripcion' => 'Vive la aventura en la Cordillera Blanca y sus lagunas',
            'clase' => 'hero-huaraz',
        ],
        default => [
            'titulo' => 'Tours & Aventuras',
            'descripcion' => 'Explora todos los destinos disponibles con Ayniforest',
            'clase' => 'hero-default',
        ],
    };
@endphp

    <section class="hero {{ $hero['clase'] }}">
        <h1 class="text-3xl font-bold sm:text-2xl md:text-4xl">
            {{ $hero['titulo'] }}
        </h1>

        <p class="text-white">
            {{ $hero['descripcion'] }}
        </p>
    </section>
    <!-- Espaciador (opcional si hay más contenido abajo) -->
    <section class="bg-dark py-3">
        <div class="container d-flex justify-content-center"></div>
    </section>
    @include('paguinas.paqueterutas', ['tipo' => $tipo])
@endsection
