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
// Función modular para guardar el tipo de texto
function saveTextType(typeText, saveTypeTextRoute, categoryRoute, userId, csrfToken) {
    if (!userId || userId === 'null') {
        Swal.fire('Error', 'No se pudo identificar al usuario. Por favor, intenta registrarte de nuevo.', 'error');
        return;
    }    

    fetch(saveTypeTextRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ type_text: typeText, user_id: userId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: '¡Tipo de texto registrado!',
                text: 'Ahora selecciona la materia.',
                icon: 'success',
                confirmButtonText: 'Continuar'
            }).then(() => {
                window.location.href = categoryRoute;
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error en el fetch:', error);
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


/**
 * Maneja la selección de categoría
 * @param {Event} event - El evento del formulario
 * @param {string} category - La categoría seleccionada
 */
function handleCategorySelection(event, category) {
    event.preventDefault();
    console.log("Categoría seleccionada:", category); // Confirmar categoría seleccionada

    Swal.fire({
        title: `Seleccionaste ${category}`,
        text: "¿Quieres continuar?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("/save-category", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ category }),
            })
                .then((response) => {
                    console.log("Respuesta de /save-category:", response);
                    return response.json();
                })
                .then((data) => {
                    console.log("Datos procesados de categoría:", data);
                    if (data.success) {
                        Swal.fire("¡Éxito!", data.message, "success").then(() => {
                            window.location.href = "/next-step";
                        });
                    } else {
                        Swal.fire("Error", data.message, "error");
                    }
                })
                .catch((error) => {
                    console.error("Error en /save-category:", error);
                    Swal.fire("Error", "Ocurrió un problema", "error");
                });
        }
    });
}



/**
 * Muestra el diálogo para cargar un archivo
 * @param {number} categoryId - ID de la categoría seleccionada
 */
function showUploadDialog(categoryId) {
    Swal.fire({
        title: 'Sube tu archivo',
        html: `<form id="swalUploadForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="${document.querySelector('input[name="_token"]').value}">
                    <input type="file" id="swalFileInput" name="file" accept=".txt" class="form-control">
                </form>`,
        confirmButtonText: 'Cargar',
        showCancelButton: true,
        preConfirm: () => {
            const fileInput = Swal.getPopup().querySelector('#swalFileInput');
            if (!fileInput.files[0]) {
                Swal.showValidationMessage('Por favor selecciona un archivo');
            }
            return fileInput.files[0];
        },
    }).then(result => {
        if (result.value) {
            const file = result.value;
            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            fetch('/upload_file', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('¡Éxito!', 'El archivo fue cargado correctamente.', 'success').then(() => {
                            window.location.href = data.redirect_url;
                        });
                    } else {
                        Swal.fire('Error', data.error, 'error');
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error', 'No se pudo cargar el archivo. Intenta de nuevo.', 'error');
                });
        }
    });
}



