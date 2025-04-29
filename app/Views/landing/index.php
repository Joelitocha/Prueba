<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de control de acceso inteligente para racks de servidores con RFID, sensores y cámaras. Seguridad de siguiente nivel.">
    <meta name="author" content="Federico Arias - Joel Martinez Vilche">
    <meta name="keywords" content="seguridad racks, control acceso RFID, protección servidores, sistema IoT seguridad, rackon, rackon sistema de seguridad">

    <!-- Etiquetas Open Graph -->
    <meta property="og:title" content="RackON - Seguridad Inteligente para Racks">
    <meta property="og:description" content="Sistema IoT de seguridad para racks con acceso RFID y sensores.">
    <meta property="og:image" content="assets/images/rackon-og.jpg"> 
    <meta property="og:url" content="https://rackon.tech">
    <meta property="og:type" content="website">
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
    
    /* Estilos base */
    body {
        font-family: 'Open Sans', sans-serif;
        color: var(--text-color);
        overflow-x: hidden;
        scroll-behavior: smooth;
        padding-top: 70px; /* Para el navbar fixed */
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
        color: var(--dark-color);
        font-weight: 600;
    }
    
    /* NAVBAR RESPONSIVE */
    #navbar {
        padding: 0.5rem 1rem;
        background-color: var(--dark-color) !important;
        transition: all 0.3s ease;
    }
    
    #navbar .navbar-brand {
        margin-right: 0;
        padding: 0;
        height: 40px;
        display: flex;
        align-items: center;
    }
    
    #navbar .navbar-brand img {
        height: 100%;
        width: auto;
    }
    
    #navbar .navbar-toggler {
        margin-left: auto;
        padding: 0.5rem;
        border: none;
        font-size: 1.25rem;
        color: rgba(255,255,255,0.8);
    }
    
    #navbar .navbar-collapse {
        flex-basis: 100%;
        justify-content: flex-end;
    }
    
    #navbar .navbar-nav {
        align-items: center;
        padding-top: 0.5rem;
    }
    
    #navbar .nav-item {
        margin-left: 0.5rem;
    }
    
    #navbar .nav-link {
        color: rgba(255,255,255,0.8);
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }
    
    #navbar .nav-link:hover,
    #navbar .nav-link.active {
        color: white;
    }
    
    #navbar .btn-outline-light {
        border-color: rgba(255,255,255,0.5);
        color: white;
        padding: 0.375rem 1rem;
        white-space: nowrap;
        transition: all 0.3s ease;
        margin-left: 0.5rem;
    }
    
    #navbar .btn-outline-light:hover {
        background-color: rgba(255,255,255,0.1);
        border-color: white;
    }
    
    #navbar.scrolled {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 0.25rem 1rem;
    }
    
    /* SECCIONES GENERALES */
    .fullpage-section {
        width: 100%;
        min-height: 100vh;
        padding: 80px 0;
        display: flex;
        align-items: center;
    }
    
    .section-title {
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .section-title h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .section-title .lead {
        font-size: 1.25rem;
        max-width: 800px;
        margin: 0 auto;
    }
    
    /* HEADER */
    #header {
        background: linear-gradient(rgba(21, 35, 63, 0.7), rgba(21, 35, 63, 0.7)), url('assets/images/princ.png') center center no-repeat;
        background-size: cover;
        color: white;
        text-align: center;
    }
    
    #header .h1-large {
        font-size: 3.5rem;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }
    
    /* BOTONES */
    .btn-solid-lg {
        display: inline-block;
        padding: 15px 30px;
        border: 1px solid var(--primary-color);
        border-radius: 4px;
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-solid-lg:hover {
        background-color: transparent;
        color: var(--primary-color);
    }
    
    /* TARJETAS */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
        height: 100%;
        margin-bottom: 1.5rem;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
    
    .card-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 20px;
    }
    
    /* SECCIÓN FUNCIONAMIENTO */
    #funcionamiento {
        background-color: white;
    }
    
    #funcionamiento .image-column {
        min-height: 400px;
        position: relative;
        overflow: hidden;
    }
    
    #funcionamiento .image-column img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    #funcionamiento .content-column {
        padding: 2rem;
    }
    
    #funcionamiento .step-card {
        margin-bottom: 1.5rem;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    #funcionamiento .step-badge {
        width: 40px;
        height: 40px;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    /* SECCIÓN HARDWARE */
    #hardware {
        background-color: var(--light-color);
    }
    
    .hardware-card {
        text-align: center;
        padding: 2rem 1rem;
    }

    /* SECCIÓN PLANES */
    #planes {
        background-color: var(--light-color);
    }

    .plan-card {
        transition: all 0.3s;
    }

    .plan-card:hover {
        transform: translateY(-10px);
    }

    .plan-card .card-body {
        padding: 2rem;
    }

    .plan-card ul {
        padding-left: 0;
        list-style: none;
    }

    .plan-card ul li {
        margin-bottom: 0.5rem;
        position: relative;
        padding-left: 1.5rem;
    }

    .plan-card ul li:before {
        content: "✔";
        position: absolute;
        left: 0;
        color: var(--primary-color);
    }

    /* NUEVO: Mostrar/Ocultar contenido */
    .ver-mas-contenido {
        display: none;
    }

    .ver-mas-contenido.mostrar {
        display: block;
    }

    .ver-mas-btn {
        cursor: pointer;
        color: var(--primary-color);
        text-decoration: underline;
        font-size: 0.9rem;
        display: inline-block;
        margin-top: 0.5rem;
    }

    /* Botón "Comprar" siempre abajo */
    .btn-compra {
        margin-top: auto;
        font-weight: 500;
    }

    /* SECCIÓN CONTACTO */
    #contact {
        background: linear-gradient(rgba(2, 15, 29, 0.8), rgba(2, 15, 29, 0.8)), url('assets/images/contact-background.jpg') center center no-repeat;
        background-size: cover;
        color: white;
    }
    
    .contact-form .form-control {
        background-color: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 12px 15px;
    }
    
    .contact-form .form-control::placeholder {
        color: rgba(255,255,255,0.7);
    }

    #contact .section-title h2 {
        color: white !important;
    }

    /* FOOTER */
    footer {
        background-color: var(--dark-color);
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
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.1);
        margin-right: 0.5rem;
        transition: all 0.3s;
    }
    
    .social-icons a:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-3px);
    }
    
    /* BOTÓN SUBIR */
    #backToTop {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        z-index: 99;
    }
    
    /* ========================================= */
    /* MEDIA QUERIES PARA RESPONSIVE */
    /* ========================================= */
    
    /* Dispositivos medianos (tablets, 768px y más) */
    @media (min-width: 768px) {
        #header .h1-large {
            font-size: 4rem;
        }
        
        #navbar .navbar-collapse {
            flex-basis: auto;
            padding-top: 0;
        }
        
        #navbar .navbar-nav {
            padding-top: 0;
        }
        
        #navbar .nav-item {
            margin-left: 0.75rem;
        }
        
        .section-title h2 {
            font-size: 3rem;
        }
    }
    
    /* Dispositivos grandes (desktops, 992px y más) */
    @media (min-width: 992px) {
        #navbar {
            padding: 0.75rem 1.5rem;
        }
        
        #navbar .nav-item {
            margin-left: 1rem;
        }
        
        #navbar .nav-link {
            padding: 0.5rem 1rem;
        }
        
        #navbar .btn-outline-light {
            padding: 0.5rem 1.25rem;
            margin-left: 1rem;
        }
        
        #navbar.scrolled {
            padding: 0.5rem 1.5rem;
        }
        
        #header .h1-large {
            font-size: 5rem;
        }
        
        #funcionamiento .content-column {
            padding: 3rem;
        }
    }
    
    /* Dispositivos pequeños (teléfonos, menos de 768px) */
    @media (max-width: 767.98px) {
        body {
            padding-top: 60px;
        }
        
        #header .h1-large {
            font-size: 2.5rem;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        #navbar .navbar-collapse {
            background-color: var(--dark-color);
            padding: 1rem;
            margin-top: 0.5rem;
            border-radius: 0.25rem;
            text-align: right;
        }
        
        #navbar .navbar-nav {
            align-items: flex-end;
        }
        
        #navbar .nav-item {
            margin: 0.5rem 0;
            width: 100%;
        }
        
        #navbar .nav-link {
            padding: 0.5rem 0;
            display: inline-block;
        }
        
        #navbar .btn-outline-light {
            margin: 0.5rem 0 0;
            width: auto;
            display: inline-block;
        }
        
        #funcionamiento .image-column {
            min-height: 300px;
            order: 2;
        }
        
        #funcionamiento .content-column {
            padding: 1.5rem;
        }
        
        .plan-card {
            margin-bottom: 1.5rem;
        }
        
        /* Ajustes para sección de contacto */
        #contact .contact-form {
            padding: 0 15px;
        }
        
        /* Ajustes para footer */
        footer .col-lg-4, 
        footer .col-lg-3, 
        footer .col-lg-2 {
            margin-bottom: 2rem;
        }
        
        footer .text-md-start, 
        footer .text-md-end {
            text-align: center !important;
        }
    }
    
    /* Dispositivos muy pequeños (menos de 400px) */
    @media (max-width: 400px) {
        #header .h1-large {
            font-size: 2rem;
        }
        
        #navbar .navbar-brand img {
            height: 35px;
        }
        
        .btn-solid-lg {
            padding: 12px 24px;
            font-size: 0.9rem;
        }
        
        .section-title h2 {
            font-size: 1.8rem;
        }
        
        .section-title .lead {
            font-size: 1rem;
        }
        
        /* Ajustes para tarjetas de hardware */
        .hardware-card {
            padding: 1.5rem 0.5rem;
        }
        
        /* Ajustes para formulario de contacto */
        .contact-form .form-control {
            padding: 10px 12px;
        }
    }
    
    /* Ajustes específicos para pantallas muy pequeñas en modo horizontal */
    @media (max-height: 500px) and (orientation: landscape) {
        .fullpage-section {
            min-height: auto;
            padding: 60px 0;
        }
    }
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">
                <img src="assets/images/pro.png" alt="RackON Logo" style="height: 40px;">
            </a>
            
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#header">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#introduction">¿Qué es RackON?</a></li>
                    <li class="nav-item"><a class="nav-link" href="#funcionamiento">Cómo funciona</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hardware">Hardware</a></li>
                    <li class="nav-item"><a class="nav-link" href="#planes">Planes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contáctenos</a></li>
                    <li class="nav-item ms-lg-3 my-2 my-lg-0">
                        <a class="btn btn-outline-light" href="login">
                            <i class="fas fa-sign-in-alt me-2"></i>Acceder
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section id="header" class="fullpage-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="h1-large text-white">Sistema Inteligente de Seguridad para Servidores Rack</h1>
                    <a class="btn-solid-lg mt-3" href="#introduction">Conocer más</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section id="introduction" class="fullpage-section">
        <div class="container">
            <div class="section-title">
                <h2>¿Qué es RackON?</h2>
                <p class="lead">
                    <strong>RackON</strong> es un sistema inteligente de control de acceso físico diseñado para racks de servidores. 
                    Combina tecnologías como RFID, sensores de vibración y cámaras de vigilancia para ofrecer una solución de seguridad robusta y en capas.
                </p>
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
                                <i class="fas fa-video"></i>
                            </div>
                            <h4>Monitoreo por Cámara</h4>
                            <p>
                                Captura imágenes o video del acceso en tiempo real, permitiendo una supervisión visual directa del entorno del rack.
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
                
            </div>
        </div>
    </section>

    <!-- Sección de funcionamiento -->
    <section id="funcionamiento" class="fullpage-section">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100 align-items-stretch">
                <!-- Columna de Imagen -->
                <div class="col-lg-6 order-lg-1 order-2 image-column">
                    <div class="h-100 w-100 overflow-hidden">
                        <img src="assets/images/rack.png" 
                             alt="Tecnología RackON en acción"
                             class="img-fluid w-100 h-100 object-fit-cover">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3);">
                        </div>
                    </div>
                </div>
                
                <!-- Columna de Texto -->
                <div class="col-lg-6 order-lg-2 order-1 d-flex align-items-center content-column">
                    <div class="px-4 px-md-5 py-lg-0 py-4">
                        <h2 class="mb-4 text-primary">¿Cómo funciona RackON?</h2>
                        <p class="lead mb-4">
                            El sistema RackON combina tecnología de identificación, sensores físicos y vigilancia electrónica para ofrecer una solución de seguridad en capas. Su funcionamiento se basa en tres niveles que actúan de forma secuencial y complementaria:
                        </p>
                        
                        <!-- Nivel 1 -->
                        <div class="card mb-4 step-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-circle p-3 step-badge">1</span>
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
                        <div class="card mb-4 step-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-circle p-3 step-badge">2</span>
                                    <div>
                                        <h4 class="text-primary">Captura Visual</h4>
                                        <p class="mb-0">
                                            En cada acceso (ya sea autorizado o no), se activa una cámara que captura imágenes o video del entorno inmediato del rack. Esta evidencia se almacena automáticamente y puede ser revisada desde el panel de administración web.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nivel 3 -->
                        <div class="card mb-4 step-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-circle p-3 step-badge">3</span>
                                    <div>
                                        <h4 class="text-primary">Detección de Impacto</h4>
                                        <p class="mb-0">
                                            Un sensor de vibración monitorea el rack en tiempo real. Si se detecta un golpe, movimiento brusco o intento de apertura forzada sin autenticación previa, el sistema genera una alerta automática y registra el incidente como un intento de intrusión.
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
        </div>
    </section>

    <!-- Hardware -->
    <section id="hardware" class="fullpage-section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Hardware Utilizado</h2>
                <p class="lead">Los siguientes dispositivos permiten implementar los tres niveles de seguridad del sistema RackON.</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card hardware-card">
                        <div class="card-body text-center">
                            <i class="fas fa-microchip card-icon"></i>
                            <h5>ESP32</h5>
                            <p>Microcontrolador principal que gestiona la lectura de tarjetas RFID, sensores y comunicación con la base de datos.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card hardware-card">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card card-icon"></i>
                            <h5>Lector RFID RC522</h5>
                            <p>Dispositivo de lectura de tarjetas para autenticar el acceso físico al rack mediante identificación por radiofrecuencia.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card hardware-card">
                        <div class="card-body text-center">
                            <i class="fas fa-bolt card-icon"></i>
                            <h5>Sensor de Vibración</h5>
                            <p>Detecta intentos de manipulación física del rack, como golpes o movimientos bruscos no autorizados.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card hardware-card">
                        <div class="card-body text-center">
                            <i class="fas fa-video card-icon"></i>
                            <h5>Cámara de Vigilancia</h5>
                            <p>Captura imágenes o video del acceso en tiempo real, permitiendo registrar eventos sospechosos visualmente.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card hardware-card">
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

<!-- SDK PayPal SANDBOX -->
<script src="https://www.paypal.com/sdk/js?client-id=AXn6zeaT-kutunjZDVGKpbDSQ6WCCPgvHvsdaVYjrQvy4udAukapA5ISWF9QIR268HG_K-eDjk8ETcYs&currency=USD"></script>

<!-- MODAL -->
<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCompraLabel">Selecciona una opción de compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p id="modalPlanNombre" class="fw-bold mb-3"></p>
        <p><strong>Mensual:</strong> $<span id="modalPrecioMensual"></span></p>
        <div id="paypal-button-modal-mensual" class="mb-4"></div>
        <p><strong>Anual:</strong> $<span id="modalPrecioAnual"></span></p>
        <div id="paypal-button-modal-anual"></div>
      </div>
    </div>
  </div>
</div>

<!-- SECCIÓN PLANES -->
<section id="planes" class="py-5">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Planes de Compra de RackON</h2>
      <p class="lead">Elige el plan que mejor se adapte a tu empresa.</p>
    </div>
    <div class="row">

      <!-- PLAN 1 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card plan-card border-success h-100">
          <div class="card-body d-flex flex-column">
            <h4 class="card-title">🥉 Secure Access</h4>
            <p><strong>Ideal para pequeñas empresas</strong></p>
            <ul>
              <li>Protección para 1 rack</li>
              <li>1 capa de seguridad: RFID</li>
              <li>Soporte básico</li>
              <li class="extra d-none">Notificaciones por correo</li>
              <li class="extra d-none">Monitoreo en tiempo real</li>
              <li class="extra d-none">Plataforma web incluida</li>
            </ul>
            <a href="#" class="ver-mas text-primary mb-3">Ver más</a>
            <a href="#" class="ver-menos text-danger mb-3 d-none">Ver menos</a>
            <div class="mt-auto">
              <p><strong>Dispositivo:</strong> $92 USD</p>
              <p><strong>Mensual:</strong> $25 USD</p>
              <p><strong>Anual:</strong> $270 USD</p>
              <button class="btn btn-outline-success w-100"
                      onclick="abrirModalCompra('Secure Access', 117, 362)">Comprar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- PLAN 2 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card plan-card border-primary h-100">
          <div class="card-body d-flex flex-column">
            <h4 class="card-title">🥈 Secure Plus</h4>
            <p><strong>Para empresas medianas</strong></p>
            <ul>
              <li>Hasta 5 racks</li>
              <li>2 capas: RFID + Cámara</li>
              <li>Soporte prioritario</li>
              <li class="extra d-none">Historial de accesos</li>
              <li class="extra d-none">Alertas en tiempo real</li>
              <li class="extra d-none">Acceso web multiusuario</li>
            </ul>
            <a href="#" class="ver-mas text-primary mb-3">Ver más</a>
            <a href="#" class="ver-menos text-danger mb-3 d-none">Ver menos</a>
            <div class="mt-auto">
              <p><strong>Dispositivo:</strong> $462 USD</p>
              <p><strong>Mensual:</strong> $45 USD</p>
              <p><strong>Anual:</strong> $459 USD</p>
              <button class="btn btn-outline-primary w-100"
                      onclick="abrirModalCompra('Secure Plus', 507, 921)">Comprar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- PLAN 3 -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card plan-card border-danger h-100">
          <div class="card-body d-flex flex-column">
            <h4 class="card-title">🥇 Secure Pro</h4>
            <p><strong>Para máxima seguridad</strong></p>
            <ul>
              <li>Hasta 10 racks</li>
              <li>3 capas: RFID + Cámara + Sensor</li>
              <li>Soporte premium</li>
              <li class="extra d-none">Detección de golpes</li>
              <li class="extra d-none">Interfaz tipo terminal</li>
              <li class="extra d-none">Actualizaciones incluidas</li>
            </ul>
            <a href="#" class="ver-mas text-primary mb-3">Ver más</a>
            <a href="#" class="ver-menos text-danger mb-3 d-none">Ver menos</a>
            <div class="mt-auto">
              <p><strong>Dispositivo:</strong> $924 USD</p>
              <p><strong>Mensual:</strong> $70 USD</p>
              <p><strong>Anual:</strong> $672 USD</p>
              <button class="btn btn-outline-danger w-100"
                      onclick="abrirModalCompra('Secure Pro', 994, 1596)">Comprar</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

    <!-- Contact -->
<section id="contact" class="fullpage-section">
    <div class="container">
        <div class="section-title text-white">
            <h2>Contáctenos</h2>
            <p class="lead">Complete el formulario y nos pondremos en contacto con usted</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form class="contact-form" action="https://formsubmit.co/rackonoficial@gmail.com" method="POST">
                    <!-- Input oculto para redirección después del envío -->
                    <input type="hidden" name="_next" value="https://rackon.tech/">
                    <!-- Token para evitar spam -->
                    <input type="hidden" name="_captcha" value="false">
                    <!-- Asunto personalizado -->
                    <input type="hidden" name="_subject" value="Nuevo mensaje desde Rackon.tech">
                    <!-- Para evitar que los spammers usen el formulario -->
                    <input type="text" name="_honey" style="display:none">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
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
    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Columna Información -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand mb-3">
                        <img src="assets/images/pro.png" alt="RackON Logo" style="height: 40px;">
                    </div>
                    <p class="small">Sistema de seguridad en capas para racks de servidores que combina RFID, sensores y cámaras para protección física de infraestructura crítica.</p>

                </div>

                <!-- Columna Enlaces -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-uppercase text-primary mb-3">Enlaces</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#header" class="nav-link p-0">Inicio</a></li>
                        <li class="nav-item mb-2"><a href="#introduction" class="nav-link p-0">Características</a></li>
                        <li class="nav-item mb-2"><a href="#contact" class="nav-link p-0">Contacto</a></li>
                        <li class="nav-item mb-2"><a href="#En Proceso" class="nav-link p-0">Política de Privacidad</a></li>
                        <li class="nav-item mb-2"><a href="#En Proceso" class="nav-link p-0">Términos y Condiciones</a></li>
                    </ul>
                </div>

                <!-- Columna Contacto -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="text-uppercase text-primary mb-3">Contacto</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <a href="mailto:rackonoficial@gmail.com">rackonoficial@gmail.com</a>
                        </li>
                        <li class="nav-item mb-2">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            <span>+1 (555) 123-4567</span>
                        </li>
                        <li class="nav-item mb-2">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <span>2 De Abril 1175 X5850 Río Tercero, Córdoba</span>
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
                            <img src="assets/images/playstore.png" alt="Google Play" style="height: 40px;">
                        </a>
                        <a href="#" class="d-inline-block mb-2">
                            <img src="assets/images/app.png" alt="App Store" style="height: 40px;">
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0">&copy; <script>document.write(new Date().getFullYear())</script> RackON. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back To Top Button -->
    <button id="backToTop" class="btn btn-primary">
        <i class="fas fa-arrow-up"></i>
    </button>
        
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "RackON",
  "description": "Sistema de seguridad inteligente para racks de servidores",
  "brand": {
    "@type": "Brand",
    "name": "RackON"
  }
}
</script>
    <script>
    // Efecto de scroll para el navbar
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Mostrar/ocultar botón de subir
        const backToTop = document.getElementById('backToTop');
        if (window.scrollY > 300) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    });
    
    // Smooth scrolling para todos los links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Botón subir
    document.getElementById('backToTop').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    </script>
<script>
  // Ver más / Ver menos
  document.querySelectorAll('.ver-mas').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const card = btn.closest('.card-body');
      card.querySelectorAll('.extra').forEach(el => el.classList.remove('d-none'));
      card.querySelector('.ver-mas').classList.add('d-none');
      card.querySelector('.ver-menos').classList.remove('d-none');
    });
  });

  document.querySelectorAll('.ver-menos').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const card = btn.closest('.card-body');
      card.querySelectorAll('.extra').forEach(el => el.classList.add('d-none'));
      card.querySelector('.ver-menos').classList.add('d-none');
      card.querySelector('.ver-mas').classList.remove('d-none');
    });
  });

  function abrirModalCompra(planNombre, precioMensual, precioAnual) {
    document.getElementById('modalPlanNombre').innerText = planNombre;
    document.getElementById('modalPrecioMensual').innerText = precioMensual;
    document.getElementById('modalPrecioAnual').innerText = precioAnual;

    // Limpiar contenedores PayPal antes de renderizar
    document.getElementById('paypal-button-modal-mensual').innerHTML = '';
    document.getElementById('paypal-button-modal-anual').innerHTML = '';

    // Render botón mensual
    paypal.Buttons({
      createOrder: (data, actions) => actions.order.create({
        purchase_units: [{ amount: { value: precioMensual.toString() } }]
      }),
      onApprove: (data, actions) => actions.order.capture().then(detalles =>
        alert('Pago mensual completado: ' + detalles.payer.name.given_name)
      )
    }).render('#paypal-button-modal-mensual');

    // Render botón anual
    paypal.Buttons({
      createOrder: (data, actions) => actions.order.create({
        purchase_units: [{ amount: { value: precioAnual.toString() } }]
      }),
      onApprove: (data, actions) => actions.order.capture().then(detalles =>
        alert('Pago anual completado: ' + detalles.payer.name.given_name)
      )
    }).render('#paypal-button-modal-anual');

    const modal = new bootstrap.Modal(document.getElementById('modalCompra'));
    modal.show();
  }
</script>
</body>
</html>