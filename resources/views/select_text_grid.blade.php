<!DOCTYPE html>
<html lang="es">
<head>
    @include('navbar') <!-- Incluye la barra de navegación -->
    <title>{{ $category }} - {{ strtoupper(str_replace('.txt', '', $text_file)) }}</title>
    <link rel="stylesheet" href="{{ asset('static/css/styles.css') }}"> <!-- Enlace a tu archivo CSS -->
</head>
<body>
    <div class="content-container">
        <!-- Título de la categoría -->
        <h2 class="content-title">{{ $category }} - {{ strtoupper(str_replace('.txt', '', $text_file)) }}</h2>
        
        <!-- Contenido del texto -->
        <div class="content-text">
            {{ $content }}
        </div>

        <!-- Botón para generar el test -->
        <form action="{{ route('generate_quiz') }}" method="POST">
            @csrf <!-- Protección contra CSRF -->
            <button type="submit" class="back-link" style="margin-top: 20px;">Hacer Test</button>
        </form>
        
        <!-- Contenedor para el cuestionario -->
        <div id="quiz-container">
            <!-- Aquí se mostrará el cuestionario generado -->
        </div>

        <!-- Enlace para volver -->
        <a href="{{ route('show_texts') }}" class="back-link">Volver a la lista de textos</a>
    </div>
</body>
</html>
