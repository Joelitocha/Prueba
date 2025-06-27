<?php
$session=session();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de control de acceso inteligente para racks de servidores con RFID, sensores y cámaras. Seguridad de siguiente nivel.">
    <meta name="author" content="Federico Arias - Joel Martinez Vilche">
    <meta name="keywords" content="seguridad racks, control acceso RFID, protección servidores, sistema IoT seguridad, rackon, rackon sistema de seguridad">

    <meta property="og:title" content="RackON - Seguridad Inteligente para Racks">
    <meta property="og:description" content="Sistema IoT de seguridad para racks con acceso RFID y sensores.">
    <meta property="og:image" content="assets/images/rackon-og.jpg"> 
    <meta property="og:url" content="https://rackon.tech">
    <meta property="og:type" content="website">
    <title>RackON - Rack Security</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/swiper@7/swiper-bundle.min.css" rel="stylesheet">
    
    <style>
    :root {
        --primary-color: #0d6efd;
        --dark-color: #161223;
        --light-color: #f7f9fd;
        --text-color: #000000;
    }
    
    /* Estilos base */
    body {
        font-family: 'Open Sans', sans-serif;
        color: var(--text-color);
        overflow-x: hidden;
        scroll-behavior: smooth;
        padding-top: 50px; 
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
        max-width: 100%;
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

    /* SECCIÓN ADQUIRIR */
    #adquirir {
        background-color: var(--light-color);
        padding-top: 80px;
        padding-bottom: 80px;
        text-align: center;
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
        font-size: 20px;
        line-height: 1;
    }
    
    /* ========================================= */
    /* MEDIA QUERIES PARA RESPONSIVE - MEJORADAS */
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
    
    /* Dispositivos pequeños (teléfonos, menos de 768px) - MEJORADO */
    @media (max-width: 767.98px) {
        body {
            padding-top: 70px;
        }
        
        #header .h1-large {
            font-size: 2.5rem;
            padding: 0 15px;
        }
        
        .section-title h2 {
            font-size: 2.2rem;
        }
        
        #navbar {
            padding: 0.75rem 1rem;
        }
        
        #navbar .navbar-brand img {
            height: 45px;
        }
        
        #navbar .navbar-collapse {
            background-color: var(--dark-color);
            padding: 1rem;
            margin: 0.5rem -1rem 0 -1rem;
            border-radius: 0;
            text-align: left;
        }
        
        #navbar .navbar-nav {
            align-items: flex-start;
        }
        
        #navbar .nav-item {
            margin: 0.75rem 0;
            width: 100%;
        }
        
        #navbar .nav-link {
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
            display: block;
        }
        
        #navbar .btn-outline-light {
            margin: 1rem 0 0;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
            text-align: center;
        }
        
        #funcionamiento .image-column {
            min-height: 300px;
            order: 2;
        }
        
        #funcionamiento .content-column {
            padding: 1.5rem 1rem;
        }
        
        #funcionamiento .step-card {
            margin-bottom: 1.25rem;
        }
        
        #funcionamiento .step-badge {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }
        
        /* Ajustes para sección de contacto */
        #contact .contact-form {
            padding: 0 10px;
        }
        
        .contact-form .form-control {
            padding: 14px 15px;
            font-size: 1rem;
        }
        
        .btn-solid-lg {
            padding: 14px 28px;
            font-size: 1.1rem;
        }
        
        /* Ajustes para footer */
        footer .col-lg-4, 
        footer .col-lg-3, 
        footer .col-lg-2 {
            margin-bottom: 2.5rem;
        }
        
        footer .text-md-start, 
        footer .text-md-end {
            text-align: center !important;
        }
        
        .social-icons a {
            width: 44px;
            height: 44px;
            margin-right: 0.75rem;
        }
        
        .app-badges img {
            height: 45px !important;
        }
        
        /* Ajustes generales */
        .fullpage-section {
            padding: 60px 0;
        }
        
        .section-title .lead {
            font-size: 1.1rem;
            padding: 0 15px;
        }
        
        .container, .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        /* Hardware cards */
        .hardware-card {
            padding: 1.75rem 0.75rem;
        }
        
        .card-icon {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        /* Botón subir */
        #backToTop {
            width: 56px;
            height: 56px;
            font-size: 24px;
        }
    }
    
    /* Dispositivos muy pequeños (menos de 400px) - MEJORADO */
    @media (max-width: 400px) {
        #header .h1-large {
            font-size: 2rem;
        }
        
        #navbar .navbar-brand img {
            height: 40px;
        }
        
        .btn-solid-lg {
            padding: 12px 24px;
            font-size: 1rem;
        }
        
        .section-title h2 {
            font-size: 1.9rem;
        }
        
        .section-title .lead {
            font-size: 1rem;
        }
        
        /* Ajustes para tarjetas de hardware */
        .hardware-card {
            padding: 1.5rem 0.5rem;
        }
        
        /* Asegurar que las tarjetas no sean demasiado estrechas */
        .col-md-4, .col-md-6 {
            padding-left: 8px;
            padding-right: 8px;
        }
        
        /* Ajustes para formulario de contacto */
        .contact-form .form-control {
            padding: 12px 12px;
        }
    }
    
    /* Ajustes específicos para pantallas muy pequeñas en modo horizontal */
    @media (max-height: 500px) and (orientation: landscape) {
        .fullpage-section {
            min-height: auto;
            padding: 60px 0;
        }
        
        #navbar .navbar-brand img {
            height: 35px !important;
        }
    }
    </style>
</head>
<body>
    
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top py-2">
    <div class="container">
        <a class="navbar-brand" href="#header">
            <img src="assets/images/pro.png" alt="RackON Logo" 
                 class="img-fluid" 
                 style="height: 50px; width: auto; max-width: 150px; transition: all 0.3s ease;">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link active px-2 px-lg-3 py-2" href="#header" style="font-size: 1.1rem;">Inicio</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2 px-lg-3 py-2" href="#" id="productoDropdown" 
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                        Producto
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="productoDropdown">
                        <li><h6 class="dropdown-header">Sobre RackON</h6></li>
                        <li><a class="dropdown-item py-2" href="#introduction">
                            <i class="fas fa-question-circle me-2"></i>¿Qué es RackON?
                        </a></li>
                        <li><a class="dropdown-item py-2" href="#funcionamiento">
                            <i class="fas fa-cogs me-2"></i>¿Cómo funciona?
                        </a></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <li><h6 class="dropdown-header">Componentes</h6></li>
                        <li><a class="dropdown-item py-2" href="#hardware">
                            <i class="fas fa-microchip me-2"></i>Hardware
                        </a></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <li><a class="dropdown-item py-2" href="#adquirir">
                            <i class="fas fa-tags me-2"></i>Adquirir RackON
                        </a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link px-2 px-lg-3 py-2" href="#contact" style="font-size: 1.1rem;">Contacto</a>
                </li>
                
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-light px-3 py-2" href="login" style="font-size: 1.1rem;">
                        <i class="fas fa-sign-in-alt me-2"></i>Acceder
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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

    <section id="funcionamiento" class="fullpage-section">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100 align-items-stretch">
                <div class="col-lg-6 order-lg-1 order-2 image-column">
                    <div class="h-100 w-100 overflow-hidden">
                        <img src="assets/images/rack.png" 
                             alt="Tecnología RackON en acción"
                             class="img-fluid w-100 h-100 object-fit-cover">
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3);">
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 order-lg-2 order-1 d-flex align-items-center content-column">
                    <div class="px-4 px-md-5 py-lg-0 py-4">
                        <h2 class="mb-4 text-primary">¿Cómo funciona RackON?</h2>
                        <p class="lead mb-4">
                            El sistema RackON combina tecnología de identificación, sensores físicos y vigilancia electrónica para ofrecer una solución de seguridad en capas. Su funcionamiento se basa en tres niveles que actúan de forma secuencial y complementaria:
                        </p>
                        
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

<section id="adquirir" class="fullpage-section">
    <div class="container">
        <div class="section-title mb-5">
            <h2>Adquirir RackON</h2>
            <p class="lead">Un solo paquete, protección total. Obtenga su dispositivo personalizado RackON y elija el plan de soporte que mejor se adapte a su empresa.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card p-4 shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-4">Paquete RackON Personalizado</h3>
                        <p class="lead">Nuestro sistema incluye las 3 capas de seguridad (RFID, Cámara, Sensor de Vibración) para una protección integral.</p>
                        <p class="fs-4 fw-bold text-primary mb-4">Dispositivo RackON: $229 USD (Pago Único)</p>
                        
                        <h5 class="mt-5 mb-3">Soporte Técnico (Planes de Suscripción)</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-primary">
                                    <div class="card-body">
                                        <h6 class="card-title">Soporte Mensual</h6>
                                        <p class="mb-0 fs-5">$25 USD/mes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-success">
                                    <div class="card-body">
                                        <h6 class="card-title">Soporte Anual</h6>
                                        <p class="mb-0 fs-5">$250 USD/año</p>
                                        <small class="text-muted">¡Ahorra $50 USD al año!</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="mt-4">Para iniciar la compra y configurar su cuenta empresarial, por favor, complete el siguiente formulario:</p>
                        <button class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#companyRegistrationModal">
                            <i class="fas fa-building me-2"></i> Registrar Empresa y Comprar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://www.paypal.com/sdk/js?client-id=AXn6zeaT-kutunjZDVGKpbDSQ6WCCPgvHvsdaVYjrQvy4udAukapA5ISWF9QIR268HG_K-eDjk8ETcYs&currency=USD"></script>

<div class="modal fade" id="companyRegistrationModal" tabindex="-1" aria-labelledby="companyRegistrationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="companyRegistrationModalLabel">Registro de Empresa para RackON</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="companyRegistrationForm">
          <div class="mb-3">
            <label for="companyName" class="form-label">Nombre de la Empresa</label>
            <input type="text" class="form-control" id="companyName" required>
          </div>
          <div class="mb-3">
            <label for="contactPerson" class="form-label">Persona de Contacto</label>
            <input type="text" class="form-control" id="contactPerson" required>
          </div>
          <div class="mb-3">
            <label for="companyEmail" class="form-label">Email Corporativo</label>
            <input type="email" class="form-control" id="companyEmail" required>
          </div>
          <div class="mb-3">
            <label for="companyCuit" class="form-label">CUIT/Tax ID</label>
            <input type="text" class="form-control" id="companyCuit" required>
          </div>
          <div class="mb-3">
            <label for="companyPhone" class="form-label">Número de Teléfono</label>
            <input type="tel" class="form-control" id="companyPhone" required>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Continuar a la Compra</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="purchaseModalLabel">Completa tu Compra de RackON</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold mb-3">Detalles de tu Plan Personalizado RackON:</p>
        
        <h6 class="mt-4 mb-2">Dispositivo RackON (Pago Único)</h6>
        <p class="fs-4 fw-bold text-primary">$229 USD</p>
        <div id="paypal-button-device" class="mb-4"></div>

        <h6 class="mt-5 mb-2">Soporte Técnico Mensual</h6>
        <p class="fs-5">$25 USD/mes</p>
        <div id="paypal-button-monthly-support" class="mb-4"></div>

        <h6 class="mt-5 mb-2">Soporte Técnico Anual</h6>
        <p class="fs-5">$250 USD/año <small class="text-muted">(Ahorra $50 USD)</small></p>
        <div id="paypal-button-annual-support"></div>

      </div>
    </div>
  </div>
</div>

    <section id="contact" class="fullpage-section">
    <div class="container">
        <div class="section-title text-white">
            <h2>Contáctenos</h2>
            <p class="lead">Complete el formulario y nos pondremos en contacto con usted</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
            <form id="contactForm" class="contact-form" action="https://formsubmit.co/rackonoficial@gmail.com" method="POST">
                <input type="hidden" name="_captcha" value="false">
                <input type="hidden" name="_template" value="box">
                <input type="text" name="_honey" style="display:none">
                <textarea name="_blacklist" style="display:none"></textarea> <div class="row">
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
<div class="modal fade" id="thanksModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <i class="fas fa-check-circle text-success mb-4" style="font-size: 3rem;"></i>
                <h3>¡Gracias por contactarnos!</h3>
                <p class="mb-4">Tu mensaje ha sido enviado correctamente. Nos pondremos en contacto pronto.</p>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand mb-3">
                        <img src="assets/images/pro.png" alt="RackON Logo" style="height: 45px;">
                    </div>
                    <p class="small">Sistema de seguridad en capas para racks de servidores que combina RFID, sensores y cámaras para protección física de infraestructura crítica.</p>

                </div>

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

                <div class="col-lg-3 col-md-6">
                    <h6 class="text-uppercase text-primary mb-3">Síguenos</h6>
                    <div class="social-icons d-flex mb-3">
                        <a href="#" class="btn btn-outline-light rounded-circle me-2" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-circle me-2" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-circle me-2" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-circle" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <h6 class="text-uppercase text-primary mb-2">Descarga nuestra app</h6>
                    <div class="app-badges">
                        <a href="#" class="d-inline-block me-2 mb-2">
                            <img src="assets/images/playstore.png" alt="Google Play" style="height: 45px;">
                        </a>
                        <a href="#" class="d-inline-block mb-2">
                            <img src="assets/images/app.png" alt="App Store" style="height: 45px;">
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-secondary">

            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="small mb-0">&copy; <script>document.write(new Date().getFullYear())</script> RackON. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <button id="backToTop" class="btn btn-primary">
        <i class="fas fa-arrow-up"></i>
    </button>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "RackON",
  "description": "Sistema de seguridad inteligente para racks de servidores",
  "brand": {
    "@type": "Brand",
    "name": "RackON"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "USD", // Changed to USD
    "price": "229.00",      // Updated device price
    "availability": "https://schema.org/InStock",
    "url": "https://rackon.tech/"
  }
}
</script>
    <script>
    // Versión con JavaScript puro (vanilla)
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Envía el formulario manualmente
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => {
        if (response.ok) {
            // Muestra el modal
            const modal = new bootstrap.Modal(document.getElementById('thanksModal'));
            modal.show();
            
            // Desplázate suavemente a #contact sin cambiar la URL
            document.querySelector('#contact').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
            
            // Resetea el formulario
            this.reset();
        }
    })
    .catch(error => console.error('Error:', error));
});
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
  // COMPANY REGISTRATION MODAL LOGIC
  document.getElementById('companyRegistrationForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Here, you would typically send this data to your backend
    // to create the company account. For this example, we'll just simulate success.
    
    const companyName = document.getElementById('companyName').value;
    const contactPerson = document.getElementById('contactPerson').value;
    const companyEmail = document.getElementById('companyEmail').value;
    const companyCuit = document.getElementById('companyCuit').value;
    const companyPhone = document.getElementById('companyPhone').value;

    console.log('Company Registration Data:', {
        companyName,
        contactPerson,
        companyEmail,
        companyCuit,
        companyPhone
    });

    // Close the company registration modal
    const companyRegistrationModal = bootstrap.Modal.getInstance(document.getElementById('companyRegistrationModal'));
    companyRegistrationModal.hide();

    // Open the purchase modal and render PayPal buttons
    const purchaseModal = new bootstrap.Modal(document.getElementById('purchaseModal'));
    purchaseModal.show();
    renderPayPalButtons(); // Call function to render PayPal buttons
  });

  function renderPayPalButtons() {
    // Clear existing buttons to prevent re-rendering issues
    document.getElementById('paypal-button-device').innerHTML = '';
    document.getElementById('paypal-button-monthly-support').innerHTML = '';
    document.getElementById('paypal-button-annual-support').innerHTML = '';

    // Device Purchase Button
    paypal.Buttons({
      createOrder: (data, actions) => actions.order.create({
        purchase_units: [{
          description: 'Dispositivo RackON Personalizado',
          amount: {
            value: '229.00' // Device price
          }
        }]
      }),
      onApprove: (data, actions) => actions.order.capture().then(detalles => {
        alert('Compra del Dispositivo completada: ' + detalles.payer.name.given_name);
        // Here you would typically update your backend about the device purchase
      }),
      onError: (err) => {
        console.error('Error en el pago del dispositivo:', err);
        alert('Hubo un error con el pago del dispositivo. Por favor, inténtelo de nuevo.');
      }
    }).render('#paypal-button-device');

    // Monthly Support Subscription Button
    paypal.Buttons({
      createSubscription: (data, actions) => {
        return actions.subscription.create({
          plan_id: 'P-XXXXXXXXXXXXXX', // Replace with your actual PayPal plan ID for monthly support
          // You would need to create this plan in your PayPal developer dashboard
          // Example: plan_id: 'P-1234567890ABCDEF'
        });
      },
      onApprove: (data, actions) => {
        alert('Suscripción mensual activada: ' + data.subscriptionID);
        // Here you would typically update your backend about the monthly subscription
      },
      onError: (err) => {
        console.error('Error en la suscripción mensual:', err);
        alert('Hubo un error con la suscripción mensual. Por favor, inténtelo de nuevo.');
      }
    }).render('#paypal-button-monthly-support');

    // Annual Support Subscription Button
    paypal.Buttons({
      createSubscription: (data, actions) => {
        return actions.subscription.create({
          plan_id: 'P-YYYYYYYYYYYYYY', // Replace with your actual PayPal plan ID for annual support
          // Example: plan_id: 'P-FEDCBA0987654321'
        });
      },
      onApprove: (data, actions) => {
        alert('Suscripción anual activada: ' + data.subscriptionID);
        // Here you would typically update your backend about the annual subscription
      },
      onError: (err) => {
        console.error('Error en la suscripción anual:', err);
        alert('Hubo un error con la suscripción anual. Por favor, inténtelo de nuevo.');
      }
    }).render('#paypal-button-annual-support');
  }

  // To trigger the first modal from the "Adquirir RackON" section
  document.querySelector('#adquirir .btn-primary').addEventListener('click', function() {
    const companyRegistrationModal = new bootstrap.Modal(document.getElementById('companyRegistrationModal'));
    companyRegistrationModal.show();
  });
</script>
</body>
</html>