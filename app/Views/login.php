<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>RackON – Seguridad de Racks con RFID y Sensores</title>
    <meta name="description" content="RackON es un sistema de seguridad inteligente para racks que combina tecnología RFID, sensores y cámaras. Protege tus servidores y controla el acceso de forma eficiente.">
    <meta name="keywords" content="RackON, seguridad de racks, RFID, sensores, IoT, control de accesos, CodeIgniter">
    <meta name="author" content="RackON.tech">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">
    
    <!-- ========== ESTILOS ========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    /* === ESTILOS GENERALES === */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://www.celmad.com/wp-content/uploads/2023/11/Que-es-un-centro-de-datos-y-por-que-estan-en-auge-2048x1170.jpg') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* === CONTENEDOR LOGIN === */
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

    /* === FORMULARIO === */
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

    .input-group input {
        padding-left: 40px;
    }

    /* === BOTÓN === */
    .btn-login {
        width: 100%;
        padding: 14px;
        border-radius: 6px;
        border: none;
        background-color: #3498db;
        color: white;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-login:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    /* === MENSAJES === */
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

    /* === RESPONSIVE === */
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
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
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
    </div>
</body>
</html>