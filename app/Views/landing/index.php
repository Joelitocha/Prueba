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
            font-size: 1.0rem;
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

<script src="https://www.paypal.com/sdk/js?client-id=AXn6zeaT-kutunjZDVGKpbDSQ6WCCPgvHvsdaVYjrQvy4udAukapA5ISWF9QIR268HG_K-eDjk8ETcYs&currency=USD&vault=true"></script>

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

<section id="planes" class="fullpage-section">
  <div class="container">
    <div class="section-title text-center mb-5">
      <h2>Planes de Compra de RackON</h2>
      <p class="lead">Elige el plan que mejor se adapte a tu empresa.</p>
    </div>
    <div class="row">

      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card plan-card border-success h-100">
          <div class="card-body d-flex flex-column">
            <h4 class="card-title">🥉 Secure Access</h4>
            <p class="card-text text-muted mb-3">Solución básica para control de acceso.</p>
            <h3 class="card-subtitle mb-2 text-primary">Desde $10 USD/mes</h3>
            <ul class="list-unstyled text-start my-4">
              <li>✔ Control de acceso RFID</li>
              <li>✔ Registro de eventos de acceso</li>
              <li>✔ Alertas básicas por vibración</li>
              <li>✔ Soporte por correo electrónico</li>
              <li class="ver-mas-contenido">✔ 1 rack incluido</li>
              <li class="ver-mas-contenido">✔ 5 usuarios RFID</li>
              <li class="ver-mas-contenido">✔ Historial de 30 días</li>
            </ul>
            <a class="ver-mas-btn mb-3" data-target="plan1-contenido">Ver más</a>
            <button class="btn btn-success btn-compra mt-auto" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalCompra"
                    data-plan-nombre="Secure Access" 
                    data-precio-mensual="10.00" 
                    data-precio-anual="100.00">
              Comprar Plan
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card plan-card border-primary h-100">
          <div class="card-body d-flex flex-column">
            <h4 class="card-title">🥈 Pro Guard</h4>
            <p class="card-text text-muted mb-3">Seguridad avanzada con monitoreo visual.</p>
            <h3 class="card-subtitle mb-2 text-primary">Desde $25 USD/mes</h3>
            <ul class="list-unstyled text-start my-4">
              <li>✔ Todo lo del plan Secure Access</li>
              <li>✔ Monitoreo por cámara</li>
              <li>✔ Grabación de video de eventos</li>
              <li>✔ Notificaciones en tiempo real</li>
              <li class="ver-mas-contenido">✔ Hasta 3 racks</li>
              <li class="ver-mas-contenido">✔ 25 usuarios RFID</li>
              <li class="ver-mas-contenido">✔ Historial de 90 días</li>
              <li class="ver-mas-contenido">✔ Soporte prioritario</li>
            </ul>
            <a class="ver-mas-btn mb-3" data-target="plan2-contenido">Ver más</a>
            <button class="btn btn-primary btn-compra mt-auto" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalCompra"
                    data-plan-nombre="Pro Guard" 
                    data-precio-mensual="25.00" 
                    data-precio-anual="250.00">
              Comprar Plan
            </button>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card plan-card border-danger h-100">
          <div class="card-body d-flex flex-column">
            <h4 class="card-title">🥇 Ultimate Security</h4>
            <p class="card-text text-muted mb-3">Máxima seguridad y personalización.</p>
            <h3 class="card-subtitle mb-2 text-primary">Desde $50 USD/mes</h3>
            <ul class="list-unstyled text-start my-4">
              <li>✔ Todas las características de Pro Guard</li>
              <li>✔ Múltiples cámaras por rack</li>
              <li>✔ Análisis de video avanzado</li>
              <li>✔ Integración con sistemas existentes</li>
              <li class="ver-mas-contenido">✔ Racks ilimitados</li>
              <li class="ver-mas-contenido">✔ Usuarios RFID ilimitados</li>
              <li class="ver-mas-contenido">✔ Historial ilimitado</li>
              <li class="ver-mas-contenido">✔ Soporte 24/7 y SLA</li>
              <li class="ver-mas-contenido">✔ Consultoría de seguridad</li>
            </ul>
            <a class="ver-mas-btn mb-3" data-target="plan3-contenido">Ver más</a>
            <button class="btn btn-danger btn-compra mt-auto" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalCompra"
                    data-plan-nombre="Ultimate Security" 
                    data-precio-mensual="50.00" 
                    data-precio-anual="500.00">
              Comprar Plan
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
                <h2>Contáctanos</h2>
                <p class="lead">¿Tienes alguna pregunta o necesitas una solución personalizada? Completa el formulario y nos pondremos en contacto contigo.</p>
            </div>
            <div class="row mt-5">
                <div class="col-lg-8 offset-lg-2">
                    <form class="contact-form">
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Asunto" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Tu mensaje" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn-solid-lg">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-3">RackON</h5>
                    <p class="small">Sistema inteligente de seguridad para racks de servidores. Protege tus activos críticos con tecnología RFID, sensores y cámaras.</p>
                </div>
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <h5 class="text-white mb-3">Enlaces Rápidos</h5>
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
                    <h5 class="text-white mb-3">Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h5 class="text-white mb-3">Síguenos</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col text-center small">
                    <p class="mb-0">© 2024 RackON. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <button id="backToTop" class="btn btn-primary rounded-circle shadow">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling para enlaces de ancla
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Sticky Navbar
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Back To Top Button
        const backToTopButton = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Mostrar/Ocultar contenido en tarjetas de plan
        document.querySelectorAll('.ver-mas-btn').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const parentUl = this.closest('.card-body').querySelector('.list-unstyled');
                parentUl.querySelectorAll('.ver-mas-contenido').forEach(item => {
                    item.classList.toggle('mostrar');
                });
                
                if (this.innerText === 'Ver más') {
                    this.innerText = 'Ver menos';
                } else {
                    this.innerText = 'Ver más';
                }
            });
        });

        // Lógica del modal de compra y PayPal
        const modalCompra = document.getElementById('modalCompra');
        modalCompra.addEventListener('show.bs.modal', function (event) {
          // Botón que disparó el modal
          const button = event.relatedTarget; 
          // Extraer info de los atributos data-*
          const planNombre = button.getAttribute('data-plan-nombre');
          const precioMensual = button.getAttribute('data-precio-mensual');
          const precioAnual = button.getAttribute('data-precio-anual');

          // Actualizar contenido del modal
          document.getElementById('modalPlanNombre').innerText = planNombre;
          document.getElementById('modalPrecioMensual').innerText = precioMensual;
          document.getElementById('modalPrecioAnual').innerText = precioAnual;

          // Limpiar contenedores PayPal antes de renderizar
          document.getElementById('paypal-button-modal-mensual').innerHTML = '';
          document.getElementById('paypal-button-modal-anual').innerHTML = '';

          // Render botón mensual
          paypal.Buttons({
            createOrder: (data, actions) => {
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: precioMensual.toString()
                  }
                }]
              });
            },
            onApprove: (data, actions) => {
              return actions.order.capture().then(function(details) {
                alert('Pago mensual completado: ' + details.payer.name.given_name);
                // Aquí podrías agregar lógica para confirmar la suscripción en tu backend
              });
            }
          }).render('#paypal-button-modal-mensual');

          // Render botón anual
          paypal.Buttons({
            createOrder: (data, actions) => {
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: precioAnual.toString()
                  }
                }]
              });
            },
            onApprove: (data, actions) => {
              return actions.order.capture().then(function(details) {
                alert('Pago anual completado: ' + details.payer.name.given_name);
                // Aquí podrías agregar lógica para confirmar la suscripción en tu backend
              });
            }
          }).render('#paypal-button-modal-anual');
        });
    });
    </script>
</body>
</html>