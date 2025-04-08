<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de control de acceso inteligente para racks de servidores con RFID, sensores y cámaras. Seguridad de siguiente nivel.">
    <meta name="author" content="Federico Arias - Joel Martinez Vilche">
    <meta property="og:image" content="assets/images/header-background.jpg">
    <title>RackON - Rack Security</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link href="https://unpkg.com/swiper@7/swiper-bundle.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <style>
    :root {
        --primary-color: #7dc22b;
        --dark-color: #161223;
        --light-color: #f7f9fd;
        --text-color: #53575a;
    }
    
    body {
        font-family: 'Open Sans', sans-serif;
        color: var(--text-color);
        overflow-x: hidden;
        scroll-behavior: smooth;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
        color: var(--dark-color);
        font-weight: 600;
    }
    
    /* NAVBAR STYLES */
    #navbar {
        padding: 0.5rem 0;
    }
    
    #navbar .navbar-brand {
        margin-right: 0;
        padding-right: 0;
        display: flex;
        align-items: center;
    }
    
    #navbar .navbar-toggler {
        margin-left: auto;
        border: none;
        padding: 0.5rem;
    }
    
    #navbar .navbar-collapse {
        justify-content: flex-end;
        flex-grow: 0;
    }
    
    #navbar .navbar-nav {
        align-items: center;
    }
    
    #navbar .nav-item {
        margin-left: 0.5rem;
    }
    
    #navbar .btn-outline-light {
        border-color: rgba(255,255,255,0.5);
        color: white;
        transition: all 0.3s ease;
        padding: 0.375rem 1rem;
        white-space: nowrap;
    }
    
    #navbar .btn-outline-light:hover {
        background-color: rgba(255,255,255,0.1);
        border-color: white;
    }
    
    /* Mobile adjustments */
    @media (max-width: 991.98px) {
        #navbar .navbar-collapse {
            padding: 1rem 0;
            text-align: right;
        }
        
        #navbar .navbar-nav {
            align-items: flex-end;
        }
        
        #navbar .nav-item {
            margin: 0.5rem 0;
        }
        
        #navbar .btn-outline-light {
            margin-top: 0.5rem;
            display: inline-block;
            width: auto;
        }
    }
    
    /* Secciones */
    .fullpage-section {
        width: 100%;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        padding: 80px 0;
        display: flex;
        align-items: center;
    }

    /* Header */
    #header {
        background: linear-gradient(rgba(21, 35, 63, 0.7), rgba(21, 35, 63, 0.7)), url('assets/images/rackon-og.jpg') center center no-repeat;
        background-size: cover;
        color: white;
        text-align: center;
    }
    
    /* Resto de tus estilos existentes... */
    /* ===== ESTILOS PARA COMPACTAR AMBAS COLUMNAS ===== */
    #funcionamiento {
        padding: 23px 0;
        background-color: white;
    }

    /* Elimina altura forzada y ajusta layout */
    #funcionamiento .min-vh-100 {
        min-height: auto !important;
        height: auto;
    }

    #funcionamiento .image-column {
        box-sizing: content-box !important;
        height: auto !important;
        min-height: unset !important;
    }

    #funcionamiento .image-column img {
        max-height: 400px;
        width: auto;
        object-fit: contain;
    }

    /* Overlay más compacto */
    #funcionamiento .image-overlay h2 {
        font-size: 2rem;
        padding: 0 1rem;
        text-align: center;
    }

    /* Columna de texto ultra compacta */
    #funcionamiento .content-column {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
    }

    /* Texto más denso */
    #funcionamiento h2.text-primary {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    #funcionamiento .lead {
        font-size: 0.95rem;
        margin-bottom: 1.25rem;
        line-height: 1.5;
    }

    /* Tarjetas optimizadas */
    #funcionamiento .card {
        margin-bottom: 0.75rem;
        border-radius: 6px;
    }

    #funcionamiento .card-body {
        padding: 1rem;
    }

    #funcionamiento .badge {
        width: 28px;
        height: 28px;
        font-size: 0.85rem;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
        #funcionamiento .image-column {
            height: 400px;
            order: 2;
            margin-top: 1.5rem;
        }
        
        #funcionamiento .content-column {
            padding: 1rem;
        }
        
        #funcionamiento .image-overlay h2 {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 768px) {
        #funcionamiento .image-column {
            height: 350px;
        }
        
        #funcionamiento .card-body {
            padding: 0.75rem;
        }
    }
    
    /* Resto de tus estilos... */
    footer {
        background-color: #161223;
        color: #9ba3b1;
    }
    
    footer a {
        color: #9ba3b1;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    footer a:hover {
        color: var(--primary-color);
    }
    
    .social-icons a {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    
    .social-icons a:hover {
        transform: translateY(-3px);
    }
    
    .nav-link {
        padding: 0.25rem 0;
    }
    
    @media (max-width: 768px) {
        .footer-brand {
            text-align: center;
        }
        
        .social-icons {
            justify-content: center;
        }
        
        .app-badges {
            text-align: center;
        }
    }
</style>
</head>
<body>
    
    <!-- Navigation -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--dark-color);">
    <div class="container">
        <!-- Logo a la izquierda -->
        <a class="navbar-brand" href="#">
            <img src="assets/images/logo.svg" alt="RackON Logo" style="height: 40px;">
        </a>

        <!-- Botón toggle para móviles -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Elementos de navegación a la derecha -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="#header">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#introduction">¿Qué es RackON?</a></li>
                <li class="nav-item"><a class="nav-link" href="#funcionamiento">Cómo funciona</a></li>
                <li class="nav-item"><a class="nav-link" href="#hardware">Hardware</a></li>
                <li class="nav-item"><a class="nav-link" href="#planes">Planes de Compra</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                <!-- Botón de Acceder con estilo especial -->
                <li class="nav-item ms-lg-3 my-2 my-lg-0">
                    <a class="btn btn-outline-light" href="login">
                        <i class="fas fa-sign-in-alt me-2"></i>Acceder
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header Modificado -->
<section id="header" class="fullpage-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="h1-large text-white">Sistema Inteligente de Seguridad para Racks de Servidores</h1>
                <a class="btn-solid-lg mt-3" href="#introduction">Conocer más</a>
            </div>
        </div>
    </div>
</section>

    <!-- Introduction -->
    <section id="introduction" class="fullpage-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>¿Qué es RackON?</h2>
                    <p class="lead">
                        <strong>RackON</strong> es un sistema inteligente de control de acceso físico diseñado para racks de servidores. 
                        Combina tecnologías como RFID, sensores de vibración y cámaras de vigilancia para ofrecer una solución de seguridad robusta y en capas.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h4>Identificación RFID</h4>
                            <p>
                                Permite validar el acceso mediante tarjetas RFID, registrando quién accede al rack y cuándo lo hace.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h4>Detección de Vibración</h4>
                            <p>
                                Añade un nivel extra de seguridad detectando intentos de manipulación física o golpes no autorizados.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-video"></i>
                            </div>
                            <h4>Monitoreo por Cámara</h4>
                            <p>
                                Captura imágenes o video del acceso en tiempo real, permitiendo una supervisión visual directa del entorno del rack.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!--sección de funcionamiento-->
<section id="funcionamiento" class="container-fluid p-0 bg-white">
    <div class="row g-0 min-vh-100 align-items-stretch">
        <!-- Columna de Imagen -->
        <div class="col-lg-6 order-lg-1 order-2 position-relative">
            <div class="h-100 w-100 overflow-hidden">
                <img src="<?= base_url('assets/images/details-background.jpg') ?>" 
                     alt="Tecnología RackON en acción"
                     class="img-fluid w-100 h-100 object-fit-cover">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3);">
                </div>
            </div>
        </div>
        
        <!-- Columna de Texto Mejorada -->
        <div class="col-lg-6 order-lg-2 order-1 d-flex align-items-center py-5">
            <div class="px-4 px-md-5 py-lg-0" style="max-width: 700px; margin: 0 auto;">
                <h2 class="mb-4 text-primary">¿Cómo funciona RackON?</h2>
                <p class="lead mb-4">
                    El sistema RackON combina tecnología de identificación, sensores físicos y vigilancia electrónica para ofrecer una solución de seguridad en capas. Su funcionamiento se basa en tres niveles que actúan de forma secuencial y complementaria:
                </p>
                
                <!-- Nivel 1 -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="me-4">
                                <span class="badge bg-primary rounded-circle p-3">1</span>
                            </div>
                            <div>
                                <h4 class="text-primary">Verificación RFID</h4>
                                <p class="mb-0">
                                    Cada usuario autorizado posee una tarjeta RFID única. Al acercarla al lector, el sistema valida la identidad del usuario en la base de datos. Si la tarjeta está habilitada y el acceso es permitido, se registra el evento y se activa el siguiente nivel de seguridad.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Nivel 2 -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="me-4">
                                <span class="badge bg-primary rounded-circle p-3">2</span>
                            </div>
                            <div>
                                <h4 class="text-primary">Detección de Impacto</h4>
                                <p class="mb-0">
                                    Un sensor de vibración monitorea el rack en tiempo real. Si se detecta un golpe, movimiento brusco o intento de apertura forzada sin autenticación previa, el sistema genera una alerta automática y registra el incidente como un intento de intrusión.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Nivel 3 -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="me-4">
                                <span class="badge bg-primary rounded-circle p-3">3</span>
                            </div>
                            <div>
                                <h4 class="text-primary">Captura Visual</h4>
                                <p class="mb-0">
                                    En cada acceso (ya sea autorizado o no), se activa una cámara que captura imágenes o video del entorno inmediato del rack. Esta evidencia se almacena automáticamente y puede ser revisada desde el panel de administración web.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Resumen -->
                <div class="bg-light p-4 rounded">
                    <p class="mb-0">
                        <i class="fas fa-database text-primary me-2"></i>
                        <strong>Registro completo:</strong> Todos los eventos —accesos válidos, intentos fallidos, impactos detectados y grabaciones— quedan registrados en una base de datos segura. La información puede ser consultada desde la plataforma web de RackON, donde administradores y supervisores pueden acceder al historial completo, recibir alertas en tiempo real y analizar el comportamiento del sistema para reforzar la seguridad.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Hardware -->
    <section id="hardware" class="fullpage-section bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-12">
                    <h2>Hardware Utilizado</h2>
                    <p class="lead">Los siguientes dispositivos permiten implementar los tres niveles de seguridad del sistema RackON.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-microchip card-icon"></i>
                            <h5>ESP32</h5>
                            <p>Microcontrolador principal que gestiona la lectura de tarjetas RFID, sensores y comunicación con la base de datos.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card card-icon"></i>
                            <h5>Lector RFID RC522</h5>
                            <p>Dispositivo de lectura de tarjetas para autenticar el acceso físico al rack mediante identificación por radiofrecuencia.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-bolt card-icon"></i>
                            <h5>Sensor de Vibración</h5>
                            <p>Detecta intentos de manipulación física del rack, como golpes o movimientos bruscos no autorizados.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-video card-icon"></i>
                            <h5>Cámara de Vigilancia</h5>
                            <p>Captura imágenes o video del acceso en tiempo real, permitiendo registrar eventos sospechosos visualmente.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-lock card-icon"></i>
                            <h5>Mecanismo de Bloqueo</h5>
                            <p>Sistema electromecánico que permite o deniega el acceso al rack físicamente tras la validación.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Planes de Compra -->
<section id="planes" class="fullpage-section bg-light py-5">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col-lg-12">
                <h2 class="mb-3">Planes de Compra de RackON</h2>
                <p class="lead">Elige el plan que mejor se adapte a las necesidades de tu empresa. Todos los planes incluyen acceso a la plataforma web.</p>
            </div>
        </div>
        <div class="row text-center">

            <!-- Plan Básico -->
            <div class="col-md-6 col-lg-3 offset-lg-0 offset-md-3 mb-4">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-body">
                        <h4 class="card-title">🥉 Secure Access</h4>
                        <p class="card-text"><strong>Ideal para pequeñas empresas</strong></p>
                        <ul class="list-unstyled text-start small">
                            <li>✔ Acceso a 1 rack con RFID</li>
                            <li>✔ 1 capa de seguridad</li>
                            <li>✔ Registro en tiempo real</li>
                            <li>✔ Consulta web de accesos</li>
                            <li>✔ Soporte básico</li>
                            <li>➕ Monitoreo opcional</li>
                        </ul>
                        <hr>
                        <p><strong>Mensual:</strong> $25 USD</p>
                        <p><strong>Anual (10% off):</strong> $270 USD</p>
                        <p><strong>Dispositivo:</strong> $150 USD</p>
                    </div>
                </div>
            </div>

            <!-- Plan Intermedio -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-primary">
                    <div class="card-body">
                        <h4 class="card-title">🥈 Secure Plus</h4>
                        <p class="card-text"><strong>Para empresas medianas</strong></p>
                        <ul class="list-unstyled text-start small">
                            <li>✔ Hasta 5 racks</li>
                            <li>✔ 2 capas: RFID + Cámara</li>
                            <li>✔ Alertas por email</li>
                            <li>✔ Gestión web integrada</li>
                            <li>✔ Soporte prioritario</li>
                            <li>➕ Notificaciones móviles</li>
                        </ul>
                        <hr>
                        <p><strong>Mensual:</strong> $45 USD</p>
                        <p><strong>Anual (15% off):</strong> $459 USD</p>
                        <p><strong>Dispositivo:</strong> $250 USD</p>
                    </div>
                </div>
            </div>

            <!-- Plan Avanzado -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-danger">
                    <div class="card-body">
                        <h4 class="card-title">🥇 Secure Pro</h4>
                        <p class="card-text"><strong>Para máxima protección</strong></p>
                        <ul class="list-unstyled text-start small">
                            <li>✔ Acceso ilimitado</li>
                            <li>✔ 3 capas: RFID + Cámara + Sensor</li>
                            <li>✔ Terminal de cambios</li>
                            <li>✔ Encriptación avanzada</li>
                            <li>✔ Soporte 24/7</li>
                            <li>➕ Consultoría incluida</li>
                        </ul>
                        <hr>
                        <p><strong>Mensual:</strong> $70 USD</p>
                        <p><strong>Anual (20% off):</strong> $672 USD</p>
                        <p><strong>Dispositivo:</strong> $350 USD</p>
                    </div>
                </div>
            </div>

            <!-- Plan Personalizado -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow border-dark">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title">🛠️ Plan Personalizado</h4>
                            <p class="card-text"><strong>¿Necesitas algo especial?</strong></p>
                            <p class="small">Contáctanos para recibir una propuesta a medida, adaptada a tus necesidades específicas de seguridad y gestión.</p>
                        </div>
                        <a href="#contacto" class="btn btn-outline-dark mt-3">Solicitar Cotización</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


    <!-- Contact -->
    <section id="contact" class="fullpage-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2>Contáctenos</h2>
                    <p class="lead">Complete el formulario y nos pondremos en contacto con usted</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Mensaje" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-solid-lg">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-4 pb-3">
    <div class="container">
        <div class="row g-4">
            <!-- Columna Información -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand mb-3">
                    <img src="<?= base_url('assets/images/logo-light.svg') ?>" alt="RackON Logo" style="height: 40px;">
                </div>
                <p class="small text-muted">Sistema de seguridad en capas para racks de servidores que combina RFID, sensores y cámaras para protección física de infraestructura crítica.</p>
                <div class="mt-3">
                    <h6 class="text-uppercase text-primary mb-2">Newsletter</h6>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control form-control-sm" placeholder="Tu correo">
                        <button class="btn btn-primary btn-sm" type="button">Suscribir</button>
                    </div>
                </div>
            </div>

            <!-- Columna Enlaces -->
            <div class="col-lg-2 col-md-6">
                <h6 class="text-uppercase text-primary mb-3">Enlaces</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Términos y Condiciones</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Política de Privacidad</a></li>
                    <li class="nav-item mb-2"><a href="#header" class="nav-link p-0 text-muted">Inicio</a></li>
                    <li class="nav-item mb-2"><a href="#introduction" class="nav-link p-0 text-muted">Características</a></li>
                    <li class="nav-item mb-2"><a href="#contact" class="nav-link p-0 text-muted">Contacto</a></li>
                </ul>
            </div>

            <!-- Columna Contacto -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-uppercase text-primary mb-3">Contacto</h6>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <a href="mailto:info@rackon.com" class="text-muted">info@rackon.com</a>
                    </li>
                    <li class="nav-item mb-2">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <span class="text-muted">+1 (555) 123-4567</span>
                    </li>
                    <li class="nav-item mb-2">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span class="text-muted">Av. Tecnología 123, CDMX</span>
                    </li>
                </ul>
            </div>

            <!-- Columna Redes Sociales -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-uppercase text-primary mb-3">Síguenos</h6>
                <div class="social-icons d-flex mb-3">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="fab fa-instagram"></i></a>
                </div>
                <h6 class="text-uppercase text-primary mb-2">Descarga nuestra app</h6>
                <div class="app-badges">
                    <a href="#" class="d-inline-block me-2 mb-2">
                        <img src="<?= base_url('assets/images/google-play-badge.png') ?>" alt="Google Play" style="height: 40px;">
                    </a>
                    <a href="#" class="d-inline-block mb-2">
                        <img src="<?= base_url('assets/images/app-store-badge.png') ?>" alt="App Store" style="height: 40px;">
                    </a>
                </div>
            </div>
        </div>

        <hr class="my-4 border-secondary">

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="small text-muted mb-0">&copy; <script>document.write(new Date().getFullYear())</script> RackON. Todos los derechos reservados.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="small text-muted mb-0">Desarrollado con <i class="fas fa-heart text-danger"></i> por tu equipo</p>
            </div>
        </div>
    </div>
</footer>


    <!-- Back To Top Button -->
    <button id="backToTop" class="btn btn-primary rounded-circle" style="position: fixed; bottom: 20px; right: 20px; display: none;">
        <i class="fas fa-arrow-up"></i>
    </button>
        
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script>
    // Inicializar Swiper para testimonios
    new Swiper('.testimonial-slider', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        autoplay: {
            delay: 5000,
        }
    });
    
    // Botón volver arriba
    window.addEventListener('scroll', function() {
        var backToTop = document.getElementById('backToTop');
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'block';
        } else {
            backToTop.style.display = 'none';
        }
    });
    
    document.getElementById('backToTop').addEventListener('click', function() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
    
    // Efecto navbar al hacer scroll
    window.addEventListener('scroll', function() {
        var navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        } else {
            navbar.style.boxShadow = 'none';
        }
    });
    </script>
</body>
</html>