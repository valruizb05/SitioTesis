<!DOCTYPE html>
<html lang="es">
<head>
    @include('navbar') <!-- Incluye el archivo de la barra de navegación -->
    <title>Temas en {{ $category }}</title>
</head>
<body>
    <h2 style="text-align: center; margin-top: 20px;">Temas en {{ $category }}</h2>

    <div class="grid-container">
        @foreach ($texts as $index => $text)
        <div class="text-box">
            <img src="{{ asset('static/img/topic.png') }}" alt="Imagen del tema">
            <h3>{{ str_replace('.txt', '', $text) }}</h3>

            <form action="{{ route('show_texts') }}" method="POST">
                @csrf <!-- Protección CSRF requerida por Laravel -->
                <input type="hidden" name="text" value="{{ $text }}">
                <button type="submit" class="button-style 
                    @if ($loop->index % 5 == 1) btn-blue
                    @elseif ($loop->index % 5 == 2) btn-pink
                    @elseif ($loop->index % 5 == 3) btn-purple
                    @elseif ($loop->index % 5 == 4) btn-yellow
                    @else btn-orange @endif">
                    Ver Texto
                </button>
            </form>
        </div>
        @endforeach
    </div>

    <div style="text-align: center;">
        <a href="{{ route('ask_topic') }}" class="back-link">Volver a categorías</a>
    </div>
</body>
</html>
