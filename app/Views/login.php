<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ========== ESTILOS ========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: url('https://www.celmad.com/wp-content/uploads/2023/11/Que-es-un-centro-de-datos-y-por-que-estan-en-auge-2048x1170.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        background-color: #2b2b2b;
        padding: 40px;
        border-radius: 8px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        text-align: center;
        margin: 20px;
    }

    .login-container h2 {
        color: #3498db;
        margin-bottom: 30px;
        font-size: 24px;
        font-weight: 600;
    }

    .form-login {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .input-group {
        position: relative;
    }

    .input-group input {
        width: 100%;
        padding: 14px 20px;
        border: 1px solid #444;
        border-radius: 6px;
        background-color: #3a3a3a;
        color: #fff;
        font-size: 15px;
        transition: all 0.3s ease;
        box-sizing: border-box;
        padding-left: 40px;
    }

    .input-group input:focus {
        border-color: #3498db;
        outline: none;
        background-color: #444;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }

    .input-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #7f8c8d;
    }

    /* Estilos para ambos botones (ahora idénticos) */
    .btn-login, .btn-volver {
        width: 100%;
        padding: 14px;
        border-radius: 6px;
        border: none;
        background-color: #3498db;
        color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Misma fuente que el body */
        font-size: 16px;
        font-weight: 500; /* Mismo peso que el título h2 */
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
        text-align: center;
        box-sizing: border-box;
    }

    .btn-login:hover, .btn-volver:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .btn-login:active, .btn-volver:active {
        transform: translateY(0);
    }

    /* Estilo específico para el enlace (btn-volver) */
    .btn-volver {
        text-decoration: none;
        display: block;
    }

    .alert {
        padding: 12px 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .alert-error {
        color: #e74c3c;
        background-color: #fdecea;
        border: 1px solid #f5c6cb;
    }

    .alert-success {
        color: #27ae60;
        background-color: #e8f5e9;
        border: 1px solid #c3e6cb;
    }

    @media (max-width: 576px) {
        .login-container {
            padding: 30px 20px;
        }
    }
    </style>
</head>
<body>
    <div class="login-container">
        <h2><i class="fas fa-lock"></i> Iniciar Sesión</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
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
                <i class="fas fa-sign-in-alt"></i> Entrar
            </button>
        </form>

        <!-- Botón para volver al index (ahora idéntico al botón "Entrar") -->
        <a href="index.php" class="btn-volver">
            <i class="fas fa-arrow-left"></i> Volver a la página principal
        </a>
    </div>
</body>
</html>