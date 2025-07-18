 const ToastContainer = React.forwardRef((props, ref) => {

  const [toasts, setToasts] = useState([]);

  const showToast = (message, variant = 'info') => {
    alert();
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
});

