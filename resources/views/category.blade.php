<!DOCTYPE html>
<html lang="es">

@include('navbar')

<head>
    <title>Selecciona una Categoría</title>
    <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
</head>

<body>
    <h2 style="text-align: center; margin-bottom: 30px;">Selecciona una Categoría</h2>

    <div class="category-container">
        <div class="category-box">
            <img src="{{ asset('static/img/biologia.png') }}" alt="Biología">
            <h3>Biología</h3>
            <form action="{{ route('listTexts', 'Biología') }}" method="GET">
                <button type="submit" class="btn-category">Seleccionar</button>
            </form>
        </div>

        <div class="category-box">
            <img src="{{ asset('static/img/geografia.jpg') }}" alt="Geografía">
            <h3>Geografía</h3>
            <form action="{{ route('listTexts', 'Geografía') }}" method="GET">
                <button type="submit" class="btn-category">Seleccionar</button>
            </form>
        </div>

        <div class="category-box">
            <img src="{{ asset('static/img/historia.jpg') }}" alt="Historia">
            <h3>Historia</h3>
            <form action="{{ route('listTexts', 'Historia') }}" method="GET">
                <button type="submit" class="btn-category">Seleccionar</button>
            </form>
        </div>
    </div>

    @include('footer')
</body>

</html>
