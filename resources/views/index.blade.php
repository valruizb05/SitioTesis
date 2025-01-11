<!DOCTYPE html>
<html lang="es">

@include('navbar')
    <!-- Página Principal -->
    <main>
        <section class="welcome-section">
            <h1>Bienvenido</h1>
            <p id="app">"La verdadera promesa de la IA es liberar el potencial humano." - Satya Nadella (CEO de Microsoft).</p>
        </section>

        <section class="courses-section">
            <div class="course-container">
                <img src="{{ asset('static/img/index1.jpg') }}" alt="Curso 1" class="course-img">
                <h3>Proceso completo</h3>
                <form action="{{ route('formulario') }}" method="POST">
                    @csrf
                    <button type="submit" name="button" value="1" class="button">
                        <i class="bi bi-arrow-right-circle"></i>
                        <span>Proceso completo</span>
                    </button>
                </form>
            </div>

            <div class="course-container">
                <img src="{{ asset('static/img/index2.jpg') }}" alt="Curso 2" class="course-img">
                <h3>Solo texto humorístico</h3>
                <form action="{{ route('formulario') }}" method="POST">
                    @csrf
                    <button type="submit" name="button" value="2" class="button">
                        <i class="bi bi-arrow-right-circle"></i>
                        <span>Solo texto humorístico</span>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
    <script src="{{ asset('static/js/script.js') }}"></script>
</body>

</html>
