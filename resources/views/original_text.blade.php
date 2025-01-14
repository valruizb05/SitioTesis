<!DOCTYPE html>
<html lang="es">

@include('navbar')
    <title>Texto Original</title>

<body>
    <h1>Texto Educativo Original</h1>
    <div class="container">
        <h1>Texto Cargado</h1>
        <pre>{{ $content }}</pre>
    </div>
    @include('footer')
</body>
</html>
