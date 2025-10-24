<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Inicio de sesión - RackON</title>
    <style>
    :root {
        --primary-color: #0d6efd;
        --primary-light: #e8f2ff;
        --dark-color: #2c3e50;
        --light-color: #ffffff;
        --light-bg: #f8f9fa;
        --text-color: #4a5568;
        --border-color: #e2e8f0;
        --error-color: #dc3545;
        --success-color: #198754;
    }
    
    body {
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://www.celmad.com/wp-content/uploads/2023/11/Que-es-un-centro-de-datos-y-por-que-estan-en-auge-2048x1170.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        color: var(--text-color);
    }

    .login-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 3rem;
        border-radius: 16px;
        width: 100%;
        max-width: 500px; /* AUMENTADO de 420px a 500px */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        text-align: center;
        margin: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-header {
        margin-bottom: 2.5rem;
    }

    .login-icon {
        font-size: 3.5rem; /* Aumentado ligeramente */
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .login-container h2 {
        color: var(--dark-color);
        margin-bottom: 0.5rem;
        font-size: 2.25rem; /* Aumentado */
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    .login-subtitle {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    .form-login {
        display: flex;
        flex-direction: column;
        gap: 1.75rem; /* Aumentado el espaciado */
    }

    .input-group {
        position: relative;
    }

    .input-group input {
        width: 100%;
        padding: 1.125rem 1.125rem 1.125rem 3.5rem; /* Aumentado padding */
        border: 1px solid var(--border-color);
        border-radius: 10px; /* Bordes más redondeados */
        background-color: var(--light-color);
        color: var(--text-color);
        font-size: 1.05rem; /* Texto ligeramente más grande */
        transition: all 0.3s ease;
        box-sizing: border-box;
        font-family: 'Open Sans', sans-serif;
    }

    .input-group input:focus {
        border-color: var(--primary-color);
        outline: none;
        background-color: var(--light-color);
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15); /* Sombra más pronunciada */
    }

    .input-group input.error {
        border-color: var(--error-color);
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
    }

    .input-group i {
        position: absolute;
        left: 1.25rem; /* Aumentado el espacio del icono */
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1.2rem; /* Iconos más grandes */
    }

    .input-group i.error {
        color: var(--error-color);
    }

    .error-message {
        color: var(--error-color);
        font-size: 0.9rem;
        margin-top: 0.5rem;
        text-align: left;
        display: none;
        padding-left: 0.5rem;
    }

    .error-message.show {
        display: block;
    }

    /* Botones más grandes */
    .btn-login, .btn-volver {
        width: 100%;
        padding: 1.125rem; /* Aumentado padding */
        border-radius: 10px;
        border: none;
        background-color: var(--primary-color);
        color: white;
        font-family: 'Open Sans', sans-serif;
        font-size: 1.1rem; /* Texto más grande */
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 0.75rem; /* Más espacio arriba */
        text-align: center;
        box-sizing: border-box;
        text-decoration: none;
        display: block;
    }

    .btn-login:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
        transform: none;
    }

    .btn-login:disabled:hover {
        transform: none;
        box-shadow: none;
    }

    .btn-login:hover, .btn-volver:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(13, 110, 253, 0.3); /* Sombra más pronunciada */
        color: white;
    }

    .btn-login:active, .btn-volver:active {
        transform: translateY(0);
    }

    /* Alertas más grandes */
    .alert {
        padding: 1.25rem 1.5rem; /* Aumentado padding */
        border-radius: 10px;
        margin-bottom: 1.75rem;
        font-size: 1rem; /* Texto más grande */
        border: 1px solid transparent;
    }

    .alert-error {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .login-footer {
        margin-top: 2.5rem; /* Más espacio */
        padding-top: 1.75rem;
        border-top: 1px solid var(--border-color);
        color: #6c757d;
        font-size: 0.95rem;
    }

    .brand-text {
        color: var(--primary-color);
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    .additional-options {
        margin-top: 1.5rem;
        text-align: center;
    }

    .additional-options a {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }

    .additional-options a:hover {
        color: #0b5ed7;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .login-container {
            max-width: 450px; /* Más ancho en tablets */
            padding: 2.5rem 2rem;
        }
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 2rem 1.5rem;
            margin: 15px;
            max-width: 400px; /* Aún más ancho en móviles */
        }
        
        .login-container h2 {
            font-size: 2rem;
        }
        
        .login-icon {
            font-size: 3rem;
        }
        
        .input-group input {
            padding: 1rem 1rem 1rem 3rem;
        }
    }

    @media (max-width: 400px) {
        .login-container {
            padding: 1.75rem 1.25rem;
            max-width: 350px;
        }
        
        .login-container h2 {
            font-size: 1.75rem;
        }
        
        .input-group input {
            padding: 0.875rem 0.875rem 0.875rem 2.75rem;
        }
    }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h2>Iniciar Sesión</h2>
            <p class="login-subtitle">Accede a tu cuenta RackON</p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($validation)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST" class="form-login" id="loginForm">
            <!-- Protección CSRF -->
            <?= csrf_field() ?>
            
            <div class="input-group">
                <i class="fas fa-envelope" id="emailIcon"></i>
                <input type="email" placeholder="Correo Electrónico" name="Email" id="email" required
                       value="<?= old('Email') ?>">
                <div class="error-message" id="emailError">Por favor ingresa un email válido</div>
            </div>

            <div class="input-group">
                <i class="fas fa-key" id="passwordIcon"></i>
                <input type="password" placeholder="Contraseña" name="Contraseña" id="password" required
                       minlength="6">
                <div class="error-message" id="passwordError">La contraseña debe tener al menos 6 caracteres</div>
            </div>

            <button type="submit" class="btn-login" id="submitBtn">
                <i class="fas fa-sign-in-alt me-2"></i> Iniciar Sesión
            </button>
        </form>

        <div class="additional-options">
            <a href="<?= base_url('/forgot-password') ?>">
                <i class="fas fa-question-circle me-1"></i> ¿Olvidaste tu contraseña?
            </a>
        </div>

        <a href="<?= base_url('/') ?>" class="btn-volver">
            <i class="fas fa-arrow-left me-2"></i> Volver a la página principal
        </a>

        <div class="login-footer">
            <p>Sistema <span class="brand-text">RackON</span> - Seguridad Inteligente para Racks</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Validación en tiempo real
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const submitBtn = document.getElementById('submitBtn');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const emailIcon = document.getElementById('emailIcon');
        const passwordIcon = document.getElementById('passwordIcon');

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validateForm() {
            let isValid = true;

            // Validar email
            if (!validateEmail(emailInput.value)) {
                emailInput.classList.add('error');
                emailIcon.classList.add('error');
                emailError.classList.add('show');
                isValid = false;
            } else {
                emailInput.classList.remove('error');
                emailIcon.classList.remove('error');
                emailError.classList.remove('show');
            }

            // Validar contraseña
            if (passwordInput.value.length < 6) {
                passwordInput.classList.add('error');
                passwordIcon.classList.add('error');
                passwordError.classList.add('show');
                isValid = false;
            } else {
                passwordInput.classList.remove('error');
                passwordIcon.classList.remove('error');
                passwordError.classList.remove('show');
            }

            submitBtn.disabled = !isValid;
            return isValid;
        }

        // Event listeners
        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);

        // Validar al enviar el formulario
        form.addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
            } else {
                // Mostrar loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Procesando...';
            }
        });

        // Validación inicial
        validateForm();
    });
    </script>
</body>
</html>