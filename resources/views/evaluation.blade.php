<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="text-content">
        <h1>{{ $nextTextType == 'humor' ? 'Versión con humor' : 'Versión original' }}</h1>
        <p>{{ $content }}</p>
        <button id="finalize-reading">Finalizar lectura</button>
    </div>

    <script>
        document.getElementById('finalize-reading').addEventListener('click', function () {
            Swal.fire({
                title: 'Evalúa el texto',
                html: `
                    <div>
                        <h3>Califica el nivel de humor:</h3>
                        <input type="number" id="humor-rating" min="1" max="5" placeholder="1 a 5 estrellas" required>
                        <h3>Facilidad de comprensión:</h3>
                        <input type="number" id="compression-rating" min="1" max="5" placeholder="1 a 5 estrellas" required>
                        <h3>¿Cuál prefieres?</h3>
                        <select id="preference">
                            <option value="humor">Con humor</option>
                            <option value="original">Sin humor</option>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
            }).then(result => {
                if (result.isConfirmed) {
                    const humorRating = document.getElementById('humor-rating').value;
                    const compressionRating = document.getElementById('compression-rating').value;
                    const preference = document.getElementById('preference').value;

                    // Enviar evaluación al servidor
                    fetch('/saveEvaluation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({
                            humorRating,
                            compressionRating,
                            preference,
                        }),
                    })
                    .then(() => {
                        Swal.fire({
                            title: 'Gracias',
                            text: 'Tu evaluación ha sido registrada.',
                            icon: 'success',
                        });
                    })
                    .catch(() => {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo guardar tu evaluación.',
                            icon: 'error',
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>
