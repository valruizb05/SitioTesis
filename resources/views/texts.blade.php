<!DOCTYPE html>
<html lang="es">

@include('navbar')

<head>
    <title>Temas en {{ $category }}</title>
</head>

<body>
    <h2 style="text-align: center; margin-top: 20px;">Temas en {{ $category }}</h2>

    <div class="grid-container">
        @foreach ($texts as $text)
        <div class="text-box">
            <img src="{{ asset('static/img/topic.png') }}" alt="Imagen del tema">
            <h3>{{ basename($text, '.txt') }}</h3>

            <form action="{{ route('show_texts') }}" method="POST">
                @csrf
                <input type="hidden" name="text" value="{{ $text }}">
                <button type="submit" class="btn btn-primary">Ver Texto</button>
            </form>
        </div>
        @endforeach
    </div>

    <div style="text-align: center;">
        <a href="{{ route('category') }}" class="back-link">Volver a categorías</a>
    </div>
</body>

@include('footer')

</html>
