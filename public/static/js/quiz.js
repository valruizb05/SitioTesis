document.addEventListener('DOMContentLoaded', () => {
    const quizForm = document.getElementById('quiz-form');

    if (quizForm) {
        quizForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;

            fetch(form.action, {
                method: form.method,
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: '¡Cuestionario completado!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Continuar',
                        }).then(() => {
                            const url = `/showText/${data.nextTextType}/${data.category}/${data.filename}`;
                            console.log("Redirigiendo a:", url);
                            window.location.href = url;
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al procesar tus respuestas.',
                            icon: 'error',
                        });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error inesperado.',
                        icon: 'error',
                    });
                });
        });
    }
});
