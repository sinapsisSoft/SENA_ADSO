// Lógica del componente
class LoginForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      email: '',
      password: '',
      error: ''
    };
  }

  handleChange = (e) => {
    this.setState({
      [e.target.name]: e.target.value,
      error: '', // Resetea el error al cambiar un campo
      [e.target.email]: e.target.value,
      error: '', // Resetea el error al cambiar un campo
    });
  }

  handleSubmit = (e) => {
    e.preventDefault();
    // Validación simple
    if (this.validateForm() === false) {
      //this.setState({ error: 'Todos los campos son requeridos' });
      return;
    } else {
      console.log('Validación básica exitosa');
      // Simular envío de datos
      console.log('Datos enviados:', {
        email: this.state.email,
        password: this.state.password
      });

      // Aquí normalmente harías una petición HTTP
      alert(`Bienvenido, ${this.state.email}`);
    }

  }
  validateForm = () => {
    let VALIDATIONS = {
      text: {
        messageError: "Please enter a valid text (3-20 alphanumeric characters)",
        regExp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]{3,20}$/
      },
      number: {
        messageError: "Please enter a valid Number (0-9 numeric characters)",
        regExp: /^[0-9]*$/
      },
      email: {
        messageError: "Please enter a valid Email",
        regExp: /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
      },
      password: {
        messageError: "Password must: be 8-15 chars, have lowercase, uppercase, number, and special character ($@$!%*?&)",
        regExp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/
      },

    };
    let isValid = true;
   
    const { email, password } = this.state;

    if (!VALIDATIONS.email.regExp.test(email)) {
      this.setState({ error: VALIDATIONS.email.messageError });
      isValid = false;
    } else if (!VALIDATIONS.password.regExp.test(password)) {
      this.setState({ error: VALIDATIONS.password.messageError });
      isValid = false;
    } else {
      this.setState({ error: '' });
    }

    return isValid;
  }
  validateBasicForm = () => {

    let isValid = true;
    const { email, password } = this.state;
    if (email.trim() === '' || email === null) {
      this.setState({ error: 'Todos los campos son requeridos de email' });
      isValid = false;
    } else if (password.trim() === '' || password === null) {
      this.setState({ error: 'Todos los campos son requeridos de password' });
      isValid = false;
    } else {
      this.setState({ error: '' });
    }

    return isValid;
  }

  render() {
    return (
      <div className="login-container">
        <h2>Iniciar Sesión</h2>
        {this.state.error && <div className="error">{this.state.error}</div>}

        <form onSubmit={this.handleSubmit}>
          <div className="form-group">
            <label>Correo electrónico:</label>
            <input
              type="email"
              name="email"
              data-required="true"
              value={this.state.email}
              onChange={this.handleChange}
              placeholder="tu@email.com"
            />
          </div>

          <div className="form-group">
            <label>Contraseña:</label>
            <input
              type="password"
              name="password"
              value={this.state.password}
              onChange={this.handleChange}
              placeholder="••••••••"
            />
          </div>

          <button type="submit">Ingresar</button>
        </form>

      </div>
    );
  }
}

// Renderizar la aplicación
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(<LoginForm />);