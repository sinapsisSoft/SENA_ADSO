<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Profesor a Evaluar</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .professor-card {
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .professor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .professor-card.selected {
            border: 3px solid #0d6efd;
            background-color: #f8f9fa;
        }
        .professor-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
        }
        .specialty-badge {
            font-size: 0.8rem;
        }
        .search-box {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4 text-center">Seleccione el Profesor a Evaluar</h1>
        
        <!-- Barra de búsqueda -->
        <div class="row justify-content-center search-box">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar profesor por nombre, especialidad..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button" id="searchButton">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Filtros -->
        <div class="row mb-4">
            <div class="col-md-3">
                <select class="form-select" id="specialtyFilter">
                    <option value="">Todas las especialidades</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Informática">Informática</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Ciencias">Ciencias</option>
                    <option value="Historia">Historia</option>
                    <option value="Arte">Arte</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="statusFilter">
                    <option value="">Todos los estados</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                    <option value="Licencia">Licencia</option>
                </select>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-outline-secondary" id="resetFilters">Restablecer filtros</button>
            </div>
        </div>
        
        <!-- Tarjetas de profesores -->
        <div class="row" id="professorsContainer">
            <!-- Profesor 1 -->
            <div class="col-md-4 professor-card-container" data-specialty="Informática" data-status="Activo">
                <div class="card professor-card">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profesor" class="professor-img mb-3">
                        <h5 class="card-title">Juan Pérez</h5>
                        <p class="card-text">
                            <strong>Documento:</strong> 12345678<br>
                            <strong>Email:</strong> juan.perez@universidad.edu<br>
                            <strong>Teléfono:</strong> +57 310 123 4567
                        </p>
                        <span class="badge bg-primary specialty-badge mb-2">Informática</span>
                        <span class="badge bg-success specialty-badge">Activo</span>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary select-professor" data-professor-id="1">Evaluar este profesor</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profesor 2 -->
            <div class="col-md-4 professor-card-container" data-specialty="Matemáticas" data-status="Activo">
                <div class="card professor-card">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profesor" class="professor-img mb-3">
                        <h5 class="card-title">María González</h5>
                        <p class="card-text">
                            <strong>Documento:</strong> 87654321<br>
                            <strong>Email:</strong> maria.gonzalez@universidad.edu<br>
                            <strong>Teléfono:</strong> +57 310 765 4321
                        </p>
                        <span class="badge bg-primary specialty-badge mb-2">Matemáticas</span>
                        <span class="badge bg-success specialty-badge">Activo</span>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary select-professor" data-professor-id="2">Evaluar este profesor</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profesor 3 -->
            <div class="col-md-4 professor-card-container" data-specialty="Inglés" data-status="Activo">
                <div class="card professor-card">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profesor" class="professor-img mb-3">
                        <h5 class="card-title">Carlos Rodríguez</h5>
                        <p class="card-text">
                            <strong>Documento:</strong> 11223344<br>
                            <strong>Email:</strong> carlos.rodriguez@universidad.edu<br>
                            <strong>Teléfono:</strong> +57 310 112 2334
                        </p>
                        <span class="badge bg-primary specialty-badge mb-2">Inglés</span>
                        <span class="badge bg-success specialty-badge">Activo</span>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary select-professor" data-professor-id="3">Evaluar este profesor</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profesor 4 -->
            <div class="col-md-4 professor-card-container" data-specialty="Ciencias" data-status="Licencia">
                <div class="card professor-card">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Profesor" class="professor-img mb-3">
                        <h5 class="card-title">Ana Martínez</h5>
                        <p class="card-text">
                            <strong>Documento:</strong> 55667788<br>
                            <strong>Email:</strong> ana.martinez@universidad.edu<br>
                            <strong>Teléfono:</strong> +57 310 556 6778
                        </p>
                        <span class="badge bg-primary specialty-badge mb-2">Ciencias</span>
                        <span class="badge bg-warning text-dark specialty-badge">Licencia</span>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary select-professor" data-professor-id="4">Evaluar este profesor</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profesor 5 -->
            <div class="col-md-4 professor-card-container" data-specialty="Historia" data-status="Activo">
                <div class="card professor-card">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Profesor" class="professor-img mb-3">
                        <h5 class="card-title">Pedro Sánchez</h5>
                        <p class="card-text">
                            <strong>Documento:</strong> 99887766<br>
                            <strong>Email:</strong> pedro.sanchez@universidad.edu<br>
                            <strong>Teléfono:</strong> +57 310 998 8776
                        </p>
                        <span class="badge bg-primary specialty-badge mb-2">Historia</span>
                        <span class="badge bg-success specialty-badge">Activo</span>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary select-professor" data-professor-id="5">Evaluar este profesor</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profesor 6 -->
            <div class="col-md-4 professor-card-container" data-specialty="Arte" data-status="Inactivo">
                <div class="card professor-card">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Profesor" class="professor-img mb-3">
                        <h5 class="card-title">Laura Díaz</h5>
                        <p class="card-text">
                            <strong>Documento:</strong> 33445566<br>
                            <strong>Email:</strong> laura.diaz@universidad.edu<br>
                            <strong>Teléfono:</strong> +57 310 334 4556
                        </p>
                        <span class="badge bg-primary specialty-badge mb-2">Arte</span>
                        <span class="badge bg-danger specialty-badge">Inactivo</span>
                        <div class="d-grid mt-3">
                            <button class="btn btn-primary select-professor" data-professor-id="6">Evaluar este profesor</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar selección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro que desea evaluar al profesor <span id="selectedProfessorName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmEvaluation">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Filtrado de profesores
        document.getElementById('specialtyFilter').addEventListener('change', filterProfessors);
        document.getElementById('statusFilter').addEventListener('change', filterProfessors);
        document.getElementById('searchButton').addEventListener('click', filterProfessors);
        document.getElementById('resetFilters').addEventListener('click', function() {
            document.getElementById('specialtyFilter').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('searchInput').value = '';
            filterProfessors();
        });
        
        function filterProfessors() {
            const specialty = document.getElementById('specialtyFilter').value.toLowerCase();
            const status = document.getElementById('statusFilter').value.toLowerCase();
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            
            const cards = document.querySelectorAll('.professor-card-container');
            
            cards.forEach(card => {
                const cardSpecialty = card.dataset.specialty.toLowerCase();
                const cardStatus = card.dataset.status.toLowerCase();
                const cardText = card.textContent.toLowerCase();
                
                const specialtyMatch = specialty === '' || cardSpecialty.includes(specialty);
                const statusMatch = status === '' || cardStatus.includes(status);
                const searchMatch = searchText === '' || cardText.includes(searchText);
                
                if (specialtyMatch && statusMatch && searchMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // Selección de profesor
        let selectedProfessorId = null;
        let selectedProfessorName = null;
        
        document.querySelectorAll('.select-professor').forEach(button => {
            button.addEventListener('click', function() {
                selectedProfessorId = this.dataset.professorId;
                selectedProfessorName = this.closest('.card-body').querySelector('.card-title').textContent;
                
                document.getElementById('selectedProfessorName').textContent = selectedProfessorName;
                const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                modal.show();
            });
        });
        
        // Confirmar evaluación
        document.getElementById('confirmEvaluation').addEventListener('click', function() {
            alert(`Redirigiendo a formulario de evaluación para el profesor ${selectedProfessorName}`);
            // Aquí iría la redirección al formulario de evaluación con el ID del profesor
            // window.location.href = `evaluation-form.html?professorId=${selectedProfessorId}`;
            window.location.href = 'evaluations';
        });
    </script>
</body>
</html>