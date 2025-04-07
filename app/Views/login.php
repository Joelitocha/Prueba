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

    <!-- ESTILOS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Iniciar sesión</h2>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
