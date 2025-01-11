<!DOCTYPE html>
<html lang="es">

<head>
    @include('navbar') <!-- Incluye el archivo de la barra de navegación -->
</head>

<body>
    <div class="contact-container">
        <div class="contact-info">
            <h2>INFORMACIÓN DEL USUARIO</h2>
            <p>TecNM / CENIDET</p>
            <p>2024</p>
        </div>

        <div class="contact-form">
            <h2>Regístrate</h2>
            <form action="{{ route('personal_data') }}" method="POST">
                @csrf <!-- Protección CSRF requerida en Laravel -->

                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>

                <label for="surname">Apellidos:</label>
                <input type="text" id="surname" name="surname" required><br>

                <label for="age">Edad:</label>
                <input type="number" id="age" name="age" required><br>

                <label for="gender">Sexo:</label>
                <select id="gender" name="gender">
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>

                <label for="education">Último grado de estudios:</label>
                <select id="education" name="education">
                    <option value="primaria">Primaria</option>
                    <option value="secundaria">Secundaria</option>
                    <option value="prepa">Preparatoria</option>
                    <option value="uni">Universidad</option>
                    <option value="maestria">Maestría</option>
                    <option value="doctorado">Doctorado</option>
                </select>

                <button class="submit-btn" type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>
