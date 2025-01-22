<!DOCTYPE html>
<html lang="es">
<head>
    <title>Textos de {{ ucfirst($category) }}</title>
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
    @include('navbar')
</head>
<body>
    <h2 style="text-align: center; margin-bottom: 30px;">Textos de {{ ucfirst($category) }}</h2>

    <div class="text-list-container">
        @if (!empty($files) && count($files) > 0)
            @foreach ($files as $file)
                <div class="text-item">
                    <p>{{ basename($file) }}</p>
                    <a href="{{ route('showText', ['category' => $category, 'filename' => pathinfo($file, PATHINFO_FILENAME)]) }}" class="btn-view-text">Ver Texto</a>
                </div>
            @endforeach
        @else
            <p>No se encontraron textos para esta categoría.</p>
        @endif
    </div>
    @include('footer')
</body>
</html>
