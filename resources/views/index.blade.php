<!DOCTYPE html>
<html lang="es">

@include('navbar')
    <!-- Página Principal -->
    <main>
        <!--- section class="welcome-section">
            <h1>Bienvenido</h1>
            <p id="app">"La verdadera promesa de la IA es liberar el potencial humano." - Satya Nadella (CEO de Microsoft).</p>
        </!--->

        <section class="courses-section">
            <div class="course-container">
                <img src="{{ asset('static/img/index1.jpg') }}" alt="Curso 1" class="course-img">
                <h3>Proceso completo</h3>
                <a href="{{ route('personal_data') }}" class="button">
                    <i class="bi bi-arrow-right-circle"></i>
                    <span>Proceso completo</span>
                </a>
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

@include('footer')     
</body>

</html>
