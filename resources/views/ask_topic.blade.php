<!DOCTYPE html>
<html lang="es">


    @include('navbar') <!-- Incluye el archivo de la barra de navegación -->
    <title>Selecciona una Categoría</title>


<body>
    <h2 style="text-align: center; margin-bottom: 30px;">Selecciona una Categoría</h2>

    <!-- Contenedor principal de las categorías -->
    <div class="category-container">
        <!-- Caja de Biología -->
        <div class="category-box">
            <img src="{{ asset('static/img/biologia.png') }}" alt="Biología">
            <h3>Biología</h3>
            <form action="{{ route('ask_topic') }}" method="POST">
                @csrf <!-- Protección contra CSRF -->
                <input type="hidden" name="category" value="Biologia">
                <button type="submit" class="btn-bio">Seleccionar</button>
            </form>
        </div>

        <!-- Caja de Geografía -->
        <div class="category-box">
            <img src="{{ asset('static/img/geografia.jpg') }}" alt="Geografía">
            <h3>Geografía</h3>
            <form action="{{ route('ask_topic') }}" method="POST">
                @csrf <!-- Protección contra CSRF -->
                <input type="hidden" name="category" value="Geografia">
                <button type="submit" class="btn-geo">Seleccionar</button>
            </form>
        </div>

        <!-- Caja de Historia -->
        <div class="category-box">
            <img src="{{ asset('static/img/historia.jpg') }}" alt="Historia">
            <h3>Historia</h3>
            <form action="{{ route('ask_topic') }}" method="POST">
                @csrf <!-- Protección contra CSRF -->
                <input type="hidden" name="category" value="Historia">
                <button type="submit" class="btn-historia">Seleccionar</button>
            </form>
        </div>
    </div>
</body>

</html>
