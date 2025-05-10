<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Programas Educativos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Estilos personalizados -->
    <?php require_once('../app/Views/assets/css/css.php') ?>
</head>
<body>
    <!-- Navbar Superior -->
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="container-fluid">
            <button class="btn btn-link text-white" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand mx-2" href="#">
                <i class="fas fa-graduation-cap me-2"></i>
                <span class="d-none d-md-inline">Sistema Educativo</span>
            </a>
            <div class="navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>
                            <span class="d-none d-md-inline">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white vh-100 position-fixed" id="sidebar">
        <div class="p-3">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white sidebar-link">
                    <i class="fas fa-home me-3"></i>
                    <span class="sidebar-text">Inicio</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white sidebar-link active">
                    <i class="fas fa-users me-3"></i>
                    <span class="sidebar-text">Programas</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white sidebar-link">
                    <i class="fas fa-chalkboard-teacher me-3"></i>
                    <span class="sidebar-text">Instructores</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white sidebar-link">
                    <i class="fas fa-user-graduate me-3"></i>
                    <span class="sidebar-text">Estudiantes</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white sidebar-link">
                    <i class="fas fa-clipboard-list me-3"></i>
                    <span class="sidebar-text">Evaluaciones</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white sidebar-link">
                    <i class="fas fa-chart-bar me-3"></i>
                    <span class="sidebar-text">Reportes</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content p-4" id="mainContent">
        <!-- Encabezado -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-users me-2"></i> Programas Grupales</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newProgramModal">
                <i class="fas fa-plus me-2"></i>Nuevo Programa
            </button>
        </div>

        <!-- Dashboard Resumen -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Programas Activos</h6>
                                <h3 class="mb-0">24</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-play-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <small>+2 este mes</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Completados</h6>
                                <h3 class="mb-0">56</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-check-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <small>+5 este mes</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Por Iniciar</h6>
                                <h3 class="mb-0">12</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-clock fa-2x opacity-50"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <small>3 próximos 7 días</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="card-title">Total Estudiantes</h6>
                                <h3 class="mb-0">342</h3>
                            </div>
                            <div class="align-self-center">
                                <i class="fas fa-users fa-2x opacity-50"></i>
                            </div>
                        </div>
                        <div class="mt-2">
                            <small>+28 este mes</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="card mb-4 filter-section">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="searchInput" class="form-label">Buscar</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchInput" placeholder="Código o nombre...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="statusFilter" class="form-label">Estado</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">Todos</option>
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                            <option value="completed">Completado</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="dateFilter" class="form-label">Fecha inicio</label>
                        <input type="date" class="form-control" id="dateFilter">
                    </div>
                    <div class="col-md-2">
                        <label for="itemsPerPage" class="form-label">Mostrar</label>
                        <select class="form-select" id="itemsPerPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-primary w-100" id="applyFilters">
                            <i class="fas fa-filter me-2"></i>Aplicar Filtros
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controles de Vista -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="text-muted">
                Mostrando <span id="showingCount">1</span> a <span id="ofCount">10</span> de <span id="totalCount">24</span> programas
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active" id="tableViewBtn">
                    <i class="fas fa-table"></i> Tabla
                </button>
                <button type="button" class="btn btn-outline-secondary" id="cardsViewBtn">
                    <i class="fas fa-th-large"></i> Tarjetas
                </button>
            </div>
        </div>

        <!-- Vista de Tabla -->
        <div class="card mb-4" id="tableView">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th class="sortable">Código <i class="fas fa-sort ms-1"></i></th>
                            <th class="sortable">Nombre <i class="fas fa-sort ms-1"></i></th>
                            <th class="sortable">Inicio <i class="fas fa-sort ms-1"></i></th>
                            <th class="sortable">Fin <i class="fas fa-sort ms-1"></i></th>
                            <th>Duración</th>
                            <th>Estudiantes</th>
                            <th class="sortable">Estado <i class="fas fa-sort ms-1"></i></th>
                            <th width="120">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="clickable-row">
                            <td>1</td>
                            <td><span class="fw-bold">3102803</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-laptop-code text-primary me-2"></i>
                                    Técnico en Desarrollo
                                </div>
                            </td>
                            <td>2025-04-01</td>
                            <td>2025-10-01</td>
                            <td>6 meses</td>
                            <td><span class="badge bg-primary rounded-pill">24</span></td>
                            <td>
                                <span class="badge bg-success status-badge">
                                    <i class="fas fa-check-circle me-1"></i>Activo
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Editar</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>Ver</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-chart-line me-2"></i>Reporte</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash-alt me-2"></i>Eliminar</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <!-- Más filas... -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Vista de Tarjetas (Oculto inicialmente) -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="cardsView" style="display: none;">
            <!-- Tarjetas de programas... -->
        </div>

        <!-- Paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
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

    <!-- Footer -->
    <footer class="bg-light py-3 mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Precios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Acerca de</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-muted">© 2025 Sistema Educativo. Todos los derechos reservados.</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Nuevo Programa -->
    <div class="modal fade" id="newProgramModal" tabindex="-1" aria-labelledby="newProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="newProgramModalLabel">Nuevo Programa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="programForm">
                        <div class="mb-3">
                            <label for="programCode" class="form-label">Código *</label>
                            <input type="text" class="form-control" id="programCode" required>
                        </div>
                        <div class="mb-3">
                            <label for="programName" class="form-label">Nombre *</label>
                            <input type="text" class="form-control" id="programName" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Inicio *</label>
                                <input type="date" class="form-control" id="startDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">Fin *</label>
                                <input type="date" class="form-control" id="endDate" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="programStatus" class="form-label">Estado *</label>
                            <select class="form-select" id="programStatus" required>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                                <option value="planned">Planificado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="programDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="programDescription" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="saveProgramBtn">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts personalizados -->
   
    <script src="<?= base_url('controllers/programsGroups/script.js') ?>"></script>
</body>
</html>