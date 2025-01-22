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
        .deleteAll(20) // Borra la frase rápidamente
        .pauseFor(500)
        .typeString('"La IA puede ayudarnos a crear experiencias de aprendizaje más atractivas e inmersivas." - Sebastian Thrun (Científico informático y educador)')
        .pauseFor(3000)
        .deleteAll(20)
        .pauseFor(500)
        .typeString('"La IA y los LLMs tienen el potencial de personalizar la educación y hacerla más accesible para todos, sin importar dónde se encuentren." - Daphne Koller (Científica informática y educadora)')
        .pauseFor(3000)
        .deleteAll(20)
        .pauseFor(500)
        .typeString('"La IA y los LLMs no van a reemplazar a los maestros, sino que les darán superpoderes para ser más efectivos." - Justin Reich (Director del MIT Teaching Systems Lab)')
        .pauseFor(3000)
        .start(); // Inicia el efecto
});


function handleRegistrationSuccess(saveTypeTextRoute, categoryRoute, userId, csrfToken) {
    console.log("Entrando a handleRegistrationSuccess");
    console.log("Ruta para guardar tipo de texto:", saveTypeTextRoute);
    console.log("Ruta para categorías:", categoryRoute);
    console.log("ID del usuario:", userId);

    Swal.fire({
        title: '¡Éxito!',
        text: "Datos registrados correctamente.",
        icon: 'success',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: '¿Qué tipo de texto quieres leer?',
                text: "Selecciona una opción para continuar.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Humorístico',
                cancelButtonText: 'Original',
            }).then((textResult) => {
                const typeText = textResult.isConfirmed ? 1 : 2;
                saveTextType(typeText, saveTypeTextRoute, categoryRoute, userId, csrfToken);
            });
        }
    });
}

function saveTextType(typeText) {
    if (!window.config.userId) {
        Swal.fire('Error', 'No se pudo identificar al usuario. Por favor, inicia sesión.', 'error');
        return;
    }

    fetch(window.config.saveTypeTextRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.config.csrfToken,
        },
        body: JSON.stringify({
            type_text: typeText
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('¡Guardado!', data.message, 'success').then(() => {
                window.location.href = window.config.categoryRoute;
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'No se pudo guardar el tipo de texto.', 'error');
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const { saveTypeTextRoute, categoryRoute, userId, csrfToken } = window.config;

    console.log("ID del usuario:", userId); // Solo para verificar en consola.

    if (!userId || userId === null) {
        console.error('Usuario no autenticado. SweetAlert no se ejecutará.');
        return;
    }

    // Usa las funciones para manejar el flujo de usuario
    handleRegistrationSuccess(saveTypeTextRoute, categoryRoute, userId, csrfToken);
});
