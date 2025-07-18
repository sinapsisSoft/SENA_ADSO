function RegisterForm({ showToast }) {
  const { darkMode } = React.useContext(ThemeContext);
  const [formData, setFormData] = useState({
    nombre: '',
    email: '',
    password_hash: '',
    role_fk: '',
    status_fk: '',
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
      case 'password_hash':
        if (!value) {
          newErrors.password_hash = 'Contraseña es requerida';
        } else if (value.length < 6) {
          newErrors.password_hash = 'Mínimo 6 caracteres';
        } else {
          newErrors.password_hash = '';
        }
        break;
      case 'role':
        newErrors.role_fk = !value ? 'Selecciona un género' : '';
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

    if (!formData.password_hash) {
      newErrors.password_hash = 'Contraseña es requerida';
    } else if (formData.password_hash.length < 6) {
      newErrors.password_hash = 'Mínimo 6 caracteres';
    }

    if (!formData.role_fk) newErrors.role_fk = 'Selecciona un género';
    if (!formData.status_fk) newErrors.status_fk = 'Selecciona un estado';
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
            <label htmlFor="password_hash" className="form-label">Contraseña</label>
            <input
              type="password_hash"
              className={`form-control ${errors.password_hash ? 'is-invalid' : ''}`}
              id="password_hash"
              name="password_hash"
              value={formData.password_hash}
              onChange={handleChange}
              required
              minLength="6"
            />
            {errors.password_hash && <div className="invalid-feedback">{errors.password_hash}</div>}
          </div>

          <div className="mb-3">
            <label htmlFor="role_fk" className="form-label">Rol</label>
            <select
              className={`form-select ${errors.role_fk ? 'is-invalid' : ''}`}
              id="role_fk"
              name="role_fk"
              value={formData.role_fk}
              onChange={handleChange}
              required
            >
              <option value="">Seleccione...</option>
              <option value="1">Administrador</option>
              <option value="2">Cliente</option>
              <option value="3">Vendedor</option>
            </select>
            {errors.role_fk && <div className="invalid-feedback">{errors.role_fk}</div>}
          </div>

          <div className="mb-3">
            <label htmlFor="status_fk" className="form-label">Estado</label>
            <select
              className={`form-select ${errors.status_fk ? 'is-invalid' : ''}`}
              id="status_fk"
              name="status_fk"
              value={formData.status_fk}
              onChange={handleChange}
              required
            >
              <option value="">Seleccione...</option>
              <option value="1">Activo</option>
              <option value="2">Inactivo</option>
              <option value="3">Bloqueado</option>
            </select>
            {errors.status_fk && <div className="invalid-feedback">{errors.status_fk}</div>}
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