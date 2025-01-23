<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('navbar')
    <title>Texto - {{ $nextTextType }}</title>
    <style>
        .star-rating span {
            font-size: 2rem;
            cursor: pointer;
            color: gray;
        }
        .star-rating span.selected {
            color: gold;
        }
        .btn-choice.selected {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <h1>{{ $nextTextType === 'humor' ? 'Texto Humorístico' : 'Texto Original' }}</h1>
    <div class="content">
        <p>{{ $content }}</p>
    </div>
    <button id="finalize-reading" class="btn btn-primary">Finalizar Lectura</button>

    <script>
        document.getElementById('finalize-reading').addEventListener('click', function () {
            Swal.fire({
                title: 'Evalúa el texto',
                html: `
                    <div>
                        <h3>Califica el nivel de humor:</h3>
                        <div id="humor-rating" class="star-rating">
                            <span data-value="1">★</span>
                            <span data-value="2">★</span>
                            <span data-value="3">★</span>
                            <span data-value="4">★</span>
                            <span data-value="5">★</span>
                        </div>
                        <h3>Facilidad de comprensión:</h3>
                        <div id="compression-rating" class="star-rating">
                            <span data-value="1">★</span>
                            <span data-value="2">★</span>
                            <span data-value="3">★</span>
                            <span data-value="4">★</span>
                            <span data-value="5">★</span>
                        </div>
                        <h3>¿Cuál prefieres?</h3>
                        <div id="preference-buttons" data-selected="">
                            <button type="button" class="btn btn-choice" data-value="humor">Con humor</button>
                            <button type="button" class="btn btn-choice" data-value="original">Sin humor</button>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                didOpen: () => {
                    // Configurar las estrellas
                    document.querySelectorAll('.star-rating span').forEach(star => {
                        star.addEventListener('click', function () {
                            const rating = this.getAttribute('data-value');
                            const parent = this.parentNode;
                            parent.setAttribute('data-selected', rating);

                            // Destacar las estrellas seleccionadas
                            parent.querySelectorAll('span').forEach(s => {
                                s.style.color = s.getAttribute('data-value') <= rating ? 'gold' : 'gray';
                            });
                        });
                    });

                    // Configurar los botones de preferencia
                    document.querySelectorAll('#preference-buttons .btn-choice').forEach(button => {
                        button.addEventListener('click', function () {
                            // Quitar selección previa
                            document.querySelectorAll('#preference-buttons .btn-choice').forEach(btn => btn.classList.remove('selected'));

                            // Agregar clase seleccionada
                            this.classList.add('selected');

                            // Actualizar atributo data-selected
                            document.getElementById('preference-buttons').setAttribute('data-selected', this.getAttribute('data-value'));
                        });
                    });
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const humorRating = document.getElementById('humor-rating').getAttribute('data-selected');
                    const compressionRating = document.getElementById('compression-rating').getAttribute('data-selected');
                    const preference = document.getElementById('preference-buttons').getAttribute('data-selected');

                    // Validar que se hayan seleccionado todas las opciones
                    if (!humorRating || !compressionRating || !preference) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Por favor, completa todas las evaluaciones.',
                            icon: 'error',
                        });
                        return;
                    }

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
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Gracias',
                                    text: 'Tu evaluación ha sido registrada.',
                                    icon: 'success',
                                }).then(() => {
                                    window.location.href = '/'; // Redirige al index principal
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error',
                                });
                            }
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
