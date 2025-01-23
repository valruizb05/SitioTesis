<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <link rel="stylesheet" href="{{ asset('static/css/styles.css') }}">
    @include('navbar')
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .content-container {
            max-width: 80%;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
        }

        .content-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 50px;
            color: #04133b;
        }

        .question-container {
            margin-bottom: 25px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }

        .question-container:last-child {
            border-bottom: none;
        }

        .question-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        label {
            font-size: 1rem;
            display: block;
            margin-bottom: 5px;
        }

        button[type="submit"] {
            display: block;
            align-items: center;
            width: 20%;
            padding: 10px 15px;
            background-color: #0b1155;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #092074;
        }
    </style>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        // SweetAlert para mostrar las instrucciones
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: 'Instrucciones',
                text: 'Lee las preguntas con atención y selecciona la respuesta correcta para cada una.',
                icon: 'info',
                confirmButtonText: 'Entendido'
            });
        });
    </script>

    <div class="content-container">
        <h2 class="content-title">Cuestionario</h2>

        <!-- Formulario para el cuestionario -->
        <form id="quiz-form" action="{{ route('submitQuiz', ['filename' => $filename]) }}" method="POST">
            @csrf
            @foreach ($quiz as $index => $question)
                <div class="question-container">
                    <p class="question-title">{{ $index + 1 }}. {{ $question['question'] }}</p>
                    @foreach ($question['options'] as $optionIndex => $option)
                        <label>
                            <input type="radio" name="answers[{{ $index }}]" value="{{ $optionIndex }}" required>
                            {{ $option }}
                        </label>
                    @endforeach
                </div>
            @endforeach
            <button type="submit">Enviar Respuestas</button>
        </form>
    </div>
    <script src="{{ asset('static/js/quiz.js') }}"></script>

   
</body>
</html>
