<!DOCTYPE html>
<html lang="es">

@include('navbar')

<body>
    <div class="contact-container">
        <div class="contact-info">
            <h2>INFORMACIÓN DEL USUARIO</h2>
            <p>TecNM / CENIDET</p>
            <p>2024</p>
        </div>

        <div class="contact-form">
            <h2>Regístrate</h2>

            <form action="{{ route('submit_users') }}" method="POST">
                @csrf

                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>

                <label for="lastname">Apellidos:</label>
                <input type="text" id="lastname" name="lastname" required><br>

                <label for="age">Edad:</label>
                <input type="number" id="age" name="age" required><br>

                <label for="gender">Sexo:</label>
                <select id="gender" name="gender">
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>

                <label for="education">Último grado de estudios:</label>
                <select id="education" name="education">
                    @foreach($degrees as $degree)
                        <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                    @endforeach
                </select>

                <button class="submit-btn" type="submit">Enviar</button>
            </form>
            
        </div>
    </div>
    
    @if(auth()->check())
    <script>
        window.config = {
            saveTypeTextRoute: "{{ route('saveTypeText') }}",
            categoryRoute: "{{ route('category') }}",
            userId: {{ auth()->id() }},
            csrfToken: "{{ csrf_token() }}"
        };
    </script>
@else
    <script>
        window.config = {
            saveTypeTextRoute: "{{ route('saveTypeText') }}",
            categoryRoute: "{{ route('category') }}",
            userId: null,
            csrfToken: "{{ csrf_token() }}"
        };
    </script>
@endif

    

    @include('footer')
</body>

</html>