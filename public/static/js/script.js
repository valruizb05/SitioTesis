
document.addEventListener('DOMContentLoaded', () => {
    let app = document.getElementById('app');

    let typewriter = new Typewriter(app, {
        loop: true,
        delay: 75,
    });

    typewriter
    .pauseFor(500) // Espera medio segundo antes de empezar
    .typeString('"La IA puede ser un tutor inalcanzable que adapta su enseñanza al ritmo de cada estudiante." - Rose Luckin (Profesora de diseño centrado en el alumno)')
    .pauseFor(3000) // Pausa 3 segundos para que el usuario lea la frase
    .deleteAll(20) // Borra la frase rápidamente, con un delay de 20ms entre caracteres
    .pauseFor(500) // Pausa medio segundo antes de escribir la siguiente frase
    .typeString('"La IA puede ayudarnos a crear experiencias de aprendizaje más atractivas e inmersivas." - Sebastian Thrun (Científico informático y educador)')
    .pauseFor(3000) // Pausa 3 segundos
    .deleteAll(20) // Borra la frase rápidamente
    .pauseFor(500)
    .typeString('"La IA y los LLMs tienen el potencial de personalizar la educación y hacerla más accesible para todos, sin importar dónde se encuentren." - Daphne Koller (Científica informática y educadora)')
    .pauseFor(3000) // Pausa 3 segundos
    .deleteAll(20) // Borra la frase rápidamente
    .pauseFor(500)
    .typeString('"La IA y los LLMs no van a reemplazar a los maestros, sino que les darán superpoderes para ser más efectivos." - Justin Reich (Director del MIT Teaching Systems Lab)')
    .pauseFor(3000) // Pausa 3 segundos
    .start(); // Inicia el efecto
});
