<!-- resources/views/list-texts.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Textos de {{ $category }}</title>
</head>
<body>
    <h1>Textos de {{ ucfirst($category) }}</h1>
    <ul>
        @foreach ($files as $file)
            <li>
                <a href="{{ route('showText', ['category' => $category, 'filename' => pathinfo($file, PATHINFO_FILENAME)]) }}">
                    {{ pathinfo($file, PATHINFO_FILENAME) }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
