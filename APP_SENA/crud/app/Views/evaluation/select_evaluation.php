<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación de Instructores - Centro de Materiales y Ensayos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .instructor-card {
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        .instructor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .instructor-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
            border: 3px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .active-card {
            border: 2px solid #0d6efd;
        }
        .specialty-badge {
            font-size: 0.8rem;
        }
        .apprentice-card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .apprentice-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        .info-value {
            color: #212529;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">PERCEPCIÓN DE LA FORMACIÓN PROFESIONAL INTEGRAL</h1>
            <h2 class="text-muted">CENTRO DE MATERIALES Y ENSAYOS</h2>
            <p class="lead">Esta encuesta se realiza con el objetivo de determinar la percepción de los aprendices frente al proceso de formación Profesional del Centro de Materiales y Ensayos.</p>
        </div>

        <!-- Card del Aprendiz -->
        <div class="card mb-5 apprentice-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <img src="https://randomuser.me/api/portraits/men/10.jpg" alt="Foto aprendiz" class="apprentice-img mb-3 mb-md-0">
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <p class="mb-1 info-label">NOMBRE</p>
                                <p class="info-value">JUAN CARLOS</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <p class="mb-1 info-label">PRIMER APELLIDO</p>
                                <p class="info-value">PEREZ</p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <p class="mb-1 info-label">SEGUNDO APELLIDO</p>
                                <p class="info-value">GOMEZ</p>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="mb-1 info-label">TIPO DOCUMENTO</p>
                                <p class="info-value">Cédula de Ciudadanía</p>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="mb-1 info-label">NÚMERO DOCUMENTO</p>
                                <p class="info-value">1023456789</p>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="mb-1 info-label">FICHA</p>
                                <p class="info-value">1865421</p>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="mb-1 info-label">NIVEL DE FORMACIÓN</p>
                                <p class="info-value">Técnico</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mb-4">Seleccione el instructor a evaluar</h3>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5" id="instructorsContainer">
            <!-- Las cards de instructores se generarán dinámicamente con JavaScript -->
        </div>
    </div>

    <!-- Modal para el formulario de evaluación -->
    <div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="evaluationModalLabel">Evaluación del Instructor: <span id="selectedInstructorName"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="evaluationForm">
                        <div class="mb-4">
                            <p class="fw-bold">1. El Instructor/a presentó el programa de formación y sus competencias al inicio del trimestre</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q1" id="q1_always" value="Siempre" required>
                                <label class="form-check-label" for="q1_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q1" id="q1_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q1_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q1" id="q1_never" value="Nunca">
                                <label class="form-check-label" for="q1_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">2. El instructor/a demostró dominio en los temas de la competencia orientada (en sus aspectos teóricos y/o prácticos)</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2_always" value="Siempre" required>
                                <label class="form-check-label" for="q2_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q2_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2_never" value="Nunca">
                                <label class="form-check-label" for="q2_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">3. El instructor/a promovió espacios para la participación de los aprendices en su formación</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3_always" value="Siempre" required>
                                <label class="form-check-label" for="q3_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q3_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3_never" value="Nunca">
                                <label class="form-check-label" for="q3_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">4. El instructor/a promovió el desarrollo de un pensamiento crítico constructivo a través de sus actividades</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4_always" value="Siempre" required>
                                <label class="form-check-label" for="q4_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q4_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4_never" value="Nunca">
                                <label class="form-check-label" for="q4_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">5. El instructor/a ofreció una orientación clara a las preguntas de los aprendices en el desarrollo de la formación</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q5" id="q5_always" value="Siempre" required>
                                <label class="form-check-label" for="q5_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q5" id="q5_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q5_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q5" id="q5_never" value="Nunca">
                                <label class="form-check-label" for="q5_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">6. El instructor/a propuso actividades que fortalecieron el aprendizaje autónomo</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q6" id="q6_always" value="Siempre" required>
                                <label class="form-check-label" for="q6_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q6" id="q6_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q6_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q6" id="q6_never" value="Nunca">
                                <label class="form-check-label" for="q6_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">7. Las actividades de aprendizaje son coherentes con relación a los contenidos del programa de formación</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q7" id="q7_always" value="Siempre" required>
                                <label class="form-check-label" for="q7_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q7" id="q7_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q7_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q7" id="q7_never" value="Nunca">
                                <label class="form-check-label" for="q7_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">8. El instructor/a evaluó y retroalimentó a los aprendices respecto a su desempeño durante el trimestre</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q8" id="q8_always" value="Siempre" required>
                                <label class="form-check-label" for="q8_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q8" id="q8_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q8_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q8" id="q8_never" value="Nunca">
                                <label class="form-check-label" for="q8_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">9. El instructor/a asistió puntualmente a las sesiones de formación y actividades programadas</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q9" id="q9_always" value="Siempre" required>
                                <label class="form-check-label" for="q9_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q9" id="q9_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q9_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q9" id="q9_never" value="Nunca">
                                <label class="form-check-label" for="q9_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">10. El instructor/a impartió los contenidos temáticos asociados a los resultados de aprendizaje</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q10" id="q10_always" value="Siempre" required>
                                <label class="form-check-label" for="q10_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q10" id="q10_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q10_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q10" id="q10_never" value="Nunca">
                                <label class="form-check-label" for="q10_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">11. El instructor/a se mostró respetuoso y tolerante hacia los demás</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q11" id="q11_always" value="Siempre" required>
                                <label class="form-check-label" for="q11_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q11" id="q11_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q11_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q11" id="q11_never" value="Nunca">
                                <label class="form-check-label" for="q11_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">12. El instructor/a empleó estrategias didácticas que dinamizaron el aprendizaje y la comprensión de los temas</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q12" id="q12_always" value="Siempre" required>
                                <label class="form-check-label" for="q12_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q12" id="q12_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q12_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q12" id="q12_never" value="Nunca">
                                <label class="form-check-label" for="q12_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">13. El instructor/a se presentó al ambiente de formación con los elementos adecuados y excelente presentación personal</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q13" id="q13_always" value="Siempre" required>
                                <label class="form-check-label" for="q13_always">Siempre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q13" id="q13_sometimes" value="Algunas veces">
                                <label class="form-check-label" for="q13_sometimes">Algunas veces</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q13" id="q13_never" value="Nunca">
                                <label class="form-check-label" for="q13_never">Nunca</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="fw-bold">14. El Instructor promovió el uso de la biblioteca del Complejo Sur</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q14" id="q14_yes" value="Sí" required>
                                <label class="form-check-label" for="q14_yes">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q14" id="q14_no" value="No">
                                <label class="form-check-label" for="q14_no">No</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="suggestions" class="form-label fw-bold">15. Escriba sugerencias para el mejoramiento de la formación</label>
                            <textarea class="form-control" id="suggestions" name="suggestions" rows="3"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="comments" class="form-label fw-bold">16. Escriba comentarios sobre aspectos actitudinales del instructor</label>
                            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="submitEvaluation">Enviar Evaluación</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Datos de ejemplo para los instructores (en un caso real, estos datos vendrían de una base de datos)
        const instructors = [
            {
                id: 1,
                name: "CANTOR RODRIGUEZ JOSE SANTOS",
                specialty: "Materiales Industriales",
                document: "CC 12345678",
                image: "https://randomuser.me/api/portraits/men/1.jpg"
            },
            {
                id: 2,
                name: "CARDONA RODRIGUEZ ARLEN DAVID",
                specialty: "Ensayo de Materiales",
                document: "CC 23456789",
                image: "https://randomuser.me/api/portraits/women/2.jpg"
            },
            {
                id: 3,
                name: "CARDOZO HERRERA JAIME ABELARDO",
                specialty: "Metalurgia",
                document: "CC 34567890",
                image: "https://randomuser.me/api/portraits/men/3.jpg"
            },
            {
                id: 4,
                name: "CARVAJAL GOMEZ ROSMIRA",
                specialty: "Control de Calidad",
                document: "CC 45678901",
                image: "https://randomuser.me/api/portraits/women/4.jpg"
            },
            {
                id: 5,
                name: "CASTILLO SAENZ FANNY HELENA",
                specialty: "Análisis de Fallas",
                document: "CC 56789012",
                image: "https://randomuser.me/api/portraits/women/5.jpg"
            },
            {
                id: 6,
                name: "CASTRO CUEVAS RAFAEL HERNAN",
                specialty: "Tecnología de Materiales",
                document: "CC 67890123",
                image: "https://randomuser.me/api/portraits/men/6.jpg"
            }
        ];

        // Inicializar el modal de Bootstrap
        const evaluationModal = new bootstrap.Modal(document.getElementById('evaluationModal'));
        const selectedInstructorName = document.getElementById('selectedInstructorName');
        const submitEvaluationBtn = document.getElementById('submitEvaluation');

        // Generar las cards de instructores
        const instructorsContainer = document.getElementById('instructorsContainer');

        instructors.forEach(instructor => {
            const card = document.createElement('div');
            card.className = 'col';
            card.innerHTML = `
                <div class="card instructor-card h-100" data-instructor-id="${instructor.id}">
                    <div class="card-body text-center">
                        <img src="${instructor.image}" alt="${instructor.name}" class="instructor-img mb-3">
                        <h5 class="card-title">${instructor.name}</h5>
                        <span class="badge bg-primary specialty-badge mb-2">${instructor.specialty}</span>
                        <p class="card-text text-muted"><small>${instructor.document}</small></p>
                    </div>
                </div>
            `;
            instructorsContainer.appendChild(card);
        });

        // Manejar la selección de instructor
        document.querySelectorAll('.instructor-card').forEach(card => {
            card.addEventListener('click', function() {
                // Remover la clase active de todas las cards
                document.querySelectorAll('.instructor-card').forEach(c => {
                    c.classList.remove('active-card');
                });
                
                // Agregar la clase active a la card seleccionada
                this.classList.add('active-card');
                
                // Obtener el ID del instructor seleccionado
                const instructorId = this.getAttribute('data-instructor-id');
                const instructor = instructors.find(i => i.id == instructorId);
                
                // Mostrar el nombre del instructor en el modal
                selectedInstructorName.textContent = instructor.name;
                
                // Mostrar el modal de evaluación
                evaluationModal.show();
            });
        });

        // Manejar el envío del formulario
        submitEvaluationBtn.addEventListener('click', function() {
            const form = document.getElementById('evaluationForm');
            const requiredRadios = form.querySelectorAll('input[type="radio"]:required');
            let allValid = true;
            
            // Validar que todos los campos requeridos estén completos
            requiredRadios.forEach(radio => {
                const name = radio.getAttribute('name');
                const checked = form.querySelector(`input[name="${name}"]:checked`);
                if (!checked) {
                    allValid = false;
                    const question = radio.closest('.mb-4');
                    question.classList.add('border', 'border-danger', 'p-3', 'rounded');
                    
                    // Remover el estilo después de 3 segundos
                    setTimeout(() => {
                        question.classList.remove('border', 'border-danger', 'p-3', 'rounded');
                    }, 3000);
                }
            });
            
            if (allValid) {
                // Aquí iría el código para enviar el formulario (AJAX, etc.)
                alert('Evaluación enviada correctamente. ¡Gracias por tu feedback!');
                evaluationModal.hide();
                form.reset();
                
                // Deseleccionar la card del instructor
                document.querySelectorAll('.instructor-card').forEach(c => {
                    c.classList.remove('active-card');
                });
            } else {
                alert('Por favor completa todas las preguntas requeridas.');
            }
        });
    </script>
</body>
</html>