<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario Texto Original</title>
</head>
<body>
    <h1>Cuestionario sobre el Texto Original</h1>
    <!-- Formulario que envía los datos al controlador -->
    <form action="{{ route('original_test') }}" method="POST">
        @csrf <!-- Protección CSRF requerida en Laravel -->

        <!-- Iteramos sobre las preguntas -->
        @foreach ($questions as $index => $question)
            <p>{{ $loop->iteration }}. {{ $question['pregunta'] }}</p>
            @foreach ($question['opciones'] as $opcion)
                <label>
                    <input type="radio" name="question_{{ $index }}" value="{{ $opcion }}"> {{ $opcion }}
                </label><br>
            @endforeach
        @endforeach

        <!-- Botón de envío -->
        <button type="submit">Continuar a la versión humorística</button>
    </form>
</body>
</html>
