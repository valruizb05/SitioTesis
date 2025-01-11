<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <link rel="stylesheet" href="{{ asset('static/css/styles.css') }}">
</head>
<body>
    <div class="content-container">
        <h2 class="content-title">Cuestionario</h2>

        <!-- Instrucciones -->
        <p>Lee las preguntas y selecciona la respuesta correcta para cada una.</p>

        <!-- Formulario para el cuestionario -->
        <form action="{{ route('submit_quiz') }}" method="POST">
            @csrf <!-- Protección contra CSRF -->

            @foreach ($quiz as $question_id => $question_data)
                <div class="question">
                    <!-- Muestra la pregunta -->
                    <p><strong>{{ $question_data['pregunta'] }}</strong></p>
                    
                    <!-- Opciones de respuesta -->
                    @foreach ($question_data['opciones'] as $option)
                        <label>
                            <input type="radio" name="{{ $question_id }}" value="{{ $option }}"> {{ $option }}
                        </label><br>
                    @endforeach
                </div>
                <hr> <!-- Línea divisoria entre preguntas -->
            @endforeach

            <!-- Botón para enviar el cuestionario -->
            <button type="submit" class="back-link">Enviar Respuestas</button>
        </form>
    </div>
</body>
</html>
