<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Evaluación - Centro de Materiales y Ensayos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .instructor-card {
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
        .apprentice-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .specialty-badge {
            font-size: 0.8rem;
        }
        .evaluation-score {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .progress {
            height: 1.5rem;
        }
        .rating-badge {
            font-size: 0.9rem;
            padding: 0.35em 0.65em;
        }
        .nav-tabs .nav-link.active {
            font-weight: bold;
            border-bottom: 3px solid #0d6efd;
        }
        .response-count {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #0d6efd;
            color: white;
            font-size: 0.8rem;
            margin-left: 5px;
        }
        .question-stats {
            border-left: 3px solid #dee2e6;
            padding-left: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4">RESULTADOS DE EVALUACIÓN DE INSTRUCTORES</h1>
            <h2 class="text-muted">CENTRO DE MATERIALES Y ENSAYOS</h2>
            <p class="lead">Reporte consolidado de las evaluaciones realizadas por los aprendices a los instructores del centro.</p>
        </div>

        <!-- Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="dateFilter" class="form-label">Periodo</label>
                            <select class="form-select" id="dateFilter">
                                <option selected>Trimestre 1 - 2023</option>
                                <option>Trimestre 2 - 2023</option>
                                <option>Trimestre 3 - 2023</option>
                                <option>Trimestre 4 - 2023</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="specialtyFilter" class="form-label">Especialidad</label>
                            <select class="form-select" id="specialtyFilter">
                                <option selected>Todas</option>
                                <option>Materiales Industriales</option>
                                <option>Ensayo de Materiales</option>
                                <option>Metalurgia</option>
                                <option>Control de Calidad</option>
                                <option>Análisis de Fallas</option>
                                <option>Tecnología de Materiales</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-2"></i>Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de Instructores -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5" id="instructorsContainer">
            <!-- Las cards de instructores se generarán dinámicamente con JavaScript -->
        </div>

        <!-- Detalle de Evaluación (aparece al seleccionar un instructor) -->
        <div class="card mb-4 d-none" id="evaluationDetail">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Detalle de Evaluación: <span id="detailInstructorName"></span></h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4 text-center">
                        <img src="" alt="Instructor" id="detailInstructorImg" class="instructor-img mb-3">
                        <h5 id="detailInstructorSpecialty" class="badge bg-primary specialty-badge"></h5>
                        <p class="text-muted mb-1"><small id="detailInstructorDocument"></small></p>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-muted">Puntuación Promedio</h6>
                                        <div class="evaluation-score text-primary mb-2" id="averageScore">4.8</div>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 96%" aria-valuenow="96" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted">Basado en 3 evaluaciones</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <h6 class="card-subtitle mb-2 text-muted">Distribución de Calificaciones</h6>
                                        <div class="d-flex justify-content-around mb-2">
                                            <span class="badge bg-success rating-badge">5.0 <i class="fas fa-star ms-1"></i></span>
                                            <span class="badge bg-primary rating-badge">4.0 <i class="fas fa-star ms-1"></i></span>
                                            <span class="badge bg-warning rating-badge">3.0 <i class="fas fa-star ms-1"></i></span>
                                            <span class="badge bg-danger rating-badge">2.0 <i class="fas fa-star ms-1"></i></span>
                                        </div>
                                        <div class="d-flex justify-content-around">
                                            <small>12</small>
                                            <small>5</small>
                                            <small>1</small>
                                            <small>0</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pestañas para navegar entre secciones -->
                <ul class="nav nav-tabs mb-4" id="evaluationTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="questions-tab" data-bs-toggle="tab" data-bs-target="#questions" type="button" role="tab">Preguntas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="apprentices-tab" data-bs-toggle="tab" data-bs-target="#apprentices" type="button" role="tab">Aprendices <span class="response-count">3</span></button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab">Comentarios <span class="response-count">2</span></button>
                    </li>
                </ul>

                <div class="tab-content" id="evaluationTabContent">
                    <!-- Tab de Preguntas -->
                    <div class="tab-pane fade show active" id="questions" role="tabpanel">
                        <div class="list-group">
                            <!-- Las preguntas y estadísticas se generarán dinámicamente -->
                        </div>
                    </div>

                    <!-- Tab de Aprendices -->
                    <div class="tab-pane fade" id="apprentices" role="tabpanel">
                        <div class="row" id="apprenticesList">
                            <!-- Listado de aprendices que evaluaron -->
                        </div>
                    </div>

                    <!-- Tab de Comentarios -->
                    <div class="tab-pane fade" id="comments" role="tabpanel">
                        <div id="commentsList">
                            <!-- Comentarios y sugerencias -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Datos de ejemplo para los instructores
        const instructors = [
            {
                id: 1,
                name: "CANTOR RODRIGUEZ JOSE SANTOS",
                specialty: "Materiales Industriales",
                document: "CC 12345678",
                image: "https://randomuser.me/api/portraits/men/1.jpg",
                averageScore: 4.8,
                evaluations: 3,
                ratings: {5: 12, 4: 5, 3: 1, 2: 0, 1: 0}
            },
            {
                id: 2,
                name: "CARDONA RODRIGUEZ ARLEN DAVID",
                specialty: "Ensayo de Materiales",
                document: "CC 23456789",
                image: "https://randomuser.me/api/portraits/women/2.jpg",
                averageScore: 4.5,
                evaluations: 3,
                ratings: {5: 8, 4: 7, 3: 2, 2: 1, 1: 0}
            },
            {
                id: 3,
                name: "CARDOZO HERRERA JAIME ABELARDO",
                specialty: "Metalurgia",
                document: "CC 34567890",
                image: "https://randomuser.me/api/portraits/men/3.jpg",
                averageScore: 4.2,
                evaluations: 2,
                ratings: {5: 5, 4: 6, 3: 3, 2: 1, 1: 0}
            },
            {
                id: 4,
                name: "CARVAJAL GOMEZ ROSMIRA",
                specialty: "Control de Calidad",
                document: "CC 45678901",
                image: "https://randomuser.me/api/portraits/women/4.jpg",
                averageScore: 4.9,
                evaluations: 3,
                ratings: {5: 14, 4: 3, 3: 0, 2: 0, 1: 0}
            },
            {
                id: 5,
                name: "CASTILLO SAENZ FANNY HELENA",
                specialty: "Análisis de Fallas",
                document: "CC 56789012",
                image: "https://randomuser.me/api/portraits/women/5.jpg",
                averageScore: 4.6,
                evaluations: 3,
                ratings: {5: 9, 4: 8, 3: 1, 2: 0, 1: 0}
            },
            {
                id: 6,
                name: "CASTRO CUEVAS RAFAEL HERNAN",
                specialty: "Tecnología de Materiales",
                document: "CC 67890123",
                image: "https://randomuser.me/api/portraits/men/6.jpg",
                averageScore: 4.3,
                evaluations: 2,
                ratings: {5: 6, 4: 7, 3: 2, 2: 0, 1: 0}
            }
        ];

        // Preguntas de evaluación (las mismas que en el formulario)
        const questions = [
            "El Instructor/a presentó el programa de formación y sus competencias al inicio del trimestre",
            "El instructor/a demostró dominio en los temas de la competencia orientada (en sus aspectos teóricos y/o prácticos)",
            "El instructor/a promovió espacios para la participación de los aprendices en su formación",
            "El instructor/a promovió el desarrollo de un pensamiento crítico constructivo a través de sus actividades",
            "El instructor/a ofreció una orientación clara a las preguntas de los aprendices en el desarrollo de la formación",
            "El instructor/a propuso actividades que fortalecieron el aprendizaje autónomo",
            "Las actividades de aprendizaje son coherentes con relación a los contenidos del programa de formación",
            "El instructor/a evaluó y retroalimentó a los aprendices respecto a su desempeño durante el trimestre",
            "El instructor/a asistió puntualmente a las sesiones de formación y actividades programadas",
            "El instructor/a impartió los contenidos temáticos asociados a los resultados de aprendizaje",
            "El instructor/a se mostró respetuoso y tolerante hacia los demás",
            "El instructor/a empleó estrategias didácticas que dinamizaron el aprendizaje y la comprensión de los temas",
            "El instructor/a se presentó al ambiente de formación con los elementos adecuados y excelente presentación personal",
            "El Instructor promovió el uso de la biblioteca del Complejo Sur"
        ];

        // Datos de aprendices aleatorios
        const apprentices = [
            { id: 1, name: "JUAN CARLOS PEREZ GOMEZ", document: "CC 1023456789", ficha: "1865421", image: "https://randomuser.me/api/portraits/men/10.jpg" },
            { id: 2, name: "MARIA FERNANDA LOPEZ MARTINEZ", document: "CC 2034567890", ficha: "1865421", image: "https://randomuser.me/api/portraits/women/11.jpg" },
            { id: 3, name: "CARLOS ANDRES GARCIA RODRIGUEZ", document: "CC 3045678901", ficha: "1865422", image: "https://randomuser.me/api/portraits/men/12.jpg" },
            { id: 4, name: "ANA MARIA SANCHEZ DIAZ", document: "CC 4056789012", ficha: "1865423", image: "https://randomuser.me/api/portraits/women/13.jpg" },
            { id: 5, name: "LUIS MIGUEL RAMIREZ GONZALEZ", document: "CC 5067890123", ficha: "1865422", image: "https://randomuser.me/api/portraits/men/14.jpg" },
            { id: 6, name: "SOFIA ALEJANDRA CASTRO HERNANDEZ", document: "CC 6078901234", ficha: "1865423", image: "https://randomuser.me/api/portraits/women/15.jpg" }
        ];

        // Generar evaluaciones aleatorias para cada instructor
        instructors.forEach(instructor => {
            instructor.apprentices = [];
            instructor.comments = [];
            
            // Seleccionar hasta 3 aprendices aleatorios
            const selectedApprentices = getRandomSubset(apprentices, 3);
            
            selectedApprentices.forEach(apprentice => {
                // Generar respuestas aleatorias para cada pregunta
                const responses = {};
                questions.forEach((question, index) => {
                    if (index < 13) { // Preguntas con escala Siempre/Algunas veces/Nunca
                        const options = ["Siempre", "Algunas veces", "Nunca"];
                        responses[`q${index+1}`] = getRandomOption(options, index === 0 ? 0.8 : (index < 10 ? 0.7 : 0.9));
                    } else { // Pregunta 14 (Sí/No)
                        responses[`q14`] = Math.random() > 0.3 ? "Sí" : "No";
                    }
                });
                
                // Agregar comentarios aleatorios (50% de probabilidad)
                const hasComments = Math.random() > 0.5;
                const comments = hasComments ? getRandomComment() : "";
                const suggestions = hasComments ? getRandomSuggestion() : "";
                
                instructor.apprentices.push({
                    ...apprentice,
                    responses: responses,
                    date: getRandomDate(),
                    comments: comments,
                    suggestions: suggestions
                });
                
                if (comments) {
                    instructor.comments.push({
                        apprentice: apprentice.name,
                        comment: comments,
                        suggestion: suggestions
                    });
                }
            });
        });

        // Funciones auxiliares
        function getRandomSubset(array, max) {
            const shuffled = [...array].sort(() => 0.5 - Math.random());
            return shuffled.slice(0, Math.floor(Math.random() * max) + 1);
        }

        function getRandomOption(options, bias = 0.5) {
            const rand = Math.random();
            if (rand < bias) return options[0];
            if (rand < bias + (1 - bias) / 2) return options[1];
            return options[2];
        }

        function getRandomDate() {
            const start = new Date(2023, 0, 1);
            const end = new Date();
            return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime())).toLocaleDateString();
        }

        function getRandomComment() {
            const comments = [
                "Excelente instructor, muy claro en sus explicaciones.",
                "Buen dominio de los temas pero podría mejorar en la organización del tiempo.",
                "Muy paciente con los aprendices y dispuesto a ayudar.",
                "A veces no explica con suficiente claridad los conceptos más complejos.",
                "Promueve un buen ambiente de aprendizaje en el aula.",
                "Podría incluir más ejemplos prácticos en sus clases.",
                "Muy profesional y comprometido con la formación.",
                "Las retroalimentaciones podrían ser más detalladas."
            ];
            return comments[Math.floor(Math.random() * comments.length)];
        }

        function getRandomSuggestion() {
            const suggestions = [
                "Incluir más ejercicios prácticos en las sesiones.",
                "Usar más material didáctico visual.",
                "Organizar visitas técnicas a empresas relacionadas.",
                "Incorporar más tecnología en las clases.",
                "Programar sesiones de repaso antes de las evaluaciones.",
                "Fomentar más el trabajo en equipo entre aprendices.",
                "Proporcionar material de estudio adicional.",
                "Mejorar la distribución del tiempo en las clases."
            ];
            return suggestions[Math.floor(Math.random() * suggestions.length)];
        }

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
                        <div class="evaluation-score text-primary mb-2">${instructor.averageScore.toFixed(1)}</div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: ${instructor.averageScore * 20}%" aria-valuenow="${instructor.averageScore * 20}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="card-text text-muted"><small>${instructor.evaluations} evaluaciones</small></p>
                    </div>
                </div>
            `;
            instructorsContainer.appendChild(card);
        });

        // Elementos del detalle de evaluación
        const evaluationDetail = document.getElementById('evaluationDetail');
        const detailInstructorName = document.getElementById('detailInstructorName');
        const detailInstructorImg = document.getElementById('detailInstructorImg');
        const detailInstructorSpecialty = document.getElementById('detailInstructorSpecialty');
        const detailInstructorDocument = document.getElementById('detailInstructorDocument');
        const averageScore = document.getElementById('averageScore');
        const questionsList = document.querySelector('#questions .list-group');
        const apprenticesList = document.getElementById('apprenticesList');
        const commentsList = document.getElementById('commentsList');

        // Manejar la selección de instructor
        document.querySelectorAll('.instructor-card').forEach(card => {
            card.addEventListener('click', function() {
                const instructorId = this.getAttribute('data-instructor-id');
                const instructor = instructors.find(i => i.id == instructorId);
                
                // Actualizar la información del instructor en el detalle
                detailInstructorName.textContent = instructor.name;
                detailInstructorImg.src = instructor.image;
                detailInstructorImg.alt = instructor.name;
                detailInstructorSpecialty.textContent = instructor.specialty;
                detailInstructorDocument.textContent = instructor.document;
                averageScore.textContent = instructor.averageScore.toFixed(1);
                
                // Actualizar el contador de respuestas en las pestañas
                document.querySelector('#apprentices-tab .response-count').textContent = instructor.apprentices.length;
                document.querySelector('#comments-tab .response-count').textContent = instructor.comments.length;
                
                // Generar las estadísticas por pregunta
                questionsList.innerHTML = '';
                questions.forEach((question, index) => {
                    // Calcular estadísticas para esta pregunta
                    const stats = { "Siempre": 0, "Algunas veces": 0, "Nunca": 0, "Sí": 0, "No": 0 };
                    
                    instructor.apprentices.forEach(apprentice => {
                        const response = apprentice.responses[`q${index+1}`];
                        stats[response]++;
                    });
                    
                    // Crear elemento para mostrar la pregunta y estadísticas
                    const questionItem = document.createElement('div');
                    questionItem.className = 'list-group-item';
                    
                    // Para la pregunta 14 (Sí/No) mostramos un formato diferente
                    if (index === 13) {
                        const total = stats["Sí"] + stats["No"];
                        questionItem.innerHTML = `
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="me-3">
                                    <h6 class="mb-1">${index+1}. ${question}</h6>
                                </div>
                                <div class="question-stats">
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="me-2">Sí:</span>
                                        <div class="progress flex-grow-1" style="height: 10px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: ${stats["Sí"] / total * 100}%" aria-valuenow="${stats["Sí"]}" aria-valuemin="0" aria-valuemax="${total}"></div>
                                        </div>
                                        <span class="ms-2">${stats["Sí"]} (${Math.round(stats["Sí"] / total * 100)}%)</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">No:</span>
                                        <div class="progress flex-grow-1" style="height: 10px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: ${stats["No"] / total * 100}%" aria-valuenow="${stats["No"]}" aria-valuemin="0" aria-valuemax="${total}"></div>
                                        </div>
                                        <span class="ms-2">${stats["No"]} (${Math.round(stats["No"] / total * 100)}%)</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else {
                        const total = stats["Siempre"] + stats["Algunas veces"] + stats["Nunca"];
                        questionItem.innerHTML = `
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="me-3">
                                    <h6 class="mb-1">${index+1}. ${question}</h6>
                                </div>
                                <div class="question-stats">
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="me-2">Siempre:</span>
                                        <div class="progress flex-grow-1" style="height: 10px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: ${stats["Siempre"] / total * 100}%" aria-valuenow="${stats["Siempre"]}" aria-valuemin="0" aria-valuemax="${total}"></div>
                                        </div>
                                        <span class="ms-2">${stats["Siempre"]} (${Math.round(stats["Siempre"] / total * 100)}%)</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="me-2">Algunas veces:</span>
                                        <div class="progress flex-grow-1" style="height: 10px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: ${stats["Algunas veces"] / total * 100}%" aria-valuenow="${stats["Algunas veces"]}" aria-valuemin="0" aria-valuemax="${total}"></div>
                                        </div>
                                        <span class="ms-2">${stats["Algunas veces"]} (${Math.round(stats["Algunas veces"] / total * 100)}%)</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">Nunca:</span>
                                        <div class="progress flex-grow-1" style="height: 10px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: ${stats["Nunca"] / total * 100}%" aria-valuenow="${stats["Nunca"]}" aria-valuemin="0" aria-valuemax="${total}"></div>
                                        </div>
                                        <span class="ms-2">${stats["Nunca"]} (${Math.round(stats["Nunca"] / total * 100)}%)</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    
                    questionsList.appendChild(questionItem);
                });
                
                // Generar el listado de aprendices
                apprenticesList.innerHTML = '';
                instructor.apprentices.forEach(apprentice => {
                    const apprenticeCard = document.createElement('div');
                    apprenticeCard.className = 'col-md-6 mb-3';
                    apprenticeCard.innerHTML = `
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="${apprentice.image}" alt="${apprentice.name}" class="apprentice-img me-3">
                                    <div>
                                        <h6 class="mb-1">${apprentice.name}</h6>
                                        <p class="text-muted mb-1"><small>${apprentice.document}</small></p>
                                        <p class="text-muted mb-0"><small>Ficha: ${apprentice.ficha}</small></p>
                                        <p class="text-muted"><small>Evaluó el: ${apprentice.date}</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    apprenticesList.appendChild(apprenticeCard);
                });
                
                // Generar los comentarios
                commentsList.innerHTML = '';
                if (instructor.comments.length > 0) {
                    instructor.comments.forEach(comment => {
                        const commentItem = document.createElement('div');
                        commentItem.className = 'card mb-3';
                        commentItem.innerHTML = `
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">${comment.apprentice}</h6>
                                    <span class="badge bg-light text-dark"><small>${getRandomDate()}</small></span>
                                </div>
                                <div class="mb-3">
                                    <p class="fw-bold mb-1">Comentario:</p>
                                    <p class="mb-0">${comment.comment}</p>
                                </div>
                                <div>
                                    <p class="fw-bold mb-1">Sugerencia:</p>
                                    <p class="mb-0">${comment.suggestion}</p>
                                </div>
                            </div>
                        `;
                        commentsList.appendChild(commentItem);
                    });
                } else {
                    commentsList.innerHTML = '<div class="alert alert-info">No hay comentarios registrados para este instructor.</div>';
                }
                
                // Mostrar el detalle
                evaluationDetail.classList.remove('d-none');
                
                // Desplazarse a la sección de detalle
                evaluationDetail.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Activar la primera pestaña por defecto
        const firstTab = new bootstrap.Tab(document.querySelector('#evaluationTabs .nav-link'));
        firstTab.show();
    </script>
</body>
</html>