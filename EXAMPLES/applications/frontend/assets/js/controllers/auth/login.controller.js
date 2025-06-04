// import { AuthService } from '../../services/AuthService';
// import { showToast } from '../../utils/helpers';

document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const loginSpinner = document.getElementById('loginSpinner');
    const authToast = new bootstrap.Toast(document.getElementById('authToast'));

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!validateForm()) return;

        try {
            // Mostrar spinner y deshabilitar botón
            loginSpinner.classList.remove('d-none');
            loginBtn.disabled = true;

            const formData = {
                email: loginForm.email.value,
                password: loginForm.password.value
            };

            const success = await AuthService.login(formData);

            if (success) {
                showToast('success', '¡Bienvenido!', 'Inicio de sesión exitoso', authToast);
                setTimeout(() => {
                    window.location.href = 'dashboard.html'; // Redirigir al dashboard
                }, 1500);
            } else {
                showToast('error', 'Error', 'Credenciales incorrectas', authToast);
            }
        } catch (error) {
            console.error('Login error:', error);
            showToast('error', 'Error', 'Ocurrió un error al iniciar sesión', authToast);
        } finally {
            loginSpinner.classList.add('d-none');
            loginBtn.disabled = false;
        }
    });

    function validateForm() {
        let isValid = true;

        // Validar email
        const email = loginForm.email;
        if (!email.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        } else {
            email.classList.remove('is-invalid');
        }

        // Validar contraseña
        const password = loginForm.password;
        if (!password.value || password.value.length < 6) {
            password.classList.add('is-invalid');
            isValid = false;
        } else {
            password.classList.remove('is-invalid');
        }

        return isValid;
    }
});