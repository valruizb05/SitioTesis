<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario Texto Humorístico</title>
</head>
<body>
    <h1>Cuestionario sobre el Texto con Humor</h1>
    <!-- El formulario envía los datos al controlador mediante POST -->
    <form action="{{ route('humor_test') }}" method="POST">
        @csrf <!-- Protección CSRF requerida en Laravel -->
        
        <!-- Iteramos sobre las preguntas -->
        @foreach ($questions as $index => $question)
            <p>{{ $loop->iteration }}. {{ $question }}</p>
            <label>
                <input type="radio" name="question_{{ $index }}" value="opcion1"> Opción 1
            </label><br>
            <label>
                <input type="radio" name="question_{{ $index }}" value="opcion2"> Opción 2
            </label><br>
            <label>
                <input type="radio" name="question_{{ $index }}" value="opcion3"> Opción 3
            </label><br>
            <label>
                <input type="radio" name="question_{{ $index }}" value="opcion4"> Opción 4
            </label><br><br>
        @endforeach

        <!-- Botón de envío -->
        <button type="submit">Continuar a la encuesta</button>
    </form>
</body>
</html>
