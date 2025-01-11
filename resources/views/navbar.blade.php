<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprende con IA</title>
    <!-- Incluimos el CSS del proyecto -->
    <link rel="stylesheet" href="{{ asset('static/style/styles.css') }}">
    <link rel="icon" href="{{ asset('static/img/favicon.png') }}" type="image/x-icon">
    <!-- Incluimos recursos externos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav>
        <div class="navbar-container">
            <div class="navbar-left">
                <!-- Cambiamos a asset() para el logo -->
                <img src="{{ asset('static/img/logo2.png') }}" alt="Logo" class="logo">
            </div>
            <div class="navbar-right">
                <ul class="nav-links">
                    <!-- Usamos route() para enlaces definidos en web.php -->
                    <li><a href="{{ route('about') }}">Acerca de</a></li>
                    <li><a href="{{ route('developers') }}">Desarrolladores</a></li>
                    <li><a href="{{ route('history') }}">Antecedentes</a></li>
                    <li><a href="{{ route('related') }}">Temas Relacionados</a></li>
                </ul>
            </div>
        </div>
    </nav>
</body>
