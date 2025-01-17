<!DOCTYPE html>
<html lang="es">
<head>
    @include('navbar')
    <title class="tittletxt">{{ $filename }}</title>
</head>
<body>
    <h1 class="tittletxt">{{ $filename }}</h1>
    <div class="text-content">
        @foreach (explode("\n", $content) as $paragraph)
            @if (trim($paragraph) !== '')
                <p>{{ $paragraph }}</p>
            @endif
        @endforeach
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('showQuiz', ['filename' => $filename]) }}" class="btn btn-primary">
            Realizar Evaluación
        </a>
    </div>
    @include('footer')
</body>
</html>

