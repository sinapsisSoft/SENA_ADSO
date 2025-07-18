function App() {
  const [darkMode, setDarkMode] = React.useState(false);
  const toastRef = React.useRef();

  const toggleDarkMode = () => {
    setDarkMode(!darkMode);
  };

  React.useEffect(() => {
    if (darkMode) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  }, [darkMode]);

  const showToast = (message, variant) => {
    if (toastRef.current) {
      toastRef.current.showToast(message, variant);
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
        <ToastContainer ref={toastRef} />
      </div>
    </ThemeContext.Provider>
  );
}