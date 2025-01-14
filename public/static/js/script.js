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

// Manejo de formularios
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch(this.action, {
            method: this.method,
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('¡Materia seleccionada!', data.message, 'success').then(() => {
                        showUploadDialog(data.asignature_id); // Llama al siguiente paso
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(() => Swal.fire('Error', 'Ocurrió un error al seleccionar la materia.', 'error'));
    });
});

document.addEventListener('DOMContentLoaded', () => {
    console.log('JavaScript cargado correctamente.');
});

/**
 * Maneja la selección de categoría
 * @param {Event} event - El evento del formulario
 * @param {string} category - La categoría seleccionada
 */
function handleCategorySelection(event, category) {
    event.preventDefault(); // Evita el envío predeterminado del formulario
    console.log("Categoría seleccionada:", category); // Confirma si la función se ejecuta
    const formData = new FormData();
    formData.append('category', category);
    formData.append('_token', document.querySelector('input[name="_token"]').value);

    fetch('/ask-topic', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        console.log("Respuesta del servidor:", data); // Verifica la respuesta del servidor
        if (data.success) {
            Swal.fire({
                title: '¡Categoría seleccionada!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'Cargar archivo',
            }).then(() => {
                showUploadDialog(data.category_id); // Llama al siguiente paso
            });
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(error => {
        console.error("Error al seleccionar la categoría:", error); // Muestra errores en la consola
        Swal.fire('Error', 'Ocurrió un error al seleccionar la categoría.', 'error');
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




