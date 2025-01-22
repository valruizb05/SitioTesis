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
        <!-- Categoría: Biología -->
        <div class="category-box">
            <img src="{{ asset('static/img/biologia.png') }}" alt="Biología">
            <h3>Biología</h3>
            <form action="{{ route('saveCategory') }}" method="POST">
                @csrf
                <input type="hidden" name="category" value="1"> <!-- ID de Biología -->
                <button type="submit" class="btn-bio">Seleccionar</button>
            </form>
        </div>

        <!-- Categoría: Geografía -->
        <div class="category-box">
            <img src="{{ asset('static/img/geografia.jpg') }}" alt="Geografía">
            <h3>Geografía</h3>
            <form action="{{ route('saveCategory') }}" method="POST">
                @csrf
                <input type="hidden" name="category" value="2"> <!-- ID de Geografía -->
                <button type="submit" class="btn-geo">Seleccionar</button>
            </form>
        </div>

        <!-- Categoría: Historia -->
        <div class="category-box">
            <img src="{{ asset('static/img/historia.jpg') }}" alt="Historia">
            <h3>Historia</h3>
            <form action="{{ route('saveCategory') }}" method="POST">
                @csrf
                <input type="hidden" name="category" value="3"> <!-- ID de Historia -->
                <button type="submit" class="btn-historia">Seleccionar</button>
            </form>
        </div>
    </div>

    @include('footer')
</body>

</html>
