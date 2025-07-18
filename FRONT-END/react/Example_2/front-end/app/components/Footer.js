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