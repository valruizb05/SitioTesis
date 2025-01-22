<!DOCTYPE html>
<html lang="es">
<head>
    @include('navbar')
    <link rel="stylesheet" href="{{ asset('static/css/styles.css') }}">
    <title>{{ $filename }}</title>
</head>
<body>
    <h1 class="tittletxt">{{ $filename }}</h1>
    <div class="text-content">
        @foreach (explode("\n", $content) as $paragraph)
            @if (trim($paragraph) !== '')
                <p>{{ $paragraph }}</p>
            @endif
        @endforeach
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('quiz.show', ['filename' => $filename]) }}" class="btn-blue">
                Realizar Evaluación
            </a>
        </div>
        
    </div>
    @include('footer')
</body>
</html>


