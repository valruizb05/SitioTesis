<!DOCTYPE html>
<html lang="es">

@include('navbar')
<title>Texto Original</title>

<body>
    <h1>Texto Educativo Original</h1>
    <div class="container">
        <h1>Texto Cargado</h1>
        @if(empty($content))
            <p>No se pudo extraer texto del archivo PDF.</p>
        @else
            <pre>{{ $content }}</pre>
        @endif
    </div>
    @include('footer')
</body>
</html>
