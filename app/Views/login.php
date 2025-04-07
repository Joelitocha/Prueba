<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- ========== METADATOS SEO ========== -->
    <title>RackON - Sistema de Control de Acceso RFID | Argentina</title>
    <meta name="description" content="Sistema profesional de gestión de accesos mediante tarjetas RFID. Inicie sesión para administrar su cuenta.">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="RackON - Control de Acceso con Tecnología RFID">
    <meta property="og:description" content="Solución segura para gestión de accesos en empresas y organizaciones">
    <meta property="og:image" content="https://rackon.tech/assets/img/rackon-og.jpg">
    <meta property="og:url" content="https://rackon.tech/">
    <meta property="og:type" content="website">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    
    <!-- Schema.org -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "RackON",
      "url": "https://rackon.tech/",
      "description": "Sistema de control de acceso con tecnología RFID",
      "potentialAction": {
        "@type": "LoginAction",
        "target": "https://rackon.tech/",
        "method": "POST"
      }
    }
    </script>
    
    <!-- ========== ESTILOS ========== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
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
    }

    .input-group input:focus {
        border-color: #3498db;
        outline: none;
    }

    .btn-login {
        background-color: #3498db;
        color: #fff;
        padding: 14px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #2980b9;
    }

    .error-message {
        color: #e74c3c;
        background: #1a1a1a;
        padding: 10px;
        border-radius: 5px;
    }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión en RackON</h2>
        
        <form action="<?= base_url('login') ?>" method="post" class="form-login">
            <?= csrf_field() ?>

            <div class="input-group">
                <input type="email" name="email" placeholder="Correo electrónico" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="error-message"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <button type="submit" class="btn-login">Ingresar</button>
        </form>
    </div>
</body>
</html>
