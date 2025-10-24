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
        max-width: 420px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        text-align: center;
        margin: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-container h2 {
        color: var(--dark-color);
        margin-bottom: 2rem;
        font-size: 2rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    .login-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .form-login {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .input-group {
        position: relative;
    }

    .input-group input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background-color: var(--light-color);
        color: var(--text-color);
        font-size: 1rem;
        transition: all 0.3s ease;
        box-sizing: border-box;
        font-family: 'Open Sans', sans-serif;
    }

    .input-group input:focus {
        border-color: var(--primary-color);
        outline: none;
        background-color: var(--light-color);
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .input-group i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1.1rem;
    }

    /* Botones con estilo moderno */
    .btn-login, .btn-volver {
        width: 100%;
        padding: 1rem;
        border-radius: 8px;
        border: none;
        background-color: var(--primary-color);
        color: white;
        font-family: 'Open Sans', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 0.5rem;
        text-align: center;
        box-sizing: border-box;
        text-decoration: none;
        display: block;
    }

    .btn-login:hover, .btn-volver:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(13, 110, 253, 0.25);
        color: white;
    }

    .btn-login:active, .btn-volver:active {
        transform: translateY(0);
    }

    /* Alertas mejoradas */
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
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
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
        color: #6c757d;
        font-size: 0.9rem;
    }

    .brand-text {
        color: var(--primary-color);
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 2rem 1.5rem;
            margin: 15px;
        }
        
        .login-container h2 {
            font-size: 1.75rem;
        }
        
        .login-icon {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 400px) {
        .login-container {
            padding: 1.5rem 1rem;
        }
        
        .login-container h2 {
            font-size: 1.5rem;
        }
        
        .input-group input {
            padding: 0.875rem 0.875rem 0.875rem 2.5rem;
        }
    }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-icon">
            <i class="fas fa-lock"></i>
        </div>
        <h2>Iniciar Sesión</h2>

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

        <form action="<?= base_url('login') ?>" method="POST" class="form-login">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Correo Electrónico" name="Email" required>
            </div>

            <div class="input-group">
                <i class="fas fa-key"></i>
                <input type="password" placeholder="Contraseña" name="Contraseña" required>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Entrar
            </button>
        </form>

        <a href="<?= base_url('/') ?>" class="btn-volver">
            <i class="fas fa-arrow-left me-2"></i> Volver a la página principal
        </a>

        <div class="login-footer">
            <p>Sistema <span class="brand-text">RackON</span> - Seguridad Inteligente</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>