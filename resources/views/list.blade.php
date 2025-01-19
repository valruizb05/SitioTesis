<!DOCTYPE html>
<html lang="es">
<head>
    @include('navbar')

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <title>Textos de {{ ucfirst($category) }}</title>
    </head>
    <body>
        <h1 style="text-align: center;">Textos de {{ ucfirst($category) }}</h1>
    
        {{-- Mensaje de error si no hay textos o datos --}}
        @if (!empty($texts) && count($texts) > 0)
            <div class="text-container">
                @foreach ($texts as $index => $file)
                    <div class="text-item">
                        <p>{{ $file['name'] }}</p>
                        {{-- Agrega un botón para seleccionar o descargar el texto, si es necesario --}}
                        <a href="{{ route('showText', ['category' => $category, 'filename' => $file['id']]) }}" class="btn">
                            Ver Texto
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align: center; color: red;">No hay textos disponibles para la categoría seleccionada.</p>
        @endif
    
        @include('footer')
    </body>
    </html>
    
