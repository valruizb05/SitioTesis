<!DOCTYPE html>
<html lang="es">
<head>
    @include('navbar')
    <title>Textos de {{ ucfirst($category) }}</title>
</head>
<body>
    <br><br><br>
    <title>Textos de {{ ucfirst($category) }}</title>
    <h1 style="text-align: center;">Textos de {{ ucfirst($category) }}</h1>

    <br>
    @if (isset($error))
        <div>
            <strong>Error:</strong> {{ $error }}
        </div>
    @endif

    @if (count($texts) > 0)
    <div class="text-container">
        @foreach ($texts as $index => $file)
            <div class="text-item">
                <!-- Imagen -->
                <img src="{{ asset('static/img/topic.png') }}" alt="Icono de texto" class="text-image">
                
                <!-- Título -->
                <span class="text-title">{{ pathinfo($file, PATHINFO_FILENAME) }}</span>
                
                <!-- Botón -->
                <a href="{{ route('showText', ['category' => $category, 'filename' => pathinfo($file, PATHINFO_FILENAME)]) }}" 
                   class="view-button {{ ['blue', 'pink', 'yellow', 'purple'][$index % 4] }}">
                    Ver Texto
                </a>
            </div>
        @endforeach
    </div>
    
    @else
        <p>No hay textos disponibles en esta categoría.</p>
    @endif

    @include('footer')
</body>
</html>
