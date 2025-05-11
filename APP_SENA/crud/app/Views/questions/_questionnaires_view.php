<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Cuestionarios</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php require_once('../app/Views/assets/css/css.php') ?>
    <style>
        .card-questionnaire {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }
        .card-questionnaire:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .badge-status {
            font-size: 0.8rem;
            padding: 5px 8px;
        }
        .question-count {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .active-tab {
            font-weight: 600;
            border-bottom: 3px solid #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-6 fw-bold">
                    <i class="fas fa-clipboard-list me-2"></i>Administración de Cuestionarios
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cuestionarios</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Pestañas y Botón de Acción -->
        <div class="row mb-4">
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="questionnaireTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active active-tab" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">
                            <i class="fas fa-check-circle me-1"></i>Activos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="inactive-tab" data-bs-toggle="tab" data-bs-target="#inactive" type="button" role="tab">
                            <i class="fas fa-ban me-1"></i>Inactivos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                            <i class="fas fa-list me-1"></i>Todos
                        </button>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <div class="d-grid gap-2">
                    <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#questionnaireModal">
                        <i class="fas fa-plus me-2"></i>Nuevo Cuestionario
                    </button>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="searchQuestionnaire" class="form-label">Buscar cuestionario</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchQuestionnaire" placeholder="Nombre del cuestionario...">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="sortBy" class="form-label">Ordenar por</label>
                                <select class="form-select" id="sortBy">
                                    <option selected value="recent">Más recientes</option>
                                    <option value="oldest">Más antiguos</option>
                                    <option value="name-asc">Nombre (A-Z)</option>
                                    <option value="name-desc">Nombre (Z-A)</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="itemsPerPage" class="form-label">Mostrar</label>
                                <select class="form-select" id="itemsPerPage">
                                    <option selected value="10">10 items</option>
                                    <option value="25">25 items</option>
                                    <option value="50">50 items</option>
                                    <option value="100">100 items</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="questionnaireTabContent">
            <!-- Pestaña Activos -->
            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Tarjeta de Cuestionario 1 -->
                    <div class="col">
                        <div class="card card-questionnaire h-100">
                            <div class="card-header bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Evaluación de Instructores</h5>
                                    <span class="badge bg-success badge-status">Activo</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Evaluación de competencias docentes y habilidades técnicas.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="question-count">
                                        <i class="fas fa-question-circle me-1"></i>12 preguntas
                                    </span>
                                    <small class="text-muted">Creado: 15/05/2023</small>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-outline-primary me-2 edit-questionnaire" data-id="1">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Cuestionario 2 -->
                    <div class="col">
                        <div class="card card-questionnaire h-100">
                            <div class="card-header bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Satisfacción del Curso</h5>
                                    <span class="badge bg-success badge-status">Activo</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Evaluación general de satisfacción con el curso.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="question-count">
                                        <i class="fas fa-question-circle me-1"></i>8 preguntas
                                    </span>
                                    <small class="text-muted">Creado: 22/06/2023</small>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-outline-primary me-2 edit-questionnaire" data-id="2">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paginación -->
                <nav aria-label="Page navigation" class="mt-4">
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

            <!-- Pestaña Inactivos -->
            <div class="tab-pane fade" id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Tarjeta de Cuestionario Inactivo -->
                    <div class="col">
                        <div class="card card-questionnaire h-100">
                            <div class="card-header bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Evaluación Antigua</h5>
                                    <span class="badge bg-secondary badge-status">Inactivo</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Versión anterior del cuestionario de evaluación.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="question-count">
                                        <i class="fas fa-question-circle me-1"></i>10 preguntas
                                    </span>
                                    <small class="text-muted">Creado: 10/01/2023</small>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-outline-primary me-2 edit-questionnaire" data-id="3">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="fas fa-eye me-1"></i>Ver
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pestaña Todos -->
            <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Las mismas tarjetas aparecerían aquí -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar/Editar Cuestionario -->
    <div class="modal fade" id="questionnaireModal" tabindex="-1" aria-labelledby="questionnaireModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="questionnaireModalLabel">Nuevo Cuestionario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="questionnaireForm">
                        <input type="hidden" id="Questionnaire_id" name="Questionnaire_id" value="">
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="Questionnaire_name" class="form-label">Nombre del Cuestionario *</label>
                                <input type="text" class="form-control" id="Questionnaire_name" name="Questionnaire_name" required>
                                <div class="invalid-feedback">Por favor ingrese un nombre para el cuestionario</div>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="Qescription_description" class="form-label">Descripción</label>
                                <textarea class="form-control" id="Qescription_description" name="Qescription_description" rows="3"></textarea>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Estado *</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="Qescription_is_active" name="Qescription_is_active" checked>
                                    <label class="form-check-label" for="Qescription_is_active">Activo</label>
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
                    <button type="button" class="btn btn-primary" id="saveQuestionnaireBtn">
                        <i class="fas fa-save me-1"></i> Guardar Cuestionario
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
            const questionnaireForm = document.getElementById('questionnaireForm');
            const saveQuestionnaireBtn = document.getElementById('saveQuestionnaireBtn');
            const questionnaireModal = new bootstrap.Modal(document.getElementById('questionnaireModal'));
            
            // Manejar clic en botones de editar
            document.querySelectorAll('.edit-questionnaire').forEach(btn => {
                btn.addEventListener('click', function() {
                    const questionnaireId = this.getAttribute('data-id');
                    loadQuestionnaireData(questionnaireId);
                    questionnaireModal.show();
                });
            });
            
            // Función para cargar datos de cuestionario (ejemplo)
            function loadQuestionnaireData(id) {
                // Cambiar título del modal
                document.getElementById('questionnaireModalLabel').textContent = 'Editar Cuestionario';
                
                // Simular datos del cuestionario (en producción sería una llamada AJAX)
                const questionnaires = {
                    '1': {
                        Questionnaire_name: 'Evaluación de Instructores',
                        Qescription_description: 'Evaluación de competencias docentes y habilidades técnicas.',
                        Qescription_is_active: true
                    },
                    '2': {
                        Questionnaire_name: 'Satisfacción del Curso',
                        Qescription_description: 'Evaluación general de satisfacción con el curso.',
                        Qescription_is_active: true
                    },
                    '3': {
                        Questionnaire_name: 'Evaluación Antigua',
                        Qescription_description: 'Versión anterior del cuestionario de evaluación.',
                        Qescription_is_active: false
                    }
                };
                
                if (questionnaires[id]) {
                    const questionnaire = questionnaires[id];
                    document.getElementById('Questionnaire_id').value = id;
                    document.getElementById('Questionnaire_name').value = questionnaire.Questionnaire_name;
                    document.getElementById('Qescription_description').value = questionnaire.Qescription_description;
                    document.getElementById('Qescription_is_active').checked = questionnaire.Qescription_is_active;
                }
            }
            
            // Validación al guardar
            saveQuestionnaireBtn.addEventListener('click', function() {
                let isValid = true;
                
                // Validar nombre
                const questionnaireName = document.getElementById('Questionnaire_name');
                if (!questionnaireName.value.trim()) {
                    questionnaireName.classList.add('is-invalid');
                    isValid = false;
                } else {
                    questionnaireName.classList.remove('is-invalid');
                }
                
                if (isValid) {
                    // Simular envío exitoso
                    console.log('Formulario válido, enviando...');
                    
                    // Mostrar mensaje de éxito
                    alert('Cuestionario guardado exitosamente');
                    
                    // Cerrar modal
                    questionnaireModal.hide();
                    
                    // Recargar datos (simulado)
                    setTimeout(() => {
                        alert('Datos actualizados en la lista');
                    }, 500);
                }
            });
            
            // Limpiar formulario al cerrar modal
            document.getElementById('questionnaireModal').addEventListener('hidden.bs.modal', function() {
                questionnaireForm.reset();
                document.getElementById('Questionnaire_id').value = '';
                document.getElementById('questionnaireModalLabel').textContent = 'Nuevo Cuestionario';
                
                // Limpiar validaciones
                questionnaireForm.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
            });
        });
    </script>
</body>
</html>