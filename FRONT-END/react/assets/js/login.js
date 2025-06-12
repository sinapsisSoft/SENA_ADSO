

    const { useState } = React;

    function RegisterForm() {
      // Estados para los campos del formulario
      const [formData, setFormData] = useState({
        username: '',
        email: '',
        password: ''
      });

      // Estados para errores
      const [errors, setErrors] = useState({
        username: '',
        email: '',
        password: ''
      });

      // Manejar cambios en los inputs
      const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({
          ...formData,
          [name]: value
        });
      };

      // Validar el formulario
      const validateForm = () => {
        let isValid = true;
        const newErrors = { username: '', email: '', password: '' };

        // Validar usuario
        if (!formData.username.trim()) {
          newErrors.username = 'Usuario es requerido';
          isValid = false;
        }

        // Validar email
        if (!formData.email.trim()) {
          newErrors.email = 'Email es requerido';
          isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
          newErrors.email = 'Email no válido';
          isValid = false;
        }

        // Validar contraseña
        if (!formData.password) {
          newErrors.password = 'Contraseña es requerida';
          isValid = false;
        } else if (formData.password.length < 6) {
          newErrors.password = 'Mínimo 6 caracteres';
          isValid = false;
        }

        setErrors(newErrors);
        return isValid;
      };

      // Manejar envío del formulario
      const handleSubmit = (e) => {
        e.preventDefault();
        if (validateForm()) {
          alert(`Registro exitoso!\nUsuario: ${formData.username}\nEmail: ${formData.email}`);
          // Aquí podrías enviar los datos a un servidor
        }
      };
      return(
        <div className="form-container">
          <h2>Registro de Usuario</h2>
          <form onSubmit={handleSubmit}>
            <div className="form-group">
              <label>Usuario:</label>
              <input
                type="text"
                name="username"
                value={formData.username}
                onChange={handleChange}
                placeholder="Ingresa tu usuario"
              />
              {errors.username && <span className="error">{errors.username}</span>}
            </div>

            <div className="form-group">
              <label>Email:</label>
              <input
                type="text"
                name="email"
                value={formData.email}
                onChange={handleChange}
                placeholder="ejemplo@correo.com"/>
              {errors.email && <span className="error">{errors.email}</span>}
            </div>

            <div className="form-group">
              <label>Contraseña:</label>
              <input
                type="password"
                name="password"
                value={formData.password}
                onChange={handleChange}
                placeholder="Mínimo 6 caracteres"/>
              {errors.password && <span className="error">{errors.password}</span>}
            </div>

            <button type="submit">Registrarse</button>
          </form>
        </div>
      );
    }

    // Renderizar la aplicación
    const root = ReactDOM.createRoot(document.getElementById('root'));
    root.render(<RegisterForm />);
