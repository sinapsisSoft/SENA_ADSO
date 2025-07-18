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