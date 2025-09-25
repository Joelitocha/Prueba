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
    <meta property="og:image" content="assets/images/RackON.jpg"> 
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

    /* SECCIÓN PLANES */
    #planes {
        background-color: var(--light-color);
        padding-top: 80px;
        padding-bottom: 80px;
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
        
        .plan-card {
            margin-bottom: 1.5rem;
        }
        
        .plan-card .card-body {
            padding: 1.5rem;
        }
        
        .ver-mas, .ver-menos {
            font-size: 1rem;
            padding: 0.5rem 0;
            display: block;
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
            <img src="assets/images/RackON.jpg" alt="RackON Logo" 
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
                        
                        <li><a class="dropdown-item py-2" href="#planes">
                            <i class="fas fa-tags me-2"></i>Planes y Precios
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
                <strong>RackON</strong> es un sistema inteligente de control de acceso físico diseñado para racks de servidores. Combina tecnologías como RFID, sensores de vibración y cámaras de vigilancia para ofrecer una solución de seguridad robusta y en capas.
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
                    <img src="assets/images/rack.png" alt="Tecnología RackON en acción" class="img-fluid w-100 h-100 object-fit-cover">
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
                            <i class="fas fa-database text-primary me-2"></i> <strong>Registro completo:</strong> Todos los eventos —accesos válidos, intentos fallidos, impactos detectados y grabaciones— quedan registrados en una base de datos segura. La información puede ser consultada desde la plataforma web de RackON, donde administradores y supervisores pueden acceder al historial completo, recibir alertas en tiempo real y analizar el comportamiento del sistema para reforzar la seguridad.
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

<section id="planes" class="fullpage-section">
    <div class="container">
        <div class="section-title">
            <h2>Personaliza tu Sistema RackON</h2>
            <p class="lead">Crea tu plan RackON ideal con nuestras opciones de personalización.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 mb-4 d-flex align-items-stretch">
                <div class="card plan-card w-100">
                    <div class="card-body d-flex flex-column text-center">
                        <h4 class="card-title text-primary">Sistema RackON Personalizado</h4>
                        <h3 class="mb-4">Desde 229 USD<span class="fs-6">/unidad (pago único)</span></h3>
                        <p class="mb-4">
                            Diseña tu RackON a medida. Elige las capas de seguridad, el tipo de soporte técnico, opciones estéticas y la cantidad de dispositivos. El precio final se ajustará a tu selección.
                        </p>
                        <button class="btn btn-primary mt-auto btn-compra" data-bs-toggle="modal" data-bs-target="#companyRegistrationModal">
                            Personalizar y Comprar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="fullpage-section">
    <div class="container">
        <div class="section-title text-white">
            <h2>Contáctenos</h2>
            <p class="lead">Complete el formulario y nos pondremos en contacto con usted</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form id="contactForm" class="contact-form" action="https://formsubmit.co/rackonoficial@gmail.com" method="POST">
                    <!-- Configuración avanzada -->
                    <input type="hidden" name="_captcha" value="false">
                    <input type="hidden" name="_template" value="table"> <!-- Más organizado -->
                    <input type="hidden" name="_subject" value="Nuevo contacto desde RackON"> <!-- Asunto personalizado -->
                    <input type="hidden" name="_autoresponse" value="Gracias por contactarnos. Hemos recibido tu mensaje y te responderemos pronto."> <!-- Autorespuesta -->
                    <input type="text" name="_honey" style="display:none"> <!-- Trampa para bots -->
                    
                    <!-- Campos del formulario -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="asunto" class="form-control" placeholder="Asunto" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
                    </div>
                    
                    <!-- Feedback para el usuario -->
                    <div id="formFeedback" class="alert d-none mb-3"></div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn-solid-lg">
                            <span id="submitText">Enviar Mensaje</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript para manejar el envío -->
<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const feedback = document.getElementById('formFeedback');
    const spinner = document.getElementById('submitSpinner');
    const submitText = document.getElementById('submitText');
    
    // Mostrar spinner
    spinner.classList.remove('d-none');
    submitText.textContent = 'Enviando...';
    submitBtn.disabled = true;
    
    // Enviar formulario
    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            feedback.textContent = '¡Mensaje enviado con éxito!';
            feedback.classList.remove('alert-danger', 'd-none');
            feedback.classList.add('alert-success');
            form.reset();
        } else {
            throw new Error('Error en el envío');
        }
    })
    .catch(error => {
        feedback.textContent = 'Error al enviar. Por favor, inténtalo de nuevo.';
        feedback.classList.remove('alert-success', 'd-none');
        feedback.classList.add('alert-danger');
    })
    .finally(() => {
        spinner.classList.add('d-none');
        submitText.textContent = 'Enviar Mensaje';
        submitBtn.disabled = false;
    });
});
</script>

<footer class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 style="color: white;">Sobre RackON</h5>
                <p>Ofrecemos soluciones innovadoras para la seguridad física de racks de servidores, utilizando tecnología de punta para proteger tus activos.</p>
            </div>
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 style="color: white;">Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="#header">Inicio</a></li>
                    <li><a href="#introduction">¿Qué es?</a></li>
                    <li><a href="#funcionamiento">Cómo Funciona</a></li>
                    <li><a href="#hardware">Hardware</a></li>
                    <li><a href="#planes">Planes</a></li>
                    <li><a href="#contact">Contacto</a></li>
                </ul>
            </div>
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 style="color: white;">Síguenos</h5>
                <div class="social-icons mb-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <h5 style="color: white;">Descarga la App</h5>
                <div class="app-badges">
                    <a href="#"><img src="assets/images/app.png" alt="App Store" class="img-fluid me-2" style="height: 40px;">App Store</a>
                    <a href="#"><img src="assets/images/playstore.png" alt="Google Play" class="img-fluid" style="height: 40px;">Google Play</a>
                </div>
            </div>
            <div class="col-lg-2">
                <h5 style="color: white;">Contacto</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt me-2"></i>Río Tercero, Córdoba, Argentina</li>
                    <li><i class="fas fa-envelope me-2"></i>info@rackon.tech</li>
                    <li><i class="fas fa-phone me-2"></i>+54 9 3571 XXXXXX</li>
                </ul>
            </div>
        </div>
        <hr class="mt-4 mb-3">
        <div class="row">
            <div class="col-12 text-center text-md-start">
                <p class="mb-0 text-muted">&copy; 2025 RackON. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<button id="backToTop" class="btn btn-primary" title="Volver arriba">
    <i class="fas fa-arrow-up"></i>
</button>

    <!-- Modales -->
    <div class="modal fade" id="companyRegistrationModal" tabindex="-1" aria-labelledby="companyRegistrationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="companyRegistrationModalLabel">Registro de Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="companyRegistrationForm">
                        <div class="mb-3">
                            <label for="companyName" class="form-label">Nombre de la Empresa</label>
                            <input type="text" class="form-control" id="companyName" required>
                        </div>
                        <div class="mb-3">
                            <label for="companyTaxId" class="form-label">CUIT/ID Fiscal</label>
                            <input type="text" class="form-control" id="companyTaxId" required>
                        </div>
                        <div class="mb-3">
                            <label for="companyContactPerson" class="form-label">Persona de Contacto</label>
                            <input type="text" class="form-control" id="companyContactPerson" required>
                        </div>
                        <div class="mb-3">
                            <label for="companyContactEmail" class="form-label">Email de Contacto</label>
                            <input type="email" class="form-control" id="companyContactEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="companyContactPhone" class="form-label">Teléfono de Contacto</label>
                            <input type="tel" class="form-control" id="companyContactPhone" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Continuar a la Compra</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseModalLabel">Realizar Pedido RackON</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="purchaseForm">
                        <!-- Campos ocultos para el envío del correo -->
                        <input type="hidden" name="_captcha" value="false">
                        <input type="hidden" name="_template" value="table">
                        <input type="text" name="_honey" style="display:none">
                        
                        <div class="form-step" id="step-personal">
                            <h6 class="mb-3">1. Información de la Empresa <i class="fas fa-info-circle text-primary"></i></h6>
                            <div class="mb-3">
                                <label class="form-label">Nombre:</label>
                                <p id="displayCompanyName" class="form-control-plaintext"></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">CUIT/ID Fiscal:</label>
                                <p id="displayCompanyTaxId" class="form-control-plaintext"></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contacto:</label>
                                <p id="displayCompanyContactPerson" class="form-control-plaintext"></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <p id="displayCompanyContactEmail" class="form-control-plaintext"></p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teléfono:</label>
                                <p id="displayCompanyContactPhone" class="form-control-plaintext"></p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>
                        </div>

                        <div class="form-step d-none" id="step-delivery">
                            <h6 class="mb-3">2. Dirección de Entrega <i class="fas fa-truck text-primary"></i></h6>
                            <div class="mb-3">
                                <label for="deliveryAddress" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="deliveryAddress" name="direccion" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="deliveryCity" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="deliveryCity" name="ciudad" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="deliveryState" class="form-label">Provincia/Estado</label>
                                    <input type="text" class="form-control" id="deliveryState" name="provincia" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="deliveryZip" class="form-label">Código Postal</label>
                                    <input type="text" class="form-control" id="deliveryZip" name="codigo_postal" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="deliveryCountry" class="form-label">País</label>
                                    <input type="text" class="form-control" id="deliveryCountry" name="pais" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-primary next-step">Siguiente</button>
                            </div>
                        </div>

                        <div class="form-step d-none" id="step-customization">
                            <h6 class="mb-3">3. Personaliza tu Pedido <i class="fas fa-puzzle-piece text-primary"></i></h6>
                            
                            <div class="mb-4 p-3 border rounded bg-light">
                                <label for="deviceQuantity" class="form-label fw-bold">Cantidad de Dispositivos</label>
                                <input type="number" class="form-control" id="deviceQuantity" value="1" min="1" required>
                                <small class="form-text text-muted">Descuentos por volumen: 1 unidad ($229), 2-4 ($219/u), 5+ ($199/u)</small>
                            </div>

                            <div class="mb-4 p-3 border rounded bg-light">
                                <label class="form-label fw-bold">Capas de Seguridad</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="rfid" id="securityLayer1" checked disabled>
                                    <label class="form-check-label" for="securityLayer1">
                                        Capa 1: Control RFID (Incluido)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="checkbox" value="camera" id="securityLayer2" data-price="30">
                                    <label class="form-check-label" for="securityLayer2">
                                        Capa 2: Verificación por cámara (+ 30 USD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="checkbox" value="sensor" id="securityLayer3" data-price="20">
                                    <label class="form-check-label" for="securityLayer3">
                                        Capa 3: Sensor de impacto/vibración (+ 20 USD)
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded bg-light">
                                <label class="form-label fw-bold">Soporte Técnico</label>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="radio" name="techSupport" id="supportBasic" value="basic" checked>
                                    <label class="form-check-label" for="supportBasic">
                                        Básico (Incluido)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="radio" name="techSupport" id="supportPremium" value="premium" data-price-monthly="10" data-price-annual="100">
                                    <label class="form-check-label" for="supportPremium">
                                        Premium (+10 USD/mes o +100 USD/año)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="radio" name="techSupport" id="supportUltra" value="ultra" data-price-monthly="20" data-price-annual="200">
                                    <label class="form-check-label" for="supportUltra">
                                        Ultra (+20 USD/mes o +200 USD/año)
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded bg-light">
                                <label class="form-label fw-bold">Personalización Estética del Dispositivo</label>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="checkbox" value="laser" id="aestheticLaser" data-price="15">
                                    <label class="form-check-label" for="aestheticLaser">
                                        Grabado láser con logo de la empresa (+ 15 USD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="checkbox" value="colors" id="aestheticColors" data-price="10">
                                    <label class="form-check-label" for="aestheticColors">
                                        Colores personalizados (+ 10 USD)
                                    </label>
                                </div>
                            </div>

                            <div class="mb-4 p-3 border rounded bg-light">
                                <label class="form-label fw-bold">Instalación Asistida</label>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="checkbox" value="guided" id="installGuided" data-price="50">
                                    <label class="form-check-label" for="installGuided">
                                        Envío con instalación guiada por videollamada (+ 50 USD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input customization-option" type="checkbox" value="manual" id="installManual" data-price="10">
                                    <label class="form-check-label" for="installManual">
                                        Manual físico personalizado (+ 10 USD)
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-primary next-step">Revisar Pedido</button>
                            </div>
                        </div>

                        <div class="form-step d-none" id="step-summary">
                            <h6 class="mb-3">4. Resumen del Pedido y Pago <i class="fas fa-file-invoice-dollar text-primary"></i></h6>
                            <div class="mb-3">
                                <p class="fw-bold">Detalle del Pedido:</p>
                                <ul id="orderSummaryList" class="list-group mb-3">
                                    <!-- Aquí se generará el resumen -->
                                </ul>
                                <h5 class="mt-4">Total a Pagar (Dispositivos y Opciones): <span id="finalDevicePrice" class="text-primary"></span></h5>
                                <h5 class="mt-2">Suscripción de Soporte (<span id="supportPlanType"></span>): <span id="finalSupportPrice" class="text-primary"></span></h5>
                            </div>
                            
                            <div class="alert alert-info mt-3">
                                <small>
                                    <i class="fas fa-info-circle"></i> 
                                    <strong>Importante:</strong> Una vez completados ambos pagos, se habilitará el botón para confirmar el pedido. 
                                    Se enviará un solo correo con todos los detalles tanto a tu email como al equipo de RackON.
                                </small>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                                <button type="button" class="btn btn-success" id="confirmPurchaseBtn" style="display: none;">
                                    <i class="fas fa-envelope"></i> Confirmar Pedido y Enviar Correo
                                </button>
                            </div>
                            <hr class="my-4">
                            <div class="text-center">
                                <h6>Pagar con PayPal</h6>
                                <p class="text-muted small">Haz clic en los botones de PayPal para completar tu pago. Se realizarán dos pagos separados: uno por los dispositivos y opciones, y otro por la suscripción de soporte.</p>
                                <div id="paypal-buttons-container">
                                    <!-- Aquí se renderizarán los botones de PayPal -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://www.paypal.com/sdk/js?client-id=AXn6zeaT-kutunjZDVGKpbDSQ6WCCPgvHvsdaVYjrQvy4udAukapA5ISWF9QIR268HG_K-eDjk8ETcYs&currency=USD&vault=true"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Configuración inicial
        const companyRegistrationModal = new bootstrap.Modal(document.getElementById('companyRegistrationModal'));
        const purchaseModal = new bootstrap.Modal(document.getElementById('purchaseModal'));
        const formSteps = document.querySelectorAll('.form-step');
        let currentStep = 0;
        let isProcessing = false;
        let devicePaymentCompleted = false;
        let supportPaymentCompleted = false;

        // 2. Datos de compra
        const selectedPlanData = {
            type: 'monthly' // monthly/annual
        };

        const purchaseCalculations = {
            deviceBasePrice: 229,
            quantity: 1,
            securityLayers: { rfid: true, camera: false, sensor: false },
            techSupport: 'basic',
            aestheticCustomization: { laser: false, colors: false },
            assistedInstallation: { guided: false, manual: false },
            currentDeviceTotal: 0,
            currentSupportMonthlyTotal: 25,
            currentSupportAnnualTotal: 250
        };

        const PRICES = {
            securityLayer2: 30,
            securityLayer3: 20,
            supportPremiumMonthly: 10,
            supportPremiumAnnual: 100,
            supportUltraMonthly: 20,
            supportUltraAnnual: 200,
            aestheticLaser: 15,
            aestheticColors: 10,
            installGuided: 50,
            installManual: 10,
            quantityDiscounts: {
                '1': 229,
                '2-4': 219,
                '5+': 199
            }
        };

        // 3. Inicialización
        initEventListeners();
        updatePurchaseSummary();

        function initEventListeners() {
            // Botón "Personalizar y Comprar"
            document.querySelector('.btn-compra').addEventListener('click', () => {
                companyRegistrationModal.show();
            });

            // Formulario de registro de empresa
            document.getElementById('companyRegistrationForm').addEventListener('submit', function(e) {
                e.preventDefault();
                transferCompanyData();
                companyRegistrationModal.hide();
                purchaseModal.show();
                showStep(0);
            });

            // Navegación entre pasos
            document.getElementById('purchaseForm').addEventListener('click', function(e) {
                if (e.target.classList.contains('next-step')) {
                    handleNextStep();
                } else if (e.target.classList.contains('prev-step')) {
                    handlePrevStep();
                }
            });

            // Cantidad de dispositivos
            document.getElementById('deviceQuantity').addEventListener('change', function() {
                purchaseCalculations.quantity = parseInt(this.value);
                updatePurchaseSummary();
                renderPayPalButtons();
            });

            // Opciones de personalización
            document.querySelectorAll('.customization-option').forEach(input => {
                input.addEventListener('change', function() {
                    updateCustomization(this.id, this.value, this.checked);
                    updatePurchaseSummary();
                    renderPayPalButtons();
                });
            });

            // Botón de confirmación final
            document.getElementById('confirmPurchaseBtn').addEventListener('click', handleFinalConfirmation);
        }

        // 4. Funciones principales
        function transferCompanyData() {
            const fields = [
                ['displayCompanyName', 'companyName'],
                ['displayCompanyTaxId', 'companyTaxId'],
                ['displayCompanyContactPerson', 'companyContactPerson'],
                ['displayCompanyContactEmail', 'companyContactEmail'],
                ['displayCompanyContactPhone', 'companyContactPhone']
            ];

            fields.forEach(([displayId, inputId]) => {
                document.getElementById(displayId).textContent = document.getElementById(inputId).value;
            });
        }

        function handleNextStep() {
            if (validateStep(currentStep)) {
                if (currentStep < formSteps.length - 1) {
                    showStep(currentStep + 1);
                    if (currentStep === formSteps.length - 1) {
                        updatePurchaseSummary();
                        renderPayPalButtons();
                    }
                }
            } else {
                alert('Por favor, completa todos los campos requeridos.');
            }
        }

        function handlePrevStep() {
            if (currentStep > 0) {
                showStep(currentStep - 1);
            }
        }

        function showStep(stepIndex) {
            formSteps.forEach((step, index) => {
                step.classList.toggle('d-none', index !== stepIndex);
            });
            currentStep = stepIndex;
        }

        function validateStep(stepIndex) {
            let isValid = true;
            if (stepIndex === 1) {
                document.querySelectorAll('#step-delivery input[required]').forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
            }
            return isValid;
        }

        function updateCustomization(id, value, isChecked) {
            if (id.startsWith('securityLayer')) {
                purchaseCalculations.securityLayers[value] = isChecked;
            } else if (id.startsWith('support')) {
                purchaseCalculations.techSupport = value;
            } else if (id.startsWith('aesthetic')) {
                purchaseCalculations.aestheticCustomization[value] = isChecked;
            } else if (id.startsWith('install')) {
                purchaseCalculations.assistedInstallation[value] = isChecked;
            }
        }

        // 5. Funciones de PayPal mejoradas
        function renderPayPalButtons() {
            const container = document.getElementById('paypal-buttons-container');
            if (!container) return;
            
            container.innerHTML = '';

            // 1. Pago de dispositivos
            const deviceContainer = document.createElement('div');
            deviceContainer.className = 'mb-4 p-3 border rounded';
            container.appendChild(deviceContainer);

            const deviceTitle = document.createElement('h5');
            deviceTitle.className = 'mb-3';
            deviceTitle.textContent = '1. Pago de Dispositivos';
            deviceContainer.appendChild(deviceTitle);

            if (purchaseCalculations.quantity > 0 && purchaseCalculations.currentDeviceTotal > 0) {
                const deviceButtonDiv = document.createElement('div');
                deviceButtonDiv.id = 'paypal-device-button';
                deviceContainer.appendChild(deviceButtonDiv);

                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: purchaseCalculations.currentDeviceTotal.toFixed(2),
                                    currency_code: 'USD'
                                },
                                description: 'Dispositivos RackON y personalización'
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            devicePaymentCompleted = true;
                            showPaymentSuccess('dispositivos', details.payer.name.given_name);
                            checkPaymentsCompletion();
                        });
                    },
                    onError: function(err) {
                        console.error('Error en pago de dispositivos:', err);
                        showPaymentError('dispositivos');
                    }
                }).render('#paypal-device-button');
            } else {
                deviceContainer.innerHTML += '<p class="text-muted">No hay dispositivos para pagar</p>';
            }

            // 2. Pago de soporte técnico
            const supportContainer = document.createElement('div');
            supportContainer.className = 'mb-4 p-3 border rounded';
            container.appendChild(supportContainer);

            const supportTitle = document.createElement('h5');
            supportTitle.className = 'mb-3';
            supportTitle.textContent = '2. Soporte Técnico';
            supportContainer.appendChild(supportTitle);

            // Selector de tipo de soporte
            const supportOptions = document.createElement('div');
            supportOptions.className = 'mb-3';
            supportOptions.innerHTML = `
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="supportType" id="supportMonthly" 
                        value="monthly" ${selectedPlanData.type === 'monthly' ? 'checked' : ''}>
                    <label class="form-check-label" for="supportMonthly">
                        Pago Mensual (${purchaseCalculations.currentSupportMonthlyTotal.toFixed(2)} USD/mes)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="supportType" id="supportAnnual" 
                        value="annual" ${selectedPlanData.type === 'annual' ? 'checked' : ''}>
                    <label class="form-check-label" for="supportAnnual">
                        Pago Anual (${purchaseCalculations.currentSupportAnnualTotal.toFixed(2)} USD/año) - Ahorra 10%
                    </label>
                </div>
            `;
            supportContainer.appendChild(supportOptions);

            // Botón para soporte
            const supportButtonDiv = document.createElement('div');
            supportButtonDiv.id = 'paypal-support-button';
            supportContainer.appendChild(supportButtonDiv);

            // Event listeners para los radios
            document.getElementById('supportMonthly')?.addEventListener('change', () => {
                selectedPlanData.type = 'monthly';
                updatePurchaseSummary();
                renderPayPalSupportButton();
            });
            document.getElementById('supportAnnual')?.addEventListener('change', () => {
                selectedPlanData.type = 'annual';
                updatePurchaseSummary();
                renderPayPalSupportButton();
            });

            renderPayPalSupportButton();

            // Ocultar botón de confirmación inicialmente
            document.getElementById('confirmPurchaseBtn').classList.add('d-none');
        }

        function renderPayPalSupportButton() {
            const supportButtonDiv = document.getElementById('paypal-support-button');
            if (!supportButtonDiv) return;
            
            supportButtonDiv.innerHTML = '';

            const amount = selectedPlanData.type === 'monthly'
                ? purchaseCalculations.currentSupportMonthlyTotal
                : purchaseCalculations.currentSupportAnnualTotal;
            
            const description = selectedPlanData.type === 'monthly'
                ? 'Soporte Técnico Mensual RackON'
                : 'Soporte Técnico Anual RackON';

            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: amount.toFixed(2),
                                currency_code: 'USD'
                            },
                            description: description
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        supportPaymentCompleted = true;
                        showPaymentSuccess('soporte técnico', details.payer.name.given_name);
                        checkPaymentsCompletion();
                    });
                },
                onError: function(err) {
                    console.error('Error en pago de soporte:', err);
                    showPaymentError('soporte técnico');
                }
            }).render('#paypal-support-button');
        }

        function checkPaymentsCompletion() {
            const confirmBtn = document.getElementById('confirmPurchaseBtn');
            
            // Verificar si ambos pagos están completos o si no hay dispositivos para pagar
            const devicePaymentNotRequired = purchaseCalculations.quantity === 0 || purchaseCalculations.currentDeviceTotal === 0;
            const allPaymentsCompleted = (devicePaymentCompleted || devicePaymentNotRequired) && supportPaymentCompleted;
            
            if (allPaymentsCompleted) {
                confirmBtn.classList.remove('d-none');
                confirmBtn.innerHTML = '<i class="fas fa-envelope"></i> Confirmar Pedido y Enviar Correo';
            } else {
                confirmBtn.classList.add('d-none');
            }
        }

        // 6. Confirmación final del pedido - VERSIÓN MEJORADA
        async function handleFinalConfirmation() {
            if (isProcessing) return;
            
            const btn = document.getElementById('confirmPurchaseBtn');
            const originalText = btn.innerHTML;
            
            try {
                isProcessing = true;
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Procesando...';

                // Limpiar feedback anterior
                const oldFeedback = document.querySelector('.purchase-feedback');
                if (oldFeedback) oldFeedback.remove();

                // Crear nuevo feedback
                const feedback = document.createElement('div');
                feedback.className = 'alert alert-info purchase-feedback mt-3';
                feedback.textContent = 'Confirmando tu pedido y enviando confirmación...';
                btn.parentNode.insertBefore(feedback, btn.nextSibling);

                // Preparar y enviar datos de confirmación COMPLETOS
                const formData = prepareCompleteConfirmationData();
                const response = await sendCompleteConfirmation(formData);

                if (!response.ok) throw new Error('Error en el servidor');

                // Éxito
                feedback.textContent = '¡Pedido confirmado con éxito! Se ha enviado un correo de confirmación a tu email y al equipo de RackON.';
                feedback.className = 'alert alert-success purchase-feedback mt-3';

                // Resetear después de 3 segundos
                setTimeout(() => {
                    purchaseModal.hide();
                    resetForms();
                    resetPaymentStatus();
                }, 3000);

            } catch (error) {
                console.error('Error en la confirmación:', error);
                const feedback = document.querySelector('.purchase-feedback');
                if (feedback) {
                    feedback.textContent = 'Error al confirmar el pedido. Por favor, contacta a soporte.';
                    feedback.className = 'alert alert-danger purchase-feedback mt-3';
                }
            } finally {
                const btn = document.getElementById('confirmPurchaseBtn');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
                isProcessing = false;
            }
        }

        // Nueva función para preparar todos los datos del pedido
        function prepareCompleteConfirmationData() {
            const companyName = document.getElementById('companyName').value;
            const companyEmail = document.getElementById('companyContactEmail').value;
            
            const formData = new FormData();
            
            // Configuración para FormSubmit
            formData.append('_captcha', 'false');
            formData.append('_template', 'table');
            formData.append('_autoresponse', generateAutoResponse());
            formData.append('_subject', `✅ Confirmación de Pedido RackON - ${companyName}`);
            
            // Enviar copia al cliente y a rackonoficial@gmail.com
            formData.append('_cc', companyEmail);
            
            // DATOS DE LA EMPRESA
            formData.append('🏢 EMPRESA', companyName);
            formData.append('📧 EMAIL CONTACTO', companyEmail);
            formData.append('📞 TELÉFONO', document.getElementById('companyContactPhone').value);
            formData.append('🔢 CUIT/ID FISCAL', document.getElementById('companyTaxId').value);
            formData.append('👤 PERSONA DE CONTACTO', document.getElementById('companyContactPerson').value);
            
            // DATOS DE ENVÍO
            formData.append('📍 DIRECCIÓN', document.getElementById('deliveryAddress').value);
            formData.append('🏙️ CIUDAD', document.getElementById('deliveryCity').value);
            formData.append('🗺️ PROVINCIA', document.getElementById('deliveryState').value);
            formData.append('📮 CÓDIGO POSTAL', document.getElementById('deliveryZip').value);
            formData.append('🇦🇷 PAÍS', document.getElementById('deliveryCountry').value);
            
            // DETALLES DEL PEDIDO
            formData.append('📦 CANTIDAD DE DISPOSITIVOS', purchaseCalculations.quantity);
            formData.append('💰 PRECIO POR UNIDAD', `$${calculateDevicePrice().toFixed(2)} USD`);
            formData.append('💵 TOTAL DISPOSITIVOS', `$${purchaseCalculations.currentDeviceTotal.toFixed(2)} USD`);
            
            // OPCIONES SELECCIONADAS
            const options = getSelectedOptions();
            formData.append('⚙️ OPCIONES ADICIONALES', options.length > 0 ? options.join(', ') : 'Ninguna');
            
            // SOPORTE TÉCNICO
            const supportPlan = selectedPlanData.type === 'monthly' 
                ? `Mensual - $${purchaseCalculations.currentSupportMonthlyTotal.toFixed(2)} USD/mes`
                : `Anual - $${purchaseCalculations.currentSupportAnnualTotal.toFixed(2)} USD/año`;
            
            formData.append('🔧 PLAN DE SOPORTE', supportPlan);
            
            // RESUMEN FINAL
            const totalFinal = purchaseCalculations.currentDeviceTotal + 
                (selectedPlanData.type === 'monthly' 
                    ? purchaseCalculations.currentSupportMonthlyTotal 
                    : purchaseCalculations.currentSupportAnnualTotal);
            
            formData.append('🎯 TOTAL FINAL', `$${totalFinal.toFixed(2)} USD`);
            
            // ESTADO DE PAGOS
            formData.append('✅ ESTADO DE PAGOS', 'Ambos pagos completados exitosamente');
            formData.append('📅 FECHA DE PEDIDO', new Date().toLocaleString('es-ES'));
            
            return formData;
        }

        // Función para generar el mensaje de respuesta automática
        function generateAutoResponse() {
            const companyName = document.getElementById('companyName').value;
            const quantity = purchaseCalculations.quantity;
            const total = purchaseCalculations.currentDeviceTotal + 
                (selectedPlanData.type === 'monthly' 
                    ? purchaseCalculations.currentSupportMonthlyTotal 
                    : purchaseCalculations.currentSupportAnnualTotal);
            
            return `¡Gracias por tu pedido en RackON, ${companyName}!

Hemos recibido tu pedido de ${quantity} dispositivo(s) RackON por un total de $${total.toFixed(2)} USD.

📦 Tu pedido está siendo procesado y te contactaremos dentro de las próximas 24-48 horas para coordinar los detalles de envío.

📞 Para cualquier consulta, puedes contactarnos al correo rackonoficial@gmail.com

¡Gracias por confiar en RackON!`;
        }

        // Función para enviar la confirmación completa
        async function sendCompleteConfirmation(formData) {
            return await Promise.race([
                fetch('https://formsubmit.co/ajax/rackonoficial@gmail.com', {
                    method: 'POST',
                    body: formData,
                    headers: { 
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }),
                new Promise((_, reject) => setTimeout(() => reject(new Error('Timeout')), 30000))
            ]);
        }

        function showPaymentSuccess(type, userName) {
            alert(`¡Pago de ${type} completado con éxito! Gracias ${userName}.`);
        }

        function showPaymentError(type) {
            alert(`Hubo un error procesando el pago de ${type}. Por favor, inténtalo de nuevo.`);
        }

        function getSelectedOptions() {
            const options = [];
            if (purchaseCalculations.securityLayers.camera) options.push('Cámara de verificación');
            if (purchaseCalculations.securityLayers.sensor) options.push('Sensor de impacto');
            if (purchaseCalculations.aestheticCustomization.laser) options.push('Grabado láser');
            if (purchaseCalculations.aestheticCustomization.colors) options.push('Colores personalizados');
            if (purchaseCalculations.assistedInstallation.guided) options.push('Instalación guiada');
            if (purchaseCalculations.assistedInstallation.manual) options.push('Manual físico');
            return options;
        }

        function resetForms() {
            document.getElementById('companyRegistrationForm').reset();
            document.getElementById('purchaseForm').reset();
            document.querySelector('.purchase-feedback')?.remove();
            document.getElementById('confirmPurchaseBtn').classList.add('d-none');
        }

        // 8. Funciones de resumen de compra
        function updatePurchaseSummary() {
            const summaryList = document.getElementById('orderSummaryList');
            if (!summaryList) return;
            
            summaryList.innerHTML = '';

            // Calcular precio por dispositivo
            const devicePricePerUnit = calculateDevicePrice();
            purchaseCalculations.currentDeviceTotal = devicePricePerUnit * purchaseCalculations.quantity;

            // Calcular soporte
            calculateSupportPrices();

            // Construir resumen
            const summaryItems = [
                `<li class="list-group-item"><strong>Cantidad:</strong> ${purchaseCalculations.quantity} unidades</li>`,
                `<li class="list-group-item"><strong>Precio por unidad:</strong> ${devicePricePerUnit} USD</li>`
            ];

            // Agregar opciones adicionales
            addOptionalItems(summaryItems);

            // Mostrar resumen
            summaryList.innerHTML = summaryItems.join('');
            document.getElementById('finalDevicePrice').textContent = `${purchaseCalculations.currentDeviceTotal.toFixed(2)} USD`;
            
            const supportText = selectedPlanData.type === 'monthly'
                ? `${purchaseCalculations.currentSupportMonthlyTotal.toFixed(2)} USD/mes`
                : `${purchaseCalculations.currentSupportAnnualTotal.toFixed(2)} USD/año`;
            
            document.getElementById('finalSupportPrice').textContent = supportText;
            document.getElementById('supportPlanType').textContent = selectedPlanData.type === 'monthly' ? 'Mensual' : 'Anual';
        }

        function calculateDevicePrice() {
            if (purchaseCalculations.quantity >= 5) return PRICES.quantityDiscounts['5+'];
            if (purchaseCalculations.quantity >= 2) return PRICES.quantityDiscounts['2-4'];
            return PRICES.quantityDiscounts['1'];
        }

        function calculateSupportPrices() {
            let baseMonthly = 25; // Precio base mensual
            let baseAnnual = 250; // Precio base anual

            switch (purchaseCalculations.techSupport) {
                case 'premium':
                    baseMonthly += PRICES.supportPremiumMonthly;
                    baseAnnual += PRICES.supportPremiumAnnual;
                    break;
                case 'ultra':
                    baseMonthly += PRICES.supportUltraMonthly;
                    baseAnnual += PRICES.supportUltraAnnual;
                    break;
            }

            purchaseCalculations.currentSupportMonthlyTotal = baseMonthly;
            purchaseCalculations.currentSupportAnnualTotal = baseAnnual;
        }

        function addOptionalItems(summaryItems) {
            // Capas de seguridad
            if (purchaseCalculations.securityLayers.camera) {
                purchaseCalculations.currentDeviceTotal += PRICES.securityLayer2;
                summaryItems.push(`<li class="list-group-item">Cámara de verificación (+${PRICES.securityLayer2} USD)</li>`);
            }
            if (purchaseCalculations.securityLayers.sensor) {
                purchaseCalculations.currentDeviceTotal += PRICES.securityLayer3;
                summaryItems.push(`<li class="list-group-item">Sensor de impacto (+${PRICES.securityLayer3} USD)</li>`);
            }

            // Personalización estética
            if (purchaseCalculations.aestheticCustomization.laser) {
                purchaseCalculations.currentDeviceTotal += PRICES.aestheticLaser;
                summaryItems.push(`<li class="list-group-item">Grabado láser (+${PRICES.aestheticLaser} USD)</li>`);
            }
            if (purchaseCalculations.aestheticCustomization.colors) {
                purchaseCalculations.currentDeviceTotal += PRICES.aestheticColors;
                summaryItems.push(`<li class="list-group-item">Colores personalizados (+${PRICES.aestheticColors} USD)</li>`);
            }

            // Instalación
            if (purchaseCalculations.assistedInstallation.guided) {
                purchaseCalculations.currentDeviceTotal += PRICES.installGuided;
                summaryItems.push(`<li class="list-group-item">Instalación guiada (+${PRICES.installGuided} USD)</li>`);
            }
            if (purchaseCalculations.assistedInstallation.manual) {
                purchaseCalculations.currentDeviceTotal += PRICES.installManual;
                summaryItems.push(`<li class="list-group-item">Manual físico (+${PRICES.installManual} USD)</li>`);
            }

            // Soporte técnico
            let supportText = '';
            switch (purchaseCalculations.techSupport) {
                case 'basic':
                    supportText = 'Básico (incluido)';
                    break;
                case 'premium':
                    supportText = 'Premium';
                    break;
                case 'ultra':
                    supportText = 'Ultra';
                    break;
            }
            summaryItems.push(`<li class="list-group-item">Soporte Técnico: ${supportText}</li>`);
        }

        function resetPaymentStatus() {
            devicePaymentCompleted = false;
            supportPaymentCompleted = false;
        }

        // Inicialización del modal
        $('#purchaseModal').on('show.bs.modal', function() {
            updatePurchaseSummary();
            resetPaymentStatus();
            const confirmBtn = document.getElementById('confirmPurchaseBtn');
            if (confirmBtn) confirmBtn.classList.add('d-none');
        });
    });
    </script>
</body>
</html>