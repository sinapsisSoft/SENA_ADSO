<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Preguntas</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .question-card {
            transition: all 0.3s ease;
        }
        .question-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .badge-answer-type {
            font-size: 0.8rem;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .modal-header {
            background-color: #0d6efd;
            color: white;
        }
        .btn-close-white {
            filter: invert(1);
        }
        .form-switch .form-check-input {
            width: 3em;
            height: 1.5em;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-6 fw-bold">
                    <i class="fas fa-question-circle me-2"></i>Administración de Preguntas
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Preguntas</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="search" class="form-label">Buscar</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" placeholder="Texto de la pregunta...">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="questionnaire" class="form-label">Cuestionario</label>
                                <select class="form-select" id="questionnaire">
                                    <option selected value="">Todos</option>
                                    <option value="1">Habilidades de enseñanza</option>
                                    <option value="2">Contenido del curso</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="answer-type" class="form-label">Tipo de respuesta</label>
                                <select class="form-select" id="answer-type">
                                    <option selected value="">Todos</option>
                                    <option value="scale_1to5">Escala 1-5</option>
                                    <option value="yes_no">Sí/No</option>
                                    <option value="open">Abierta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid gap-2">
                    <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#questionModal">
                        <i class="fas fa-plus me-2"></i>Nueva Pregunta
                    </button>
                </div>
            </div>
        </div>

        <!-- Listado de Preguntas -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Listado de Preguntas</h5>
                            <div class="text-muted small">
                                Mostrando 1-10 de 25 preguntas
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">ID</th>
                                        <th>Texto de la Pregunta</th>
                                        <th width="150">Tipo</th>
                                        <th width="100">Peso</th>
                                        <th width="100">Orden</th>
                                        <th width="120">Estado</th>
                                        <th width="150">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>El instructor explica los conceptos con claridad</td>
                                        <td><span class="badge bg-primary badge-answer-type">Escala 1-5</span></td>
                                        <td>1.20</td>
                                        <td>1</td>
                                        <td><span class="badge bg-success">Activa</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary edit-btn" data-id="1" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>El contenido del curso está actualizado</td>
                                        <td><span class="badge bg-primary badge-answer-type">Escala 1-5</span></td>
                                        <td>1.50</td>
                                        <td>2</td>
                                        <td><span class="badge bg-success">Activa</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary edit-btn" data-id="2" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>¿El instructor proporciona retroalimentación útil?</td>
                                        <td><span class="badge bg-info text-dark badge-answer-type">Sí/No</span></td>
                                        <td>1.00</td>
                                        <td>3</td>
                                        <td><span class="badge bg-secondary">Inactiva</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary edit-btn" data-id="3" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar/Editar Pregunta -->
    <div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionModalLabel">Gestión de Pregunta</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="questionForm">
                        <input type="hidden" id="Question_id" name="Question_id" value="">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="Questionnaire_id" class="form-label">Cuestionario *</label>
                                <select class="form-select" id="Questionnaire_id" name="Questionnaire_id" required>
                                    <option value="" selected disabled>-- Seleccione un cuestionario --</option>
                                    <option value="1">Habilidades de enseñanza</option>
                                    <option value="2">Contenido del curso</option>
                                    <option value="3">Ambiente de clase</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un cuestionario</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="Question_answer_type" class="form-label">Tipo de Respuesta *</label>
                                <select class="form-select" id="Question_answer_type" name="Question_answer_type" required>
                                    <option value="" selected disabled>-- Seleccione un tipo --</option>
                                    <option value="scale_1to5">Escala 1-5</option>
                                    <option value="yes_no">Sí/No</option>
                                    <option value="open">Respuesta abierta</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un tipo de respuesta</div>
                            </div>
                            
                            <div class="col-12">
                                <label for="Question_text" class="form-label">Texto de la Pregunta *</label>
                                <textarea class="form-control" id="Question_text" name="Question_text" rows="3" required></textarea>
                                <div class="invalid-feedback">Por favor ingrese el texto de la pregunta</div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="Question_weight" class="form-label">Peso *</label>
                                <input type="number" step="0.01" min="0.1" max="5" class="form-control" 
                                       id="Question_weight" name="Question_weight" value="1.00" required>
                                <div class="invalid-feedback">El peso debe ser entre 0.1 y 5.0</div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="Question_display_order" class="form-label">Orden *</label>
                                <input type="number" min="1" class="form-control" 
                                       id="Question_display_order" name="Question_display_order" required>
                                <div class="invalid-feedback">Ingrese un número válido</div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="Qis_active" class="form-label">Estado *</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="Qis_active" name="Qis_active" checked>
                                    <label class="form-check-label" for="Qis_active">Activa</label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="alert alert-info py-2">
                                    <small><i class="fas fa-info-circle me-1"></i> Los campos marcados con * son obligatorios</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" id="saveQuestionBtn">
                        <i class="fas fa-save me-1"></i> Guardar Pregunta
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts para funcionalidad -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionForm = document.getElementById('questionForm');
            const saveQuestionBtn = document.getElementById('saveQuestionBtn');
            const questionModal = new bootstrap.Modal(document.getElementById('questionModal'));
            
            // Manejar clic en botones de editar
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const questionId = this.getAttribute('data-id');
                    // Simular carga de datos (en producción sería una llamada AJAX)
                    loadQuestionData(questionId);
                    questionModal.show();
                });
            });
            
            // Función para cargar datos de pregunta (ejemplo)
            function loadQuestionData(id) {
                // Cambiar título del modal
                document.getElementById('questionModalLabel').textContent = 'Editar Pregunta';
                
                // Simular datos de la pregunta (en producción sería una llamada AJAX)
                const questions = {
                    '1': {
                        Questionnaire_id: '1',
                        Question_text: 'El instructor explica los conceptos con claridad',
                        Question_answer_type: 'scale_1to5',
                        Question_weight: '1.20',
                        Question_display_order: '1',
                        Qis_active: true
                    },
                    '2': {
                        Questionnaire_id: '2',
                        Question_text: 'El contenido del curso está actualizado',
                        Question_answer_type: 'scale_1to5',
                        Question_weight: '1.50',
                        Question_display_order: '2',
                        Qis_active: true
                    },
                    '3': {
                        Questionnaire_id: '1',
                        Question_text: '¿El instructor proporciona retroalimentación útil?',
                        Question_answer_type: 'yes_no',
                        Question_weight: '1.00',
                        Question_display_order: '3',
                        Qis_active: false
                    }
                };
                
                if (questions[id]) {
                    const question = questions[id];
                    document.getElementById('Question_id').value = id;
                    document.getElementById('Questionnaire_id').value = question.Questionnaire_id;
                    document.getElementById('Question_text').value = question.Question_text;
                    document.getElementById('Question_answer_type').value = question.Question_answer_type;
                    document.getElementById('Question_weight').value = question.Question_weight;
                    document.getElementById('Question_display_order').value = question.Question_display_order;
                    document.getElementById('Qis_active').checked = question.Qis_active;
                }
            }
            
            // Validación al guardar
            saveQuestionBtn.addEventListener('click', function() {
                let isValid = true;
                
                // Validar selectores
                const requiredSelects = questionForm.querySelectorAll('select[required]');
                requiredSelects.forEach(select => {
                    if (!select.value) {
                        select.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        select.classList.remove('is-invalid');
                    }
                });
                
                // Validar textarea
                const questionText = document.getElementById('Question_text');
                if (!questionText.value.trim()) {
                    questionText.classList.add('is-invalid');
                    isValid = false;
                } else {
                    questionText.classList.remove('is-invalid');
                }
                
                // Validar peso
                const questionWeight = document.getElementById('Question_weight');
                const weightValue = parseFloat(questionWeight.value);
                if (isNaN(weightValue) || weightValue < 0.1 || weightValue > 5.0) {
                    questionWeight.classList.add('is-invalid');
                    isValid = false;
                } else {
                    questionWeight.classList.remove('is-invalid');
                }
                
                // Validar orden
                const displayOrder = document.getElementById('Question_display_order');
                if (!displayOrder.value || parseInt(displayOrder.value) <= 0) {
                    displayOrder.classList.add('is-invalid');
                    isValid = false;
                } else {
                    displayOrder.classList.remove('is-invalid');
                }
                
                if (isValid) {
                    // Simular envío exitoso
                    console.log('Formulario válido, enviando...');
                    
                    // Mostrar mensaje de éxito
                    alert('Pregunta guardada exitosamente');
                    
                    // Cerrar modal
                    questionModal.hide();
                    
                    // Recargar datos (simulado)
                    setTimeout(() => {
                        alert('Datos actualizados en la tabla');
                    }, 500);
                }
            });
            
            // Limpiar formulario al cerrar modal
            document.getElementById('questionModal').addEventListener('hidden.bs.modal', function() {
                questionForm.reset();
                document.getElementById('Question_id').value = '';
                document.getElementById('questionModalLabel').textContent = 'Nueva Pregunta';
                
                // Limpiar validaciones
                questionForm.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
            });
        });
    </script>
</body>
</html>