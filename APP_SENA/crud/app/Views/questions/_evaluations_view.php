<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Evaluaciones</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
    <style>
        .evaluation-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0d6efd;
        }
        .evaluation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 5px 8px;
        }
        .progress-thin {
            height: 6px;
        }
        .instructor-avatar {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
        .filter-section {
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .tab-content {
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-6 fw-bold">
                    <i class="fas fa-clipboard-check me-2"></i>Gestión de Evaluaciones
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Evaluaciones</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Filtros -->
        <div class="row mb-4 filter-section p-3">
            <div class="col-md-3">
                <label for="filterStatus" class="form-label">Estado</label>
                <select class="form-select" id="filterStatus">
                    <option value="" selected>Todas</option>
                    <option value="completed">Completadas</option>
                    <option value="pending">Pendientes</option>
                    <option value="in_progress">En progreso</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterInstructor" class="form-label">Instructor</label>
                <select class="form-select" id="filterInstructor">
                    <option value="" selected>Todos</option>
                    <option value="1">Juan Pérez</option>
                    <option value="2">María González</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterProgram" class="form-label">Programa</label>
                <select class="form-select" id="filterProgram">
                    <option value="" selected>Todos</option>
                    <option value="1">Técnico en Sistemas</option>
                    <option value="2">Técnico en Electricidad</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filterDate" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="filterDate">
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Total Evaluaciones</h5>
                                <h2 class="mb-0">128</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clipboard-list fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Completadas</h5>
                                <h2 class="mb-0">98</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-check-circle fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Pendientes</h5>
                                <h2 class="mb-0">30</h2>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clock fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listado de Evaluaciones -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Evaluaciones Recientes</h5>
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-download me-1"></i>Exportar
                                </button>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#newEvaluationModal">
                                    <i class="fas fa-plus me-1"></i>Nueva Evaluación
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">ID</th>
                                        <th>Estudiante</th>
                                        <th>Instructor</th>
                                        <th>Programa</th>
                                        <th>Cuestionario</th>
                                        <th width="150">Progreso</th>
                                        <th width="120">Estado</th>
                                        <th width="150">Fecha</th>
                                        <th width="120">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>EV-1025</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://randomuser.me/api/portraits/women/32.jpg" class="instructor-avatar me-2">
                                                <span>Ana Rodríguez</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://randomuser.me/api/portraits/men/42.jpg" class="instructor-avatar me-2">
                                                <span>Juan Pérez</span>
                                            </div>
                                        </td>
                                        <td>Técnico en Sistemas</td>
                                        <td>Evaluación de Instructores</td>
                                        <td>
                                            <div class="progress progress-thin">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted">12/12 preguntas</small>
                                        </td>
                                        <td><span class="badge bg-success status-badge">Completada</span></td>
                                        <td>15/05/2023</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary me-1" title="Reporte">
                                                <i class="fas fa-chart-bar"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EV-1024</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://randomuser.me/api/portraits/men/22.jpg" class="instructor-avatar me-2">
                                                <span>Carlos Sánchez</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://randomuser.me/api/portraits/women/63.jpg" class="instructor-avatar me-2">
                                                <span>María González</span>
                                            </div>
                                        </td>
                                        <td>Técnico en Electricidad</td>
                                        <td>Satisfacción del Curso</td>
                                        <td>
                                            <div class="progress progress-thin">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted">4/8 preguntas</small>
                                        </td>
                                        <td><span class="badge bg-warning text-dark status-badge">En progreso</span></td>
                                        <td>14/05/2023</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1" title="Continuar">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary me-1" title="Reporte">
                                                <i class="fas fa-chart-bar"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>EV-1023</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://randomuser.me/api/portraits/women/45.jpg" class="instructor-avatar me-2">
                                                <span>Laura Martínez</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://randomuser.me/api/portraits/men/42.jpg" class="instructor-avatar me-2">
                                                <span>Juan Pérez</span>
                                            </div>
                                        </td>
                                        <td>Técnico en Sistemas</td>
                                        <td>Evaluación de Instructores</td>
                                        <td>
                                            <div class="progress progress-thin">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-muted">0/12 preguntas</small>
                                        </td>
                                        <td><span class="badge bg-secondary status-badge">Pendiente</span></td>
                                        <td>13/05/2023</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-1" title="Iniciar">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Nueva Evaluación -->
    <div class="modal fade" id="newEvaluationModal" tabindex="-1" aria-labelledby="newEvaluationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="newEvaluationModalLabel">Nueva Evaluación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="evaluationForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="Student_fk" class="form-label">Estudiante *</label>
                                <select class="form-select" id="Student_fk" name="Student_fk" required>
                                    <option value="" selected disabled>-- Seleccione un estudiante --</option>
                                    <option value="1">Ana Rodríguez</option>
                                    <option value="2">Carlos Sánchez</option>
                                    <option value="3">Laura Martínez</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un estudiante</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="Instructor_fk" class="form-label">Instructor *</label>
                                <select class="form-select" id="Instructor_fk" name="Instructor_fk" required>
                                    <option value="" selected disabled>-- Seleccione un instructor --</option>
                                    <option value="1">Juan Pérez</option>
                                    <option value="2">María González</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un instructor</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="Program_group_code_fk" class="form-label">Programa *</label>
                                <select class="form-select" id="Program_group_code_fk" name="Program_group_code_fk" required>
                                    <option value="" selected disabled>-- Seleccione un programa --</option>
                                    <option value="1">Técnico en Sistemas</option>
                                    <option value="2">Técnico en Electricidad</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un programa</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="Questionnaire_fk" class="form-label">Cuestionario *</label>
                                <select class="form-select" id="Questionnaire_fk" name="Questionnaire_fk" required>
                                    <option value="" selected disabled>-- Seleccione un cuestionario --</option>
                                    <option value="1">Evaluación de Instructores</option>
                                    <option value="2">Satisfacción del Curso</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un cuestionario</div>
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
                    <button type="button" class="btn btn-primary" id="saveEvaluationBtn">
                        <i class="fas fa-save me-1"></i> Crear Evaluación
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
            const evaluationForm = document.getElementById('evaluationForm');
            const saveEvaluationBtn = document.getElementById('saveEvaluationBtn');
            const evaluationModal = new bootstrap.Modal(document.getElementById('newEvaluationModal'));
            
            // Validación al guardar
            saveEvaluationBtn.addEventListener('click', function() {
                let isValid = true;
                
                // Validar selectores
                const requiredSelects = evaluationForm.querySelectorAll('select[required]');
                requiredSelects.forEach(select => {
                    if (!select.value) {
                        select.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        select.classList.remove('is-invalid');
                    }
                });
                
                if (isValid) {
                    // Simular envío exitoso
                    console.log('Formulario válido, enviando...');
                    
                    // Mostrar mensaje de éxito
                    alert('Evaluación creada exitosamente');
                    
                    // Cerrar modal
                    evaluationModal.hide();
                    
                    // Recargar datos (simulado)
                    setTimeout(() => {
                        alert('Lista de evaluaciones actualizada');
                    }, 500);
                }
            });
            
            // Limpiar formulario al cerrar modal
            document.getElementById('newEvaluationModal').addEventListener('hidden.bs.modal', function() {
                evaluationForm.reset();
                
                // Limpiar validaciones
                evaluationForm.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
            });
        });
    </script>
</body>
</html>