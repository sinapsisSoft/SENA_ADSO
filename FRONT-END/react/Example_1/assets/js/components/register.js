const { useState, useEffect } = React;

// Contexto para el tema
const ThemeContext = React.createContext();

// Componente Navbar
function Navbar() {
  const { darkMode, toggleDarkMode } = React.useContext(ThemeContext);
  return (
    <nav className="navbar navbar-expand-lg bg-primary navbar-dark">
      <div className="container-fluid">
        <a className="navbar-brand" href="#">
          <i className="bi bi-app-indicator me-2"></i>
          MiApp
        </a>
        <button className="navbar-toggler" type="button">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse">
          <div className="d-flex ms-auto align-items-center">
            <button
              className="btn btn-outline-light me-2"
              onClick={toggleDarkMode}
            >
              <i className={`bi ${darkMode ? 'bi-sun' : 'bi-moon'}`}></i>
            </button>
            <div className="dropdown">
              <button className="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i className="bi bi-person-circle me-1"></i>
                Usuario
              </button>
              <ul className="dropdown-menu dropdown-menu-end">
                <li><a className="dropdown-item" href="#">Perfil</a></li>
                <li><a className="dropdown-item" href="#">Configuración</a></li>
                <li><hr className="dropdown-divider" /></li>
                <li><a className="dropdown-item" href="#">Cerrar sesión</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  );
}

// Componente Sidebar
function Sidebar() {
  const [collapsed, setCollapsed] = useState(false);
  const { darkMode } = React.useContext(ThemeContext);

  const menuItems = [
    { icon: 'bi-house', text: 'Inicio', active: true },
    { icon: 'bi-person', text: 'Perfil' },
    { icon: 'bi-gear', text: 'Configuración' },
    { icon: 'bi-envelope', text: 'Mensajes' },
    { icon: 'bi-graph-up', text: 'Estadísticas' },
    { icon: 'bi-question-circle', text: 'Ayuda' }
  ];

  return (
    <aside className={`sidebar ${darkMode ? 'bg-dark' : 'bg-light'} ${collapsed ? 'sidebar-collapsed' : ''}`}>
      <div className="d-flex flex-column h-100">
        <div className="p-3 border-bottom">
          <button
            className="btn btn-link text-decoration-none"
            onClick={() => setCollapsed(!collapsed)}
          >
            <i className={`bi ${collapsed ? 'bi-chevron-right' : 'bi-chevron-left'}`}></i>
          </button>
        </div>
        <ul className="nav nav-pills flex-column mb-auto p-2">
          {menuItems.map((item, index) => (
            <li key={index} className="nav-item">
              <a
                href="#"
                className={`nav-link ${item.active ? 'active' : ''} ${darkMode ? 'text-white' : ''}`}
              >
                <div className="d-flex align-items-center menu-item">
                  <i className={`bi ${item.icon} me-3`}></i>
                  <span className="menu-text">{item.text}</span>
                </div>
              </a>
            </li>
          ))}
        </ul>
        <div className="mt-auto p-3 border-top">
          <small className={`${darkMode ? 'text-white-50' : 'text-muted'}`}>
            {collapsed ? 'v1.0' : 'Versión 1.0.0'}
          </small>
        </div>
      </div>
    </aside>
  );
}

// Componente RegisterForm
function RegisterForm({ showToast }) {
  const { darkMode } = React.useContext(ThemeContext);
  const [formData, setFormData] = useState({
    nombre: '',
    email: '',
    password: '',
    genero: '',
    aceptaTerminos: false
  });

  const [errors, setErrors] = useState({});
  const [wasValidated, setWasValidated] = useState(false);

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === 'checkbox' ? checked : value
    });

    // Validación en tiempo real después del primer intento
    if (wasValidated) {
      validateField(name, type === 'checkbox' ? checked : value);
    }
  };

  const validateField = (fieldName, value) => {
    const newErrors = { ...errors };

    switch (fieldName) {
      case 'nombre':
        newErrors.nombre = !value.trim() ? 'Nombre es requerido' : '';
        break;
      case 'email':
        if (!value.trim()) {
          newErrors.email = 'Email es requerido';
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
          newErrors.email = 'Email no válido';
        } else {
          newErrors.email = '';
        }
        break;
      case 'password':
        if (!value) {
          newErrors.password = 'Contraseña es requerida';
        } else if (value.length < 6) {
          newErrors.password = 'Mínimo 6 caracteres';
        } else {
          newErrors.password = '';
        }
        break;
      case 'genero':
        newErrors.genero = !value ? 'Selecciona un género' : '';
        break;
      case 'aceptaTerminos':
        newErrors.aceptaTerminos = !value ? 'Debes aceptar los términos' : '';
        break;
    }

    setErrors(newErrors);
  };

  const validateForm = () => {
    const newErrors = {};

    if (!formData.nombre.trim()) newErrors.nombre = 'Nombre es requerido';

    if (!formData.email.trim()) {
      newErrors.email = 'Email es requerido';
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
      newErrors.email = 'Email no válido';
    }

    if (!formData.password) {
      newErrors.password = 'Contraseña es requerida';
    } else if (formData.password.length < 6) {
      newErrors.password = 'Mínimo 6 caracteres';
    }

    if (!formData.genero) newErrors.genero = 'Selecciona un género';
    if (!formData.aceptaTerminos) newErrors.aceptaTerminos = 'Debes aceptar los términos';

    setErrors(newErrors);
    setWasValidated(true);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (validateForm()) {
      showToast('Registro exitoso!', 'success');
      console.log('Datos enviados:', formData);
      // Aquí iría la llamada a la API
    } else {
      showToast('Por favor corrige los errores', 'danger');
    }
  };

  return (
    <div className={`card fade-in ${darkMode ? 'bg-dark' : ''}`}>
      <div className="card-body">
        <h2 className="card-title mb-4">Registro de Usuario</h2>
        <form onSubmit={handleSubmit} noValidate className={wasValidated ? 'was-validated' : ''}>
          <div className="mb-3">
            <label htmlFor="nombre" className="form-label">Nombre completo</label>
            <input
              type="text"
              className={`form-control ${errors.nombre ? 'is-invalid' : ''}`}
              id="nombre"
              name="nombre"
              value={formData.nombre}
              onChange={handleChange}
              required
            />
            {errors.nombre && <div className="invalid-feedback">{errors.nombre}</div>}
          </div>

          <div className="mb-3">
            <label htmlFor="email" className="form-label">Correo electrónico</label>
            <input
              type="email"
              className={`form-control ${errors.email ? 'is-invalid' : ''}`}
              id="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
              required
            />
            {errors.email && <div className="invalid-feedback">{errors.email}</div>}
          </div>

          <div className="mb-3">
            <label htmlFor="password" className="form-label">Contraseña</label>
            <input
              type="password"
              className={`form-control ${errors.password ? 'is-invalid' : ''}`}
              id="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
              required
              minLength="6"
            />
            {errors.password && <div className="invalid-feedback">{errors.password}</div>}
          </div>

          <div className="mb-3">
            <label htmlFor="genero" className="form-label">Género</label>
            <select
              className={`form-select ${errors.genero ? 'is-invalid' : ''}`}
              id="genero"
              name="genero"
              value={formData.genero}
              onChange={handleChange}
              required
            >
              <option value="">Seleccione...</option>
              <option value="masculino">Masculino</option>
              <option value="femenino">Femenino</option>
              <option value="otro">Otro</option>
            </select>
            {errors.genero && <div className="invalid-feedback">{errors.genero}</div>}
          </div>

          <div className="mb-3 form-check">
            <input
              type="checkbox"
              className={`form-check-input ${errors.aceptaTerminos ? 'is-invalid' : ''}`}
              id="aceptaTerminos"
              name="aceptaTerminos"
              checked={formData.aceptaTerminos}
              onChange={handleChange}
              required
            />
            <label className="form-check-label" htmlFor="aceptaTerminos">
              Acepto los términos y condiciones
            </label>
            {errors.aceptaTerminos && <div className="invalid-feedback">{errors.aceptaTerminos}</div>}
          </div>

          <button type="submit" className="btn btn-primary w-100">
            Registrarse
          </button>
        </form>
      </div>
    </div>
  );
}


// Componente ToastContainer
function ToastContainer() {
  const [toasts, setToasts] = useState([]);

  const showToast = (message, variant = 'info') => {
    const id = Date.now();
    setToasts([...toasts, { id, message, variant }]);

    // Eliminar el toast después de 5 segundos
    setTimeout(() => {
      setToasts(current => current.filter(t => t.id !== id));
    }, 5000);
  };

  const removeToast = (id) => {
    setToasts(current => current.filter(t => t.id !== id));
  };

  return (
    <div className="toast-container position-fixed bottom-0 end-0 p-3">
      {toasts.map(toast => (
        <div
          key={toast.id}
          className={`toast show fade-in bg-${toast.variant}`}
          role="alert"
        >
          <div className="d-flex">
            <div className="toast-body text-white">
              {toast.message}
            </div>
            <button
              type="button"
              className="btn-close btn-close-white me-2 m-auto"
              onClick={() => removeToast(toast.id)}
            ></button>
          </div>
        </div>
      ))}
    </div>
  );
}

// Componente Footer
function Footer() {
  const { darkMode } = React.useContext(ThemeContext);

  return (
    <footer className={`py-3 ${darkMode ? 'bg-dark text-white' : 'bg-light'}`}>
      <div className="container-fluid">
        <div className="row">
          <div className="col-md-6">
            <p className="mb-0">&copy; 2023 MiApp. Todos los derechos reservados.</p>
          </div>
          <div className="col-md-6 text-md-end">
            <a href="#" className={`text-decoration-none ${darkMode ? 'text-white-50' : 'text-muted'}`}>Términos</a>
            <span className="mx-2">•</span>
            <a href="#" className={`text-decoration-none ${darkMode ? 'text-white-50' : 'text-muted'}`}>Privacidad</a>
            <span className="mx-2">•</span>
            <a href="#" className={`text-decoration-none ${darkMode ? 'text-white-50' : 'text-muted'}`}>Contacto</a>
          </div>
        </div>
      </div>
    </footer>
  );
}

// Componente principal App
function App() {
  const [darkMode, setDarkMode] = useState(false);
  const [toastContainer, setToastContainer] = useState(null);

  const toggleDarkMode = () => {
    setDarkMode(!darkMode);
  };

  // Efecto para aplicar el modo oscuro al body
  useEffect(() => {
    if (darkMode) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  }, [darkMode]);

  // Función para mostrar toasts
  const showToast = (message, variant) => {
    if (toastContainer) {
      toastContainer.showToast(message, variant);
    }
  };

  return (
    <ThemeContext.Provider value={{ darkMode, toggleDarkMode }}>
      <div className="app-container">
        <Navbar />
        <Sidebar />
        <main className="p-4">
          <div className="container">
            <div className="row justify-content-center">
              <div className="col-lg-8">
                <RegisterForm showToast={showToast} />
              </div>
            </div>
          </div>
        </main>
        <Footer />

        {/* ToastContainer con ref para acceder desde otros componentes */}
        <ToastContainer ref={ref => setToastContainer(ref)} />
      </div>
    </ThemeContext.Provider>
  );
}

// Renderizar la aplicación
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<App />);