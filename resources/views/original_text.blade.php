<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Texto Original</title>
</head>
<body>
    <h1>Texto Educativo Original</h1>
    <!-- Mostramos el texto original enviado desde el controlador -->
    <p>{{ $original_text }}</p>
    
    <!-- Botón para ir al cuestionario sobre el texto original -->
    <a href="{{ route('original_test') }}">
        <button>Continuar al cuestionario</button>
    </a>
</body>
</html>
