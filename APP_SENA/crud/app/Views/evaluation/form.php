<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?><</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .question-card {
            margin-bottom: 1.5rem;
            border-left: 4px solid #0d6efd;
        }
        .range-value {
            display: inline-block;
            width: 30px;
            text-align: center;
            font-weight: bold;
        }
        .category-header {
            background-color: #f8f9fa;
            padding: 0.5rem 1rem;
            margin-top: 1.5rem;
            border-radius: 0.25rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">Formulario de Evaluación</h1>
        
        <!-- Card del Evaluado -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Información del Evaluado</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> Profesor Ejemplo</p>
                        <p><strong>Cargo:</strong> Instructor Principal</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Curso:</strong> Desarrollo Web Avanzado</p>
                        <p><strong>Periodo:</strong> 2023-2</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card del Evaluador -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Información del Evaluador</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nombre:</strong> Estudiante Ejemplo</p>
                        <p><strong>ID:</strong> 123456</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Programa:</strong> Ingeniería de Sistemas</p>
                        <p><strong>Fecha:</strong> <span id="current-date"></span></p>
                    </div>
                </div>
            </div>
        </div>
        
        <form id="evaluationForm">
            <!-- Instructor Teaching Skills -->
            <div class="category-header">Habilidades de Enseñanza del Instructor</div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">1. Instructor Teaching Skills</h5>
                    <p class="card-text">This is descriptions</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q1" name="q1" value="3">
                        <span class="range-value" id="q1-value">3</span>
                    </div>
                </div>
            </div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">2. Instructor Teaching Skills</h5>
                    <p class="card-text">The instructor responds to questions effectively</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q2" name="q2" value="3">
                        <span class="range-value" id="q2-value">3</span>
                    </div>
                </div>
            </div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">3. Instructor Teaching Skills</h5>
                    <p class="card-text">The instructor provides practical examples</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q3" name="q3" value="3">
                        <span class="range-value" id="q3-value">3</span>
                    </div>
                </div>
            </div>
            
            <!-- Course Content Evaluation -->
            <div class="category-header">Evaluación del Contenido del Curso</div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">4. Course Content Evaluation</h5>
                    <p class="card-text">The course content is up-to-date</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q4" name="q4" value="3">
                        <span class="range-value" id="q4-value">3</span>
                    </div>
                </div>
            </div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">5. Course Content Evaluation</h5>
                    <p class="card-text">The course materials are well-organized</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q5" name="q5" value="3">
                        <span class="range-value" id="q5-value">3</span>
                    </div>
                </div>
            </div>
            
            <!-- Classroom Environment -->
            <div class="category-header">Ambiente del Aula</div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">6. Classroom Environment</h5>
                    <p class="card-text">The classroom environment is conducive to learning</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q6" name="q6" value="3">
                        <span class="range-value" id="q6-value">3</span>
                    </div>
                </div>
            </div>
            
            <!-- Technical Expertise -->
            <div class="category-header">Experiencia Técnica</div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">7. Technical Expertise</h5>
                    <p class="card-text">The instructor demonstrates deep technical knowledge</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q7" name="q7" value="3">
                        <span class="range-value" id="q7-value">3</span>
                    </div>
                </div>
            </div>
            
            <!-- Student Engagement -->
            <div class="category-header">Participación Estudiantil</div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">8. Student Engagement</h5>
                    <p class="card-text">The instructor encourages student participation</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q8" name="q8" value="3">
                        <span class="range-value" id="q8-value">3</span>
                    </div>
                </div>
            </div>
            
            <!-- Feedback Quality -->
            <div class="category-header">Calidad de Retroalimentación</div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">9. Feedback Quality</h5>
                    <p class="card-text">Feedback on assignments is constructive</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q9" name="q9" value="3">
                        <span class="range-value" id="q9-value">3</span>
                    </div>
                </div>
            </div>
            
            <!-- Course Organization -->
            <div class="category-header">Organización del Curso</div>
            
            <div class="card question-card">
                <div class="card-body">
                    <h5 class="card-title">10. Course Organization</h5>
                    <p class="card-text">The course schedule is well-structured</p>
                    <div class="d-flex align-items-center">
                        <input type="range" class="form-range mx-3" min="0" max="5" step="1" id="q10" name="q10" value="3">
                        <span class="range-value" id="q10-value">3</span>
                    </div>
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="reset" class="btn btn-outline-secondary me-md-2">Limpiar</button>
                <button type="submit" class="btn btn-primary">Enviar Evaluación</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mostrar la fecha actual
        const now = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = now.toLocaleDateString('es-ES', options);
        
        // Actualizar los valores mostrados cuando se mueven los sliders
        for (let i = 1; i <= 10; i++) {
            const slider = document.getElementById(`q${i}`);
            const valueDisplay = document.getElementById(`q${i}-value`);
            
            slider.addEventListener('input', function() {
                valueDisplay.textContent = this.value;
            });
        }
        
        // Manejar el envío del formulario
        document.getElementById('evaluationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Evaluación enviada correctamente');
            // Aquí podrías agregar código para enviar los datos a un servidor
        });
    </script>
</body>
</html>