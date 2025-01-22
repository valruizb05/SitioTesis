<!DOCTYPE html>
<html lang="es">

@include('navbar')

<head>
    <title>Textos de {{ ucfirst($category) }}</title>
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
</head>

<body>
    <h1 style="text-align: center; margin-top:90px; margin-bottom: 40px;">Textos de {{ ucfirst($category) }}</h1>

    <div class="text-container">
        @if (!empty($files) && count($files) > 0)
            @foreach ($files as $file)
                <div class="text-item">
                    <p class="text-title">{{ basename($file, '.txt') }}</p>
                    <a href="{{ route('showText', ['category' => $category, 'filename' => basename($file, '.txt')]) }}" class="btn btn-primary">Ver Texto</a>
                </div>
            @endforeach
        @else
            <p>No hay textos disponibles para esta categoría.</p>
        @endif
    </div>

    @include('footer')
</body>

</html>
