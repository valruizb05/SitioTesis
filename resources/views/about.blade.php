<!DOCTYPE html>
<html lang="es">

@include('navbar')
    <!-- Contenido de la página About -->
    <main>
        <section class="intro-section">
            <div class="container d-flex align-items-center">
                <!-- Imagen circular a la izquierda -->
                <div class="intro-icon">
                    <img src="{{ asset('static/img/intro.jpg') }}" alt="Imagen de introducción">
                </div>
        
                <!-- Texto a la derecha -->
                <div class="intro-text">
                    <h2>Planteamiento del problema</h2>
                    <p class="problem-text">
                        En México, el bajo nivel de aprendizaje entre adolescentes es un problema persistente,
                        especialmente en el área de la <span class="highlight">comprensión lectora</span>. Según el
                        Programa para la Evaluación Internacional de los Estudiantes (PISA) de la OCDE, México se
                        posiciona como el tercer país peor evaluado en esta área.
                    </p>
                    <p class="problem-text">
                        Los resultados reflejan que un alto porcentaje de estudiantes no alcanza el nivel básico de
                        competencia, limitando su capacidad para <span class="highlight">entender adecuadamente</span>
                        los textos que leen. Este problema se ha visto exacerbado tras la pandemia, mostrando un
                        retroceso considerable en el desempeño académico.
                    </p>
                    <p class="problem-text">
                        Los materiales educativos suelen ser <span class="highlight">aburridos y desconectados</span> de
                        los intereses de los jóvenes, lo que dificulta la retención y el aprendizaje significativo.
                    </p>
                </div>
            </div>
        </section>              

        <section class="objective-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="objective-text">
                            Transformar textos educativos en español para adolescentes de nivel secundaria en textos humorísticos
                            haciendo uso de un modelo lenguaje de gran tamaño.
                        </p>
                    </div>
                </div>
            </div>
        </section>              

        <section class="objectives-section" data-background="{{ asset('static/img/background.png') }}">
            <div class="container">
                <h2>Objetivos Específicos</h2>
                <div class="row">
                    <!-- Tarjeta 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="objective-card">
                            <i class="bi bi-search objective-icon"></i>
                            <h3 class="objective-title">Analizar tipos de humor</h3>
                            <p class="objective-description">Analizar y comprender los tipos de humor utilizados para
                                generar humor en adolescentes.</p>
                            <a href="#" class="objective-link">Más</a>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="objective-card">
                            <i class="bi bi-cpu objective-icon"></i>
                            <h3 class="objective-title">Seleccionar modelo de lenguaje</h3>
                            <p class="objective-description">Seleccionar un modelo de lenguaje basado en un análisis
                                respecto a su reputación en la literatura y accesibilidad.</p>
                            <a href="#" class="objective-link">Más</a>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="objective-card">
                            <i class="bi bi-chat-dots objective-icon"></i>
                            <h3 class="objective-title">Determinar prompt adecuado</h3>
                            <p class="objective-description">Determinar el prompt adecuado con relación a la
                                legibilidad, humor y coherencia de las respuestas obtenidas.</p>
                            <a href="#" class="objective-link">Más</a>
                        </div>
                    </div>

                    <!-- Tarjeta 4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="objective-card">
                            <i class="bi bi-bar-chart objective-icon"></i>
                            <h3 class="objective-title">Evaluar preferencia del texto</h3>
                            <p class="objective-description">Identificar el grado de preferencia que tenga el texto
                                humorístico generado respecto al texto original.</p>
                            <a href="#" class="objective-link">Más</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="limitations-section">
            <div class="container">
                <h2 class="text-center mb-5">Limitaciones</h2>
                <div class="row">
                    <!-- Tarjeta 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="limitation-card">
                            <img src="{{ asset('static/img/creativity.jpg') }}" alt="Creatividad">
                            <div class="limitation-content">
                                <h3 class="limitation-title">No se comprueba aprendizaje</h3>
                                <p class="limitation-description">No será posible comprobar si el alumno está
                                    adquiriendo conocimiento después de haber usado el sistema.</p>
                                <a href="#" class="limitation-link">Aprende más</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="limitation-card">
                            <img src="{{ asset('static/img/motivation.jpg') }}" alt="Motivación">
                            <div class="limitation-content">
                                <h3 class="limitation-title">Percepción subjetiva del humor</h3>
                                <p class="limitation-description">Dada la naturaleza subjetiva del humor, es posible que
                                    para algunos lectores el humor en el texto generado no se perciba.</p>
                                <a href="#" class="limitation-link">Aprende más</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="limitation-card">
                            <img src="{{ asset('static/img/positivity.jpg') }}" alt="Positividad">
                            <div class="limitation-content">
                                <h3 class="limitation-title">Limitación de prueba</h3>
                                <p class="limitation-description">La experimentación se hará únicamente con una
                                    institución educativa, lo cual puede limitar los resultados obtenidos.</p>
                                <a href="#" class="limitation-link">Aprende más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="alcances-section">
            <div class="container">
                <h2 class="alcances-title">Alcances</h2>
                <p class="alcances-description">La generación de humor podría extenderse a todas las ramas enseñadas a
                    nivel secundaria. La interfaz web permitirá ingresar el texto y presentar la versión humorística
                    generada.</p>

                <div class="row">
                    <!-- Tarjeta 1 -->
                    <div class="col-md-4">
                        <div class="alcances-card">
                            <img src="{{ asset('static/img/icon1.png') }}" alt="Ramas educativas">
                            <h3>Ramas Educativas</h3>
                            <p>La generación de humor se podría adaptar a todas las materias enseñadas en secundaria.
                            </p>
                        </div>
                    </div>

                    <!-- Imagen Central -->
                    <div class="col-md-4">
                        <div class="alcances-image">
                            <img src="{{ asset('static/img/student.png') }}" alt="Estudiante con libro">
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="col-md-4">
                        <div class="alcances-card">
                            <img src="{{ asset('static/img/icon2.png') }}" alt="Interfaz web">
                            <h3>Interfaz Web</h3>
                            <p>La plataforma web permitirá la entrada de textos y la presentación de versiones
                                humorísticas generadas automáticamente.</p>
                        </div>
                    </div>
                </div>
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
