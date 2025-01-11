<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Texto Humorístico</title>
</head>
<body>
    <h1>Texto Educativo con Humor</h1>
    <!-- Mostramos el texto con humor enviado desde el controlador -->
    <p>{{ $humor_text }}</p>
    
    <!-- Botón que dirige al cuestionario sobre la versión humorística -->
    <a href="{{ route('humor_test') }}">
        <button>Cuestionario sobre la versión humorística</button>
    </a>
</body>
</html>
